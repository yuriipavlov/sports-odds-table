<?php
/**
 * Data receiving process, error handlers
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\CurlClient;

use Exception;

defined( 'ABSPATH' ) || exit;

class Process {
	
	public static function run(
		string $request_url,
		array $replace_options = [],
		array $ok_codes = [ 200, 301, 302 ] // leave empty if no code checking required
	): array {
		
		try {
			$request = new Request();
			
			$options = [
				CURLOPT_URL        => $request_url,
				CURLOPT_HTTPHEADER => [],
			];
			
			$options = array_replace( $options, $replace_options );
			
			$request->init( $options );
			$res = $request->exec();
			
			// error cURL
			if ( $res['curl_error'] ) {
				throw new Exception( "cURL error ({$res['curl_error']})", 1001, null );
			}
			
			// error 
			if ( $ok_codes && ! in_array( (int) $res['http_code'], $ok_codes, true ) ) {
				throw new Exception( "Not success HTTP code ({$res['http_code']})", 1002, null );
			}
			
		} catch ( Exception $e ) {
			
			error_log( "CURL CLIENT ERROR [request_url({$request_url})] [{$e->getCode()}] : {$e->getMessage()}" );
			
			return [
				'success'    => false,
				'message'    => "CURL CLIENT ERROR [{$e->getCode()}] : {$e->getMessage()}",
				'error_code' => $e->getCode(),
				'data'       => [],
				'data_raw'   => '',
			];
		}
		
		// Debug all requests
		error_log( "CURL CLIENT SUCCESS [request_url({$request_url})]" );
		
		return [
			'success'    => true,
			'message'    => '',
			'error_code' => 0,
			'data'       => $res['body'],
			'data_raw'   => $res['body_raw'],
		];
	}
}
