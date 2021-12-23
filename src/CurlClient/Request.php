<?php
/**
 * Make curl request to external API
 *
 * @package           sports-odds-table
 * @author            Yurii Pavlov
 */

namespace SportsOddsTable\CurlClient;

defined( 'ABSPATH' ) || exit;


class Request {
	
	private $ch;
	
	/**
	 * Init curl session
	 *
	 * @param array $options An array specifying which options to set and their values.
	 * The keys should be valid curl_setopt constants or
	 * their integer equivalents.
	 */
	public function init( $options ) {
		$this->ch = curl_init();
		
		$options_defaults = [
			CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
			CURLOPT_URL            => '',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_CONNECTTIMEOUT => 12,
			CURLOPT_TIMEOUT        => 25,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'GET',
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTPHEADER     => [
				'Accept-Charset: charset=utf-8',
				'Content-Type: application/json',
			],
		];
		
		$options = array_replace( $options_defaults, $options );
		
		curl_setopt_array( $this->ch, $options );
	}
	
	
	/**
	 * Make curl request
	 *
	 * @return array  ['header','body','curl_error','http_code','last_url']
	 */
	public function exec(): array {
		$response   = curl_exec( $this->ch );
		$curl_error = curl_error( $this->ch );
		$result     = [
			'headers_raw' => '',
			//'headers'     => '',
			'body_raw'    => '',
			'body'        => '',
			'curl_error'  => '',
			'http_code'   => '',
			'last_url'    => '',
		];
		if ( false === $response || '' !== $curl_error ) {
			$result['curl_error'] = $curl_error;
			
			return $result;
		}
		
		// headers
		$header_size           = curl_getinfo( $this->ch, CURLINFO_HEADER_SIZE );
		$result['headers_raw'] = substr( $response, 0, $header_size );
		
		// body
		$result['body_raw'] = substr( $response, $header_size );
		$result['body']     = self::may_be_json( $result['body_raw'] );
		
		// code
		$result['http_code'] = curl_getinfo( $this->ch, CURLINFO_HTTP_CODE );
		
		// url
		$result['last_url'] = curl_getinfo( $this->ch, CURLINFO_EFFECTIVE_URL );
		
		return $result;
	}
	
	
	/**
	 * Checking the string with json format with ability of return decoded
	 *
	 * @param $string
	 * @param bool $return_decoded
	 *
	 * @return mixed
	 */
	public static function may_be_json( $string, $return_decoded = true ) {
		$may_be_json = json_decode( $string, true );
		if ( $return_decoded ) {
			return ( json_last_error() === JSON_ERROR_NONE ) ? $may_be_json : $string;
		}
		
		return json_last_error() === JSON_ERROR_NONE;
	}
}
