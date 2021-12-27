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
			'script'          => 'sports-odds-table-block-front',
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
		$assets_uri = Utils::getConfigSetting( 'assets_uri' );
		$assets_dir = Utils::getConfigSetting( 'assets_dir' );
		
		$asset_file = include $assets_dir . '/build/table-block.asset.php';
		
		// Register block styles for both frontend + backend.
		wp_register_style(
			'sports-odds-table-block',
			$assets_uri . '/build/table-block.css',
			is_admin() ? [ 'wp-editor' ] : null,
			filemtime( $assets_dir . '/build/table-block.css' )
		);
		
		// Register block editor script for backend.
		wp_register_script(
			'sports-odds-table-block',
			$assets_uri . '/build/table-block.js',
			$asset_file['dependencies'],
			filemtime( $assets_dir . '/build/table-block.js' ),
			true
		);
		
		// Register block editor script for frontend.
		wp_register_script(
			'sports-odds-table-block-front',
			$assets_uri . '/build/table-block-front.js',
			[ 'jquery', 'sports-odds-jcf' ],
			filemtime( $assets_dir . '/build/table-block-front.js' ),
			true
		);
	}
	
	public static function enqueue_assets_libs() {
		
		$assets_uri = Utils::getConfigSetting( 'assets_uri' );
		$assets_dir = Utils::getConfigSetting( 'assets_dir' );
		
		wp_enqueue_script(
			'sports-odds-jcf',
			$assets_uri . '/lib/jcf.js',
			[ 'jquery' ],
			filemtime( $assets_dir . '/lib/jcf.js' ),
			true
		);
		wp_enqueue_script(
			'sports-odds-jcf-select',
			$assets_uri . '/lib/jcf.select.js',
			[ 'jquery', 'sports-odds-jcf' ],
			filemtime( $assets_dir . '/lib/jcf.select.js' ),
			true
		);
		
		wp_enqueue_style(
			'sports-odds-jcf',
			$assets_uri . '/lib/jcf.min.css',
			[],
			filemtime( $assets_dir . '/lib/jcf.min.css' ),
		);
		
	}
	
	/**
	 * Callback function to show dynamic data from odds API
	 *
	 * @return string
	 **/
	public static function show_odds_table(): string {
		
		$sports_list = Manager::getSportsList();
		
		$odds_list = Manager::getOddsList( 'upcoming', 'uk' );
		
		return View::load( '/templates/odds-table', [ 'sports_list' => $sports_list, 'odds_list' => $odds_list ], true );
		
	}
}
