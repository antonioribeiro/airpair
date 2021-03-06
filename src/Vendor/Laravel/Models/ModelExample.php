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

namespace PragmaRX\AirPair\Vendor\Laravel\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ModelExample extends Eloquent {

	protected $table = 'airpair_accesses';

	protected $fillable = array('session_id', 
								'path_info');
}
