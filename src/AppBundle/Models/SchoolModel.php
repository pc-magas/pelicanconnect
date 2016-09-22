<?php

namespace AppBundle\Models;

use AppBundle\Managers\CRUD\SchoolManager;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use AppBundle\Factories\StatusFactory;
use Symfony\Bridge\Monolog\Logger;

class SchoolModel
{
	/**
	 * @var SchoolManager
	 */
	private $schoolManager;

	private $logger;

	public function __construct(SchoolManager $schoolManager, Logger $l)
	{
		$this->schoolManager=$schoolManager;
		$this->logger=$l;
	}


	public function add($name)
	{
		$addArray=['name'=>$name];

		try
		{
			$school=$this->schoolManager->add($addArray);
			return StatusFactory::createStatusFromArrayAble($school);
		}
		catch (InvalidArgumentException $invalidArguiment)
		{
			$this->logger->addError($invalidArgument->getMessage());
			return StatusFactory::createStatusFromException($invalidArgument);
		}
		catch (\Exception $e)
		{
			$this->logger->addError($exception->getMessage());
			return StatusFactory::generalErrorStatus();
		}
	}

}
