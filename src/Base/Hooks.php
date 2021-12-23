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

use SportsOddsTable\Handlers;

defined( 'ABSPATH' ) || exit;

class Hooks {

	public static function runHooks() {

		/************************************
		 *            Activation
		 ************************************/

		register_activation_hook( SPORTS_ODDS_TABLE_DIR, [ Handlers\PluginActivation::class, '_activate' ] );
		register_deactivation_hook( SPORTS_ODDS_TABLE_DIR, [ Handlers\PluginActivation::class, '_deactivate' ] );


		/************************************
		 *         Gutenberg blocks
		 ************************************/

		add_action( 'init', [ Handlers\Blocks\OddsTable::class, 'register_block' ] );
		add_action( 'init', [ Handlers\Blocks\OddsTable::class, 'register_assets' ] );

	}
}
