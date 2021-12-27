<?php
/**
 * Cache request data
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\CurlClient;

use SportsOddsTable\Helper\Utils;

defined( 'ABSPATH' ) || exit;

class Cache {
	
	/**
	 * Get Odds data from cache
	 *
	 * @param $sport
	 * @param $region
	 * @param $mkt
	 *
	 * @return mixed
	 */
	public static function getOddsList( $sport, $region, $mkt ) {
		
		$settings_prefix = Utils::getConfigSetting( 'settings_prefix' );
		
		$name = $settings_prefix . $sport . '_' . $region . '_' . $mkt;
		
		return get_transient( $name );
	}
	
	/**
	 * Set Odds data to cache
	 *
	 * @param string $sport
	 * @param string $region
	 * @param string $mkt
	 * @param mixed $value
	 */
	public static function setOddsList( string $sport, string $region, string $mkt, $value ) {
		
		$settings_prefix = Utils::getConfigSetting( 'settings_prefix' );
		
		$name = $settings_prefix . $sport . '_' . $region . '_' . $mkt;
		
		// Set transient on 5 minutes
		set_transient( $name, $value, 60 * 5 );
	}
	
	/**
	 * Get sports list from cache
	 *
	 * @return mixed
	 */
	public static function getSportsList() {
		
		$settings_prefix = Utils::getConfigSetting( 'settings_prefix' );
		
		$name = $settings_prefix . 'sports';
		
		return get_transient( $name );
	
	}
	
	/**
	 * Set sports list to cache
	 *
	 * @param mixed $value
	 */
	public static function setSportsList( $value ) {
		
		$settings_prefix = Utils::getConfigSetting( 'settings_prefix' );
		
		$name = $settings_prefix . 'sports';
		
		// Set transient on 5 minutes
		set_transient( $name, $value, 60 * 5 );
	
	}
}
