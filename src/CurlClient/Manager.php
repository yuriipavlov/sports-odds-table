<?php
/**
 * Data processing entrypoint manager.
 * Use getSportsList() and getOddsList() functions to get data in JSON format
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\CurlClient;

use SportsOddsTable\Helper\Utils;


class Manager {
	
	
	private static $base_url;
	
	private static $api_key;
	
	
	private static function initRequiredData(): bool {
		self::$base_url = self::$base_url ?? Utils::getConfigSetting( 'odds_api_url', '' );
		self::$api_key  = self::$api_key ?? Utils::getOddsApiKey();
		
		if ( ! self::$base_url ) {
			error_log( 'CURL CLIENT MANAGER ERROR [request_base_url(' . self::$base_url . ')]' );
			
			return false;
		}
		
		if ( ! self::$api_key ) {
			error_log( 'CURL CLIENT MANAGER ERROR [api_key(' . self::$api_key . ')]' );
			
			return false;
		}
		
		return true;
	}
	
	/**
	 * Get List of Sports
	 *
	 * @return string
	 */
	public static function getSportsList() {
		
		if ( ! self::initRequiredData() ) {
			return false;
		}
		
		$request_url = self::$base_url . 'sports?apiKey=' . self::$api_key;
		
		$result     = Process::run( $request_url, [] );
		$is_success = $result['success'] && ! empty( $result['data_raw'] );
		
		return $is_success ? $result['data_raw'] : '';
	}
	
	/**
	 * Get List of Odds
	 *
	 * @return string
	 */
	public static function getOddsList( $sport, $region, $mkt = '' ) {
		
		if ( ! self::initRequiredData() ) {
			return false;
		}
		
		$request_url = self::$base_url . 'odds?apiKey=' . self::$api_key . "&sport={$sport}&region={$region}";
		
		// add optional params
		if ( $mkt ) {
			$request_url .= "&mkt={$mkt}";
		}
		
		$result     = Process::run( $request_url, [] );
		$is_success = $result['success'] && ! empty( $result['data_raw'] );
		
		return $is_success ? $result['data_raw'] : '';
	}
}
