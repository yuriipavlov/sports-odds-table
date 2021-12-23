<?php
/**
 * Utilities
 *
 * Helper functions
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\Helper;

use SportsOddsTable\App;

defined( 'ABSPATH' ) || exit;

class Utils {

	/**
	 * Get settings from App configuration array
	 *
	 * @param $name
	 * @param $default
	 * @param bool $direct
	 *
	 * @return mixed
	 */
	public static function getConfigSetting( $name, $default = null, $direct = false ) {
		$parts = explode( '/', $name );

		$config = $direct
			? apply_filters( 'sports-odds-table/config', require SPORTS_ODDS_TABLE_DIR . '/config/config.php' )
			: App::getInstance()->getConfig();

		if ( ! isset( $config[ $parts[0] ] ) ) {
			return $default;
		}

		$value = $config[ array_shift( $parts ) ];

		foreach ( $parts as $part ) {
			if ( is_array( $value ) && isset( $value[ $part ] ) ) {
				$value = $value[ $part ];
			} else {
				return $default;
			}
		}

		return $value;
	}
	
	public static function errorHandler( $throwable ) {
		
		$error_message = 'Sports Odds Table PHP error: ' . $throwable->getMessage();
		$error_message .=  ' in ' . $throwable->getFile();
		$error_message .=  ' on line ' . $throwable->getLine();
		$error_message .=  PHP_EOL . $throwable->getTraceAsString ();
		
		error_log( $error_message );
		
		$errors_silent = self::getConfigSetting( 'errors_silent', '', true );
		
		if ( empty( $errors_silent ) ) {
			wp_die( __( 'Sports Odds Table Error. Look to log file for details.' ) );
		}
	}
	
	
	/**
	 * Get Odds Api key
	 * 
	 * @return string
	 */
	public static function getOddsApiKey(): string {
		return get_option( 'sot_odds_api_key', '' );
	}

}
