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
	 * Get cached data by request url
	 *
	 * @param $request_url
	 *
	 * @return array
	 */
	public static function get( $request_url ): array {
		
		if ( empty( get_option( 'sot_cache_enable', '' ) ) ) {
			return [];
		}
		
		$name = self::prepare_name( $request_url );
		
		$result = get_transient( $name );
		
		return ! empty( $result ) ? $result : [];
	}
	
	/**
	 * Prepare option name - clear and reduce
	 *
	 * @param $url
	 *
	 * @return string
	 */
	public static function prepare_name( $url ): string {
		
		$settings_prefix = Utils::getConfigSetting( 'settings_prefix' );
		$odds_api_url    = Utils::getConfigSetting( 'odds_api_url' );
		$api_key         = Utils::getOddsApiKey();
		
		$url = str_replace( $api_key, hash( 'adler32', $api_key ), $url );
		$url = str_replace( $odds_api_url, '', $url );
		$url = str_replace( [ '/', '?', '&', '=' ], '-', $url );
		
		return sanitize_key( $settings_prefix . $url );
	}
	
	/**
	 *
	 *
	 * @param $request_url
	 * @param $value
	 *
	 * @return bool
	 */
	public static function set( $request_url, $value ): bool {
		
		if ( empty( get_option( 'sot_cache_enable', '' ) ) ) {
			return false;
		}
		
		$name = self::prepare_name( $request_url );
		
		// Set transient on 5 minutes
		return set_transient( $name, $value, 60 * 5 );
	}
	
}
