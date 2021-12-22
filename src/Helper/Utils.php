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
	
	public static function setErrorHandler() {
		// for disabling wordpress default shutdown handler for fatal errors
		if ( ! defined( 'WP_SANDBOX_SCRAPING' ) ) {
			define( 'WP_SANDBOX_SCRAPING', true );
		}
		
		ini_set( 'html_errors', 'off' );
		set_error_handler( [ static::class, 'errorHandler' ] );
		register_shutdown_function( [ static::class, 'errorShutdownHandler' ] );
	}
	
	public static function errorHandler( $throwable ) {
		$errors_silent = self::getConfigSetting( 'errors_silent', '', true );
	
		if ( empty( $errors_silent ) ) {
			wp_die( __( 'Sports Odds Table Error. Look to log file for details.' ) );
		}
	}

}
