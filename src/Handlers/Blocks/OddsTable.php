<?php
/**
 * Sports Odds Table Gutenberg Block functions
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\Handlers\Blocks;

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
			'api_version' => '2',
			'title' => 'Sports Odds Table',
			//'category' => '',
			'icon' => 'universal-access-alt',
			//'editor_script' => 'awp-myfirstblock-js',
			'render_callback' => [ self::class, 'show_odds_table' ]
		]);
	}
	
	/**
	 * Callback function to show dynamic data from odds API
	 *
	 * @return string
	 **/
	public static function show_odds_table(): string {
		
		return 'Test';
	
	}
	
	
}
