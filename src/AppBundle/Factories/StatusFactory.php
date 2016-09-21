<?php

namespace AppBundle\Factories;

use AppBundle\Status\ActionStatus;
use AppBundle\Entity\Member;
use AppBundle\Interfaces\ArrayAbleInterface;

class StatusFactory 
{
	/**
	 * Creates a general Error Status
	 * @return \AppBundle\Status\ActionStatus
	 */
	public static function generalErrorStatus()
	{
		$status=new ActionStatus();
		$status->setStatus(ActionStatus::STATUS_ERR)->setMessage('An Internal Error Occured');
		
		return $status;
	}
	
	/**
	 * Method that Generates a  status from an exception given
	 * @param \Exception $e
	 * @return \AppBundle\Status\ActionStatus
	 */
	public static function createStatusFromException(\Exception $e)
	{
		$status=new ActionStatus();
		
		$status->setStatus(ActionStatus::STATUS_ERR)->setMessage($e->getMessage());
		
		return $status;
	}
	
	/**
	 * Create a Status from an ArrayAble Item
	 * 
	 * @param Member $member
	 * @param ActionStatus | null $status
	 * 
	 * @return \AppBundle\Status\ActionStatus
	 */
	public static function createStatusFromArrayAble(ArrayAbleInterface $arrayAble)
	{
		$status = new ActionStatus();
		
		$status->setStatus(ActionStatus::STATUS_OK);
		$status->setData($arrayAble->toArray());
		
		return $status;
	}
	
}