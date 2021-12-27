<?php

namespace SportsOddsTable\Handlers;

use SportsOddsTable\Helper\View;

defined( 'ABSPATH' ) || exit;

class Settings {
	
	
	public static function menu() {
		
		add_submenu_page(
			'options-general.php',
			__( 'Sports Odds Table', 'sports-odds-table' ),
			__( 'Sports Odds Table', 'sports-odds-table' ),
			'manage_options',
			'sot_settings',
			[ self::class, 'settings_page' ]
		);
	}
	
	
	public static function settings_page() {
		View::load( '/templates/settings-page' );
	}
	
	
	public static function settings_init() {
		
		add_settings_section(
			'sot_settings__main_section',
			'',
			[ self::class, 'main_section_desc_view' ],
			'sot_settings'
		);
		
		register_setting(
			'sot_settings__main_group',
			'sot_odds_api_key',
			[ self::class, 'sanitize__odds_api_key' ]
		);
		
		register_setting(
			'sot_settings__main_group',
			'sot_cache_enable',
			[ self::class, 'validate_checkbox' ]
		);
		
		add_settings_field(
			'sot_settings__odds_api_key',
			__( 'Odds API key', 'sports-odds-table' ),
			[ self::class, 'setting_view__odds_api_key' ],
			'sot_settings',
			'sot_settings__main_section',
			[
				'tag_id'    => 'sot_odds_api_key_id',
				'tag_name'  => 'sot_odds_api_key',
				'label_for' => 'sot_odds_api_key_id',
			]
		);
		
		add_settings_field(
			'sot_settings__cache_enable',
			__( 'Caching', 'sports-odds-table' ),
			[ self::class, 'setting_view__cache_enable' ],
			'sot_settings',
			'sot_settings__main_section',
			[
				'tag_id'    => 'sot_cache_enable_id',
				'tag_name'  => 'sot_cache_enable',
				'label_for' => 'sot_cache_enable_id',
			]
		);
	}
	
	
	public static function main_section_desc_view() {
		_e( 'Show sports odds data from a public API in a simple table, with a few filters to allow easier odds preview.', 'sports-odds-table' );
	}
	
	
	public static function setting_view__odds_api_key( $args ) {
		
		$value = get_option( 'sot_odds_api_key', '' );
		
		echo '
				<input type="text" class="regular-text"
					 id="' . esc_attr( $args['tag_id'] ) . '"
					 name="' . esc_attr( $args['tag_name'] ) . '"
					 value="' . esc_attr( $value ) . '">
				<br>
				<p class="description">
					' . __( '<a href="https://the-odds-api.com/#get-access" target="_blank">Get Odds API Key</a>', 'sports-odds-table' ) . '
				</p>
			';
	}
	
	public static function setting_view__cache_enable( $args ) {
		
		$value = get_option( 'sot_cache_enable', '' );
		
		echo '
				<label for="' . esc_attr( $args['tag_id'] ) . '">
					<input type="checkbox"
						 id="' . esc_attr( $args['tag_id'] ) . '"
						 name="' . esc_attr( $args['tag_name'] ) . '"
						 value="1"
						  ' . checked( $value, 1, 0 ) . '>
					' . __( 'Enable Odds API caching', 'sports-odds-table' ) . '
				</label>
				<br>
				<p class="description">
					' . __( 'If enabled, API requests results will save in transient options', 'sports-odds-table' ) . '
				</p>
			';
	}
	
	public static function sanitize__odds_api_key( $input ) {
		return sanitize_text_field( $input );
	}
	
	public static function validate_checkbox( $input ) {
		return trim( $input );
	}
	
	public static function add_action_links( $actions, $plugin_file ) {
		if ( false === strpos( $plugin_file, basename( SPORTS_ODDS_TABLE_FILE ) ) ) {
			return $actions;
		}
		
		$settings_link = '<a href="options-general.php?page=sot_settings' . '">Settings</a>';
		
		array_unshift( $actions, $settings_link );
		
		return $actions;
		
		
	}
}
