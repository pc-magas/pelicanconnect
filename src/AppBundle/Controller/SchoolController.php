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
}
