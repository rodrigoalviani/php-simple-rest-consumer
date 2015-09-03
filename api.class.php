<?php
class Api {
	private static $endPoint;

	public function __construct($url) {
		self::$endPoint = $url;
	}

	public static function get($method, $header) {
		return self::fetch($method, 'GET', $header);
	}

	public static function post($method, $post, $header) {
		return self::fetch($method, 'POST', $header, $post);
	}

	public static function put($method, $put, $header) {
		return self::fetch($method, 'PUT', $header, $put);
	}

	public static function delete($method, $header) {
		return self::fetch($method, 'DELETE', $header);
	}

	private static function fetch($method, $verb = 'GET', $header = '', $post = false, $timeout = 5) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$endPoint . $method);
		if ($verb !== 'GET' && $verb !== 'POST') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
		}

		if ($header) {
			curl_setopt($ch, CURLOPT_HEADER, false);
		} else {
			curl_setopt($ch, CURLOPT_HEADER, true);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		if (is_array($post)) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		} elseif ($post) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		if (is_array($header)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
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
