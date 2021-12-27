<?php
/**
 * Hooks functionality for the plugin
 *
 * Run hook handlers
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\Base;

use SportsOddsTable\Handlers\PluginActivation;
use SportsOddsTable\Handlers\Blocks;
use SportsOddsTable\Handlers\Settings;

defined( 'ABSPATH' ) || exit;

class Hooks {

	public static function runHooks() {

		/************************************
		 *            Activation
		 ************************************/
		register_activation_hook( SPORTS_ODDS_TABLE_DIR, [ PluginActivation::class, 'activate' ] );
		register_deactivation_hook( SPORTS_ODDS_TABLE_DIR, [ PluginActivation::class, 'deactivate' ] );


		/************************************
		 *         Gutenberg blocks
		 ************************************/
		add_action( 'init', [ Blocks\OddsTable::class, 'register_block' ] );
		add_action( 'init', [ Blocks\OddsTable::class, 'register_assets' ] );
		add_action( 'wp_enqueue_scripts', [ Blocks\OddsTable::class, 'enqueue_assets_libs' ], 5 );
		
		
		/************************************
		 *           Settings menu
		 ************************************/
		add_action( 'admin_menu', [ Settings::class, 'menu' ] );
		add_action( 'admin_init', [ Settings::class, 'settings_init' ] );
		
		add_filter( 'plugin_action_links', [ Settings::class, 'add_action_links' ], 10, 2 );

	}
}
