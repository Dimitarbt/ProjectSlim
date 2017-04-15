<?php


namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class IsUsernameAvailableException extends ValidationException {

	public static $defaultTemplates=[

	self::MODE_DEFAULT =>[

	   self::STANDARD => 'Username is already taken. Please try again.',
	],
	];

}