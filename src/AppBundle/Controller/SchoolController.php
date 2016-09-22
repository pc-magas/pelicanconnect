<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use AppBundle\Models\SchoolModel;
use AppBundle\Factories\ResponseFactory;

class SchoolController extends Controller
{

	/**
	 * @Route("add/schools",name="schools_add")
	 * @Method("POST")
	 *
	 * @param Request $request The Http Request given
	 */
	public function add(Request $request)
	{
		$name=$request->get('name');

		/** @var SchoolModel*/
		$model=$this->get('school_model');

		$status=$model->add($name);

		return ResponseFactory::createResponseFromStatus($status);
	}
	
	/**
	 * @Route("get/schools/{page}/{limit}",name="schools_search")
	 * @Method("GET")
	 *
	 * @param Request $request The Http Request given
	 * @param int | numeric string $page The page for pagination
	 * @param int | numeric string $limit The page size
	 */
	public function getSchool(Request $request,$page,$limit)
	{
		$name=$request->get('name');
		$desc=$request->get('desc');
	
		/** @var MembersModel*/
		$model=$this->get('school_model');
	
		$status=$model->search($name,$page,$limit,$desc);
	
		return ResponseFactory::createResponseFromStatus($status);
	}
}
