<?php


class Str
{

	/**
	 * Clean
	 */
	public static function clean( string $value, bool $tags = true ) : string
	{
		$value = trim( $value );
		$value = stripslashes( $value );

		if ( $tags === true ) {
			$value = strip_tags( $value );
			$value = htmlspecialchars( $value );
		}

		return $value;
	}

	/**
	 * Random
	 */
	public static function random( int $length = 10 ) : string
	{
		$characters  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters .= 'abcdefghijklmnopqrstuvwxyz';
		$characters .= '0123456789';

		$characters_length = strlen( $characters );

		for ( $i = 0; $i < $length; $i++ ) {
			$random_name .= $characters[rand( 0, $characters_length - 1 )];
		}

		return $random_name;
	}

	/**
	 * Validate
	 */
	public static function validate( string $value, bool $required = false, int $length = 0 ) : void
	{
		if ( $required === true ) {
			if ( empty( $value ) ) {
				$errors[] = 'Champs obligatoire non rempli !.';
			}
		}

		if ( $length !== 0 ) {
			if ( mb_strlen( $value, 'utf-8' ) > $length ) {
				$errors[] = 'Chaine de caractere trop grande !';
			}
		}

		if ( ! empty( $errors ) ) {
			throw new ValidationException( $errors );
		}
	}

}
