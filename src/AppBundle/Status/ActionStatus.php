<?php

namespace AppBundle\Status;

use AppBundle\Factories\ExceptionFactory;
use AppBundle\Interfaces\ArrayAbleInterface;

class ActionStatus implements ArrayAbleInterface
{
	const STATUS_OK=true;
	const STATUS_ERR=false;
	
	/**
	 * @var boolean
	 */
	private $status;
	
	/**
	 * @var string
	 */
	private $message;
	
	/**
	 * @var mixed
	 */
	private $data;
	
	/**
	 * @param boolean $newStatus
	 * @return ActionStatus
	 */
	public function setStatus($newStatus)
	{	
		$this->status=$newStatus;
		
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function getStatus()
	{
		return $this->status;
	}
	
	
	
	/**
	 * @param string $newMessage
	 * @return ActionStatus
 	 */
	public function setMessage($newMessage)
	{
		$this->message=$newMessage;
		
		return $this;
	}
	
	/**
	 * @return string
	 * return $this;
	 */
	public function getMessage()
	{
		return $this->message;
	}
	
	/**
	 * @param mixed $data
	 * @return ActionStatus
	 */
	public function setData($data)
	{
		$this->data=$data;
		
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getData()
	{
		return $this->data;		
	}
	
	/**
	 * @return mixed[]
	 */
	public function toArray()
	{
		$responseArray=['status'=>$this->getStatus(),'message'=>$this->getMessage(),'data'=>$this->getData()];
		return $responseArray;
	}
}