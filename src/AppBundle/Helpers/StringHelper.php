<?php

namespace AppBundle\Helpers;

use AppBundle\Factories\ExceptionFactory;

class StringHelper 
{
	/**
	 * Remove any html related tag from $string
	 * @param string $string
	 * @return string
	 */
	public static function removeHtml($string)
	{
		$string=trim($string);
		$string= html_entity_decode($string);
		$string=strip_tags($string);
		
		return $string;
	}

	/**
	 * Remove ant html tag and vaidates if $email is a valid $email
	 * @param string $email
	 * @return string
	 */
	public static function validateEmail($email)
	{
		$email=self::removeHtml($email);
		
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			throw ExceptionFactory::invalidParamException('email','email');
		}
		
		return $email;
	}
}