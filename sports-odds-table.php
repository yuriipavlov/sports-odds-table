<?php
/**
 * Sports Odds Table
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 * @link              https://github.com/yuriipavlov/sports-odds-table
 * @license           https://github.com/yuriipavlov/sports-odds-table/blob/master/LICENSE.md MIT
 *
 * @wordpress-plugin
 * Plugin Name:       Sports Odds Table
 * Plugin URI:        https://github.com/yuriipavlov/sports-odds-table
 * Description:       Show sports odds data from a public API in a simple table, with a few filters to allow easier odds preview.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Yurii Pavlov
 * Author URI:        https://www.linkedin.com/in/yurii-pavlov/
 * Text Domain:       sports-odds-table
 * Domain Path:       /languages
 * License:           MIT
 * License URI:       https://github.com/yuriipavlov/sports-odds-table/blob/master/LICENSE.md
 */

use SportsOddsTable\App;
use SportsOddsTable\Helper\Utils;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

//define plugin path and url without slash
define( 'SPORTS_ODDS_TABLE_DIR', __DIR__ );
define( 'SPORTS_ODDS_TABLE_FILE', __FILE__ );
define( 'SPORTS_ODDS_TABLE_URL', plugins_url( '', __FILE__ ) );

if ( PHP_VERSION_ID < 70400 ) {
	wp_die( sprintf( __( 'Sports Odds Table require at least PHP 7.4.0 ( You are using PHP %s ) ' ), PHP_VERSION ) );
}

// Helper functions for develop
require_once SPORTS_ODDS_TABLE_DIR . '/dev.php';

// Autoload
require_once SPORTS_ODDS_TABLE_DIR . '/autoload.php';

// Run App Singleton
$app    = App::getInstance();
$config = apply_filters( 'sports-odds-table/config', require SPORTS_ODDS_TABLE_DIR . '/config/config.php' );

try {
	$app->run( $config );
} catch ( Throwable $throwable ) {
	//Utils::setErrorHandler();
	Utils::errorHandler( $throwable );
}