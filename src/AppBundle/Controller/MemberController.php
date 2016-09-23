<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


use AppBundle\Entity\Member;
use AppBundle\Form\MemberType;
use AppBundle\Factories\ResponseFactory;
use AppBundle\Models\MembersModel;

/**
 * Member controller.
 */
class MemberController extends Controller
{
	
	/**
	 * @Route("add/member",name="members_add")
	 * @Method("POST")
	 * 
	 * @param Request $request The Http Request given
	 */
	public function add(Request $request)
	{
		$name=$request->get('name');
		$email=$request->get('email');
		$schools=$request->get('schools');
		
		/** @var MembersModel*/
		$model=$this->get('member_model');
		
		$status=$model->add($name,$email,$schools);
		
		return ResponseFactory::createResponseFromStatus($status);
	}
	
	/**
	 * @Route("get/members/{page}/{limit}",name="members_search")
	 * @Method("GET")
	 * 
	 * @param Request $request The Http Request given
	 * @param int | numeric string $page The page for pagination
	 * @param int | numeric string $limit The page size
	 */
	public function getMember(Request $request,$page,$limit)
	{
		$name=$request->get('name');
		$schools=$request->get('schools');
		$desc=$request->get('desc');
		
		/** @var MembersModel*/
		$model=$this->get('member_model');
		
		$status=$model->search($name,$schools,$page,$limit,$desc);
		
		return ResponseFactory::createResponseFromStatus($status);
	}

}
