<?php

namespace AppBundle\Models;

use AppBundle\Managers\CRUD\MemberManager;
use AppBundle\Exceptions\InvalidParamException;
use AppBundle\Entity\Member;
use AppBundle\Factories\StatusFactory;
use Monolog\Logger;

/**
 * @author pcmagas
 * Models are the the Proxy and/or Adappter pattern based Class for implementing
 * of all the logic that requires to Add, Delete and Fetch a member(s)
 */
class MembersModel
{
	/**
	 * @var ParticipantManager
	 */
	private $memberManager;

	/**
	 * @var Logger
	 */
	private $logger;

	public function __construct(MemberManager $memberManager,Logger $l)
	{
		$this->memberManager=$memberManager;
		$this->logger=$l;
	}

	/**
	 * Function that perfmorms all the Adding
	 * @param string $name The name of the participant
	 * @param string $email The email of the participant
	 * @param array $schools The fk of the schools
	 */
	public function add($name,$email,array $schools)
	{
		$dataToAdd=['name'=>$name,'email'=>$email,'schools'=>$schools];

		try
		{
			/** @var Member */
			$member=$this->memberManager->add($dataToAdd);
			return StatusFactory::createStatusFromArrayAble($member);
		}
		catch(InvalidParamException $invalidArgument)
		{
			$this->logger->addError($invalidArgument->getMessage());
			return StatusFactory::createStatusFromException($invalidArgument);
		}
		catch(\Exception $exception)
		{
			$this->logger->addError($exception->getMessage());
			return StatusFactory::generalErrorStatus();
		}
	}


	public function search($name,$schools,$page=0,$limit=10,$desc=false)
	{
		$searchParams=['name'=>$name,'schools'=>$schools];

		$sortParams=array();

		$sortParams['name']=($desc)?'DESC':'ASC';

		try
		{
			/** @var Members[] */
			$members=$this->memberManager->search($searchParams,$sortParams,$page,$limit);
			return StatusFactory::createStatusFromArrayAbleArray($members);
		}
		catch(\Exception $e)
		{
			$this->logger->addError($e->getMessage());
			return StatusFactory::generalErrorStatus();
		}
	}

}
