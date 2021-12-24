<?php
/**
 * Sports Odds Table Gutenberg Block functions
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\Handlers\Blocks;

use SportsOddsTable\Helper\Utils;
use SportsOddsTable\Helper\View;
use SportsOddsTable\CurlClient\Manager;

defined( 'ABSPATH' ) || exit;

class OddsTable {
	
	/**
	 * Registers the block using the namespace and args. Assets will connect with PHP functions.
	 * Args can be added with the metadata loaded from the `block.json` file (WordPress 5.8 required).
	 *
	 * @return void
	 **/
	public static function register_block() {
		
		register_block_type( 'sports-odds-table/table-block', [
			'api_version'     => 2,
			'title'           => 'Sports Odds Table',
			'description'     => 'Show sports odds data from a public API in a simple table, with a few filters to allow easier odds preview.',
			'textdomain'      => 'sports-odds-table',
			'category'        => 'widgets',
			'icon'            => 'universal-access-alt',
			//'script'          => '',
			'style'           => 'sports-odds-table-block',
			'editor_script'   => 'sports-odds-table-block',
			'editor_style'    => 'sports-odds-table-block',
			'render_callback' => [ self::class, 'show_odds_table' ]
		] );
		
	}
	
	/**
	 * Register block editor assets for this block.
	 *
	 * @return void
	 */
	public static function register_assets() {
		$assets_uri = Utils::getConfigSetting( 'assets_uri' ) ;
		$assets_dir = Utils::getConfigSetting( 'assets_dir' );
		$asset_file = include $assets_dir . '/table-block.asset.php';
		
		// Register block styles for both frontend + backend.
		wp_register_style(
			'sports-odds-table-block',
			$assets_uri . '/table-block.css',
			is_admin() ? [ 'wp-editor' ] : null,
			filemtime( $assets_dir . '/table-block.css' )
		);
		
		// Register block editor script for backend.
		wp_register_script(
			'sports-odds-table-block',
			$assets_uri . '/table-block.js',
			$asset_file['dependencies'],
			filemtime( $assets_dir . '/table-block.js' ),
			true
		);
	}
	
	/**
	 * Callback function to show dynamic data from odds API
	 *
	 * @return string
	 **/
	public static function show_odds_table(): string {
		//var_dump(Manager::getOddsList( 'soccer_epl', 'uk' ));
		return View::load('/templates/odds-table', ['odds_list' => Manager::getOddsList( 'soccer_epl', 'uk' )], true);
		
	}
}
