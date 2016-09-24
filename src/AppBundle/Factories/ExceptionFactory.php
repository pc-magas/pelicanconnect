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
	
	/**
	 * Create an Exception That is used when status Does not have the correct value 
	 * @return \Exception
	 */
	public static function incorrectStatusValue()
	{
		return new \Exception("The status does not have the correct value");
	}
	
	/**
	 * Create an Exception when a param $paramName Does not have a value
	 * @param string $paramName
	 * @return \AppBundle\Exceptions\InvalidParamException
	 */
	public static function paramNotInsertedException($paramName)
	{
		return new InvalidParamException("You have not given correct value for ".$paramName." .");
	}
	
	/**
	 * Create an Exception when a param Does not have a Valid value
	 * 
	 * @param string $paramName
	 * @param string $paramType
	 * 
	 * @return InvalidArgumentException
	 */
	public static function invalidParamException($paramName,$paramType)
	{
		return new InvalidParamException("The $paramName is not a valid $paramType");
	}
}