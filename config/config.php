<?php
/**
 * Application config
 *
 * Return an array with predefined config values
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

defined( 'ABSPATH' ) || exit;

return [
	'cache_time'      => '202112211846',
	'version'         => 10000,
	'settings_prefix' => 'sot_',
	'errors_silent'   => true,
	'vendor_dir'      => SPORTS_ODDS_TABLE_DIR . '/vendor/',
	'assets_uri'      => SPORTS_ODDS_TABLE_URL . '/assets/',
	
	'example_option' => [
		'array_option1' => 'value1',
		'array_option2' => 'value2',
	]
];
