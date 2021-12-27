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
	'odds_api_url'    => 'https://api.the-odds-api.com/v3/',
	'vendor_dir'      => SPORTS_ODDS_TABLE_DIR . '/vendor',
	'assets_dir'      => SPORTS_ODDS_TABLE_DIR . '/assets',
	'assets_uri'      => SPORTS_ODDS_TABLE_URL . '/assets',
];
