<?php

class Login_api {
	public $email = '';
	public $pass = '';

	function __construct( $email, $pass ) {
		$this->email = $email;
		$this->pass  = $pass;
	}

	function remote_access() {
		$body = array(
			'email'    => $this->email,
			'password' => $this->pass,
		);

		$response = wp_remote_post(
			'https://symfony-skeleton.q-tests.com/api/v2/token',
			array(
				'data_format' => 'body',
				'headers'     => [
					'Accept'       => 'application/json',
					'Content-Type' => 'application/json'
				],
				'body'        => json_encode( $body ),
			)
		);

		if ( 200 == $response['response']['code'] ) {

			$response_body  = json_decode( $response['http_response']->get_response_object()->body );
			$response_token = $response_body->token_key;

			if ( ! isset( $_COOKIE['wpb_custom_login'] ) ) {
				setcookie( 'wpb_custom_login', $response_token, time() + 3600 );

				return true;
			}
		}

		return false;
	}
}

if ( isset( $_POST["wp-submit"] ) ) {

	?><div class="mytheme-test-results"><?php

	if ( isset( $_POST["log"] ) && ( $_POST["pwd"] ) ) {

		$login_api = new Login_api( strip_tags( $_POST["log"] ), strip_tags( $_POST["pwd"] ) );

// Classic view without constructor //
//		$login_api        = new login_api;
//		$login_api->email = strip_tags($_POST["log"]);
//		$login_api->pass  = strip_tags($_POST["pwd"]);

		if ( $login_api->remote_access() ) {
			echo "Success";
		} else {
			echo "Invalid";
		}

	} else {
		echo 'Not set Username and Password';
	}
	?></div><?php
}
?>


