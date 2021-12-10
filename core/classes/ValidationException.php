<?php


class ValidationException extends Exception
{
	public $errors;

	function __construct( $errors )
	{
		$this->errors = $errors;
	}

	public function getError()
	{
		return $this->errors;
	}
}
