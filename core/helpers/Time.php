<?php


class Time
{

	public static function get( string $time_created, string $time_updated = '0000-00-00 00:00:00', string $time_format = 'Y-m-d H:i' ) : string
	{
		$time = $time_updated != '0000-00-00 00:00:00' ? $time_updated : $time_created;
		$time = date( $time_format, strtotime( $time ) );

		return $time;
	}

}
