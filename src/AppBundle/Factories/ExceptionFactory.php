<?php

namespace AppBundle\Factories;

use AppBundle\Exceptions\InvalidParamException;
use \Exception;
/**
 * @author pcmagas
 * Factory class that creates All the required Exceptions depending the situation
 */
class ExceptionFactory 
{
	
	public static function incorrectStatusValue()
	{
		return new \Exception("The status does not have the correct value");
	}
	
	public static function paramNotInsertedException($paramName)
	{
		return new InvalidParamException("You have not given correct value for ".$paramName." .");
	}
}