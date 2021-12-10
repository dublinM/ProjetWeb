<?php

class Email
{

	/**
	 * Validate
	 */
	public static function validate( string $email ) : void
	{
		if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			$errors[] = 'Adresse email invalide';
		}

		if ( ! empty( $errors ) ) {
			throw new ValidationException( $errors );
		}
	}

}
