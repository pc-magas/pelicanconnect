<?php

namespace AppBundle\Factories;

use AppBundle\Status\ActionStatus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class ResponseFactory 
{
	public static function createResponseFromStatus(ActionStatus $actionStatus)
	{
		
		$response=new JsonResponse($actionStatus->toArray());
		
		if($actionStatus->getStatus()===ActionStatus::STATUS_ERR)
		{			
			$response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
		}
		
		return $response;
	}
}