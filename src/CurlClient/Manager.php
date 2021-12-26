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
	
	
	private static string $base_url;
	
	private static string $api_key;
	
	/**
	 * Get List of Sports
	 *
	 * @return array
	 */
	public static function getSportsList(): array {
		
		if ( ! self::initRequiredData() ) {
			return [];
		}
		
		$request_url = self::$base_url . 'sports?apiKey=' . self::$api_key;
		
		$result        = Process::run( $request_url, [] );
		$is_success    = $result['success'] && ! empty( $result['data_raw'] );
		$results_array = json_decode( $result['data_raw'], true );
		
		return $is_success ? $results_array['data'] : [];
	}
	
	private static function initRequiredData(): bool {
		self::$base_url = self::$base_url ?? strval( Utils::getConfigSetting( 'odds_api_url', '' ) );
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
	 * Get List of Odds
	 *
	 * @param string $sport
	 * @param string $region
	 * @param string $mkt
	 *
	 * @return array
	 */
	public static function getOddsList( string $sport, string $region, $mkt = '' ): array {
		
		if ( ! self::initRequiredData() ) {
			return [];
		}
		
		$request_url = self::$base_url . 'odds?apiKey=' . self::$api_key . "&sport={$sport}&region={$region}";
		
		// add optional params
		if ( $mkt ) {
			$request_url .= "&mkt={$mkt}";
		}
		
		$result        = Process::run( $request_url, [] );
		$is_success    = $result['success'] && ! empty( $result['data_raw'] );
		$results_array = json_decode( $result['data_raw'], true );
		
		return $is_success ? $results_array['data'] : [];
		
	}
}
