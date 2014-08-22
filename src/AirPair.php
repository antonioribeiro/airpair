<?php

/**
 * Part of the AirPair package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    AirPair
 * @version    1.0.0
 * @author     Antonio Carlos Ribeiro @ PragmaRX
 * @license    BSD License (3-clause)
 * @copyright  (c) 2013, PragmaRX
 * @link       http://pragmarx.com
 */

namespace PragmaRX\AirPair;

use PragmaRX\AirPair\Support\Config;

use PragmaRX\AirPair\Data\RepositoryManager as RepositoryManager;

class AirPair
{
    private $config;

    private $session;

    public function __construct(
                                    Config $config, 
                                    RepositoryManager $repositoryManager
                                )
    {
        $this->config = $config;

        $this->repositoryManager = $repositoryManager;
    }

    public function boot()
    {
        if ($this->config->get('enabled'))
        {
            /// what to do when booting?
        }
    }

}