<?php


class User
{

	public static function author( int $author_id ) : bool
	{
		return $_SESSION['user']['id'] == $author_id ? true : false;
	}


	public static function gravatar( string $email, int $s = 64, string $d = 'monsterid', string $r = 'g', bool $img = false, array $atts = array() ) : string
	{
		$url  = 'https://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= '?s=' . $s . '&d=' . $d . '&r=' . $r;

		if ( $img ) {
			$url = '<img src="' . $url . '"';

			foreach ( $atts as $key => $val ) {
				$url .= ' ' . $key . '="' . $val . '"';
			}

			$url .= ' />';
		}

		return $url;
	}


	public static function login() : bool
	{
		return isset( $_SESSION['user'] ) ? true : false;
	}


	public static function panel() : void
	{
		require_once('./app/views/users/panel.php' );
	}


	public static function role( array $roles ) : bool
	{
		return in_array( $_SESSION['user']['role'], $roles ) ? true : false;
	}

}
