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
	 * @param Request $request
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
//     /**
//      * Lists all Member entities.
//      *
//      */
//     public function indexAction()
//     {
//         $em = $this->getDoctrine()->getManager();

//         $members = $em->getRepository('AppBundle:Member')->findAll();

//         return $this->render('member/index.html.twig', array(
//             'members' => $members,
//         ));
//     }

//     /**
//      * Creates a new Member entity.
//      *
//      */
//     public function newAction(Request $request)
//     {
//         $member = new Member();
//         $form = $this->createForm('AppBundle\Form\MemberType', $member);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $em = $this->getDoctrine()->getManager();
//             $em->persist($member);
//             $em->flush();

//             return $this->redirectToRoute('member_show', array('id' => $member->getId()));
//         }

//         return $this->render('member/new.html.twig', array(
//             'member' => $member,
//             'form' => $form->createView(),
//         ));
//     }

//     /**
//      * Finds and displays a Member entity.
//      *
//      */
//     public function showAction(Member $member)
//     {
//         $deleteForm = $this->createDeleteForm($member);

//         return $this->render('member/show.html.twig', array(
//             'member' => $member,
//             'delete_form' => $deleteForm->createView(),
//         ));
//     }

//     /**
//      * Displays a form to edit an existing Member entity.
//      *
//      */
//     public function editAction(Request $request, Member $member)
//     {
//         $deleteForm = $this->createDeleteForm($member);
//         $editForm = $this->createForm('AppBundle\Form\MemberType', $member);
//         $editForm->handleRequest($request);

//         if ($editForm->isSubmitted() && $editForm->isValid()) {
//             $em = $this->getDoctrine()->getManager();
//             $em->persist($member);
//             $em->flush();

//             return $this->redirectToRoute('member_edit', array('id' => $member->getId()));
//         }

//         return $this->render('member/edit.html.twig', array(
//             'member' => $member,
//             'edit_form' => $editForm->createView(),
//             'delete_form' => $deleteForm->createView(),
//         ));
//     }

//     /**
//      * Deletes a Member entity.
//      *
//      */
//     public function deleteAction(Request $request, Member $member)
//     {
//         $form = $this->createDeleteForm($member);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $em = $this->getDoctrine()->getManager();
//             $em->remove($member);
//             $em->flush();
//         }

//         return $this->redirectToRoute('member_index');
//     }

//     /**
//      * Creates a form to delete a Member entity.
//      *
//      * @param Member $member The Member entity
//      *
//      * @return \Symfony\Component\Form\Form The form
//      */
//     private function createDeleteForm(Member $member)
//     {
//         return $this->createFormBuilder()
//             ->setAction($this->generateUrl('member_delete', array('id' => $member->getId())))
//             ->setMethod('DELETE')
//             ->getForm()
//         ;
//     }
}
