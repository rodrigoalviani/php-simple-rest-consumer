<?php
class Api {
	private static $endPoint;

	public function __construct($url) {
		self::$endPoint = $url;
	}

	public static function get($method) {
		return self::fetch($method);
	}

	public static function post($method, $post) {
		return self::fetch($method, 'POST', $post);
	}

	public static function put($method, $put) {
		return self::fetch($method, 'PUT', $put);
	}

	public static function delete($method) {
		return self::fetch($method, 'DELETE');
	}

	private static function fetch($method, $verb = 'GET', $post = false) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$endPoint . $method);
		if ($verb !== 'GET' && $verb !== 'POST') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
		}
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		if (is_array($post)) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		}

		try {
			$response = curl_exec($ch);
			$header = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$realUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		} catch (Exception $e) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		curl_close($ch);

		return array('header' => $header, 'response' => $response, 'realUrl' => $realUrl);
	}
}
