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


	/**
	 * Method that adds a new School in the database.
	 * @param string $name
	 * @return \AppBundle\Status\ActionStatus
	 */
	public function add($name)
	{
		$addArray=['name'=>$name];

		try
		{
			$school=$this->schoolManager->add($addArray);
			return StatusFactory::createStatusFromArrayAble($school);
		}
		catch (InvalidArgumentException $invalidArgument)
		{
			$this->logger->addError($invalidArgument->getMessage());
			return StatusFactory::createStatusFromException($invalidArgument);
		}
		catch (\Exception $e)
		{
			$this->logger->addError($e->getMessage());
			return StatusFactory::generalErrorStatus();
		}
	}
	
	/**
	 * Function that perfmorms all the Adding
	 * @param string $name The name of the participant
	 * @param string $email The email of the participant
	 * @param array $schools The fk of the schools
	 */
	public function search($name,$page=0,$limit=10,$desc=false)
	{
		$searchParams=['name'=>$name];
		
		$sortParams=array();
		$sortParams['name']=($desc)?'DESC':'ASC';
		
		try
		{
			/** @var Schoools[] */
			$members=$this->schoolManager->search($searchParams,$sortParams,$page,$limit);
			return StatusFactory::createStatusFromArrayAbleArray($members);
		}
		catch(\Exception $e)
		{
			$this->logger->addError($e->getMessage());
			return StatusFactory::generalErrorStatus();
		}
	}
}
