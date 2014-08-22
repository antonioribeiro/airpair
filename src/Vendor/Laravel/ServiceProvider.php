<?php namespace PragmaRX\AirPair\Vendor\Laravel;
 
use PragmaRX\AirPair\AirPair;

use PragmaRX\AirPair\Support\Config;
use PragmaRX\AirPair\Support\FileSystem;

use PragmaRX\AirPair\Data\Repositories\RepositoryExample;

use PragmaRX\AirPair\Data\RepositoryManager;

use PragmaRX\AirPair\Vendor\Laravel\Models\ModelExample;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Illuminate\Foundation\AliasLoader as IlluminateAliasLoader;

class ServiceProvider extends IlluminateServiceProvider {

    const PACKAGE_NAMESPACE = 'pragmarx/airpair';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package(self::PACKAGE_NAMESPACE, self::PACKAGE_NAMESPACE, __DIR__.'/../..');

        if( $this->app['config']->get(self::PACKAGE_NAMESPACE.'::create_airpair_alias') )
        {
            IlluminateAliasLoader::getInstance()->alias(
                                                            $this->getConfig('airpair_alias'),
                                                            'PragmaRX\AirPair\Vendor\Laravel\Facade'
                                                        );
        }

        $this->wakeUp();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {   
        $this->registerConfig();

        $this->registerRepositories();

        $this->registerAirPair();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('airpair');
    }

    /**
     * Takes all the components of AirPair and glues them
     * together to create AirPair.
     *
     * @return void
     */
    private function registerAirPair()
    {
        $this->app['airpair'] = $this->app->share(function($app)
        {
            $app['airpair.loaded'] = true;

            return new AirPair(
                                    $app['airpair.config'],
                                    $app['airpair.repository.manager']
                                );
        });
    }

    public function registerRepositories()
    {
        $this->app['airpair.repository.manager'] = $this->app->share(function($app)
        {
            return new RepositoryManager(
                                            $app['airpair.config'],
                                            new RepositoryExample(new ModelExample)
                                        );
        });
    }

    public function registerConfig()
    {
        $this->app['airpair.config'] = $this->app->share(function($app)
        {
            return new Config($app['config'], self::PACKAGE_NAMESPACE);
        });
    }

    private function wakeUp()
    {
        $this->app['airpair']->boot();
    }

    private function getConfig($key)
    {
        return $this->app['config']->get(self::PACKAGE_NAMESPACE.'::'.$key);
    }

}
