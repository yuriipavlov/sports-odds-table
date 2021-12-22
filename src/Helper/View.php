<?php
/**
 * View Class
 *
 * Anything to do with templates
 * and outputting client code
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\Helper;

use Exception;
use RuntimeException;

defined( 'ABSPATH' ) || exit;

class View {
	
	/**
	 * Load template file, transfer data array to template file
	 *
	 * @param string $path
	 * @param array $data
	 * @param bool $return
	 * @param null $base
	 *
	 * @return false|string
	 */
	public static function load( $path = '', array $data = [], $return = false, $base = null ) {
		
		if ( $base === null ) {
			$base = SPORTS_ODDS_TABLE_DIR;
		}
		
		$full_path = $base . $path . '.php';
		
		if ( $return ) {
			ob_start();
		}
		
		try {
			if ( file_exists( $full_path ) ) {
				
				require $full_path;
				
			} else {
				throw new RuntimeException( 'The view path ' . $full_path . ' can not be found.' );
			}
		} catch ( Exception $e ) {
			trigger_error( $e->getMessage(), E_USER_ERROR );
		}
		
		
		if ( $return ) {
			return ob_get_clean();
		}
		
	}
	
}
