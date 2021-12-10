<?php

class Site
{

	/**
	 * Pagination
	 */
	public static function pagination( array $pagination ) : void
	{
		require('./app/views/pagination.php' );
	}

	/**
	 * Redirect
	 */
	public static function redirect( string $location ) : void
	{
		header( "Location:". $location );
	}

	/**
	 * Title
	 */
	public static function title( $title, string $separator = '#' ) : string
	{
		$name = GENERAL_CONFIG['Site_name'];

		if ( ! empty( $title ) ) {
			$title = $title . ' ' . $separator . ' ' . $name;
		} else {
			$title = $name;
		}

		return $title;
	}

}
