<?php

namespace AppBundle\Managers\CRUD;

use AppBundle\Interfaces\CrudManagerInterface;
use AppBundle\Factories\ExceptionFactory;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Member;
use AppBundle\Helpers\PaginatorHelper;

/**
 * @author pcmagas
 * This class is used in order to add Edit and Delete participants from the Database.
 * I use it as Adapter/Proxy Class In order not to access Directly the Database Handling Classes.
 */
class MemberManager implements CrudManagerInterface
{

	/**
	 * @var EntityManager
	 */
	private $entityManager=null;


	public function __construct(EntityManager $em)
	{
		$this->entityManager=$em;
	}

	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\CrudManagerInterface::add()
	 *
	 * @param array $dataToAdd
	 *
	 * $dataToAdd Must Have theeese values
	 *
	 * 'name':  string For the Participant's name
	 * 'email': string  For the participant's email
	 * 'schools': array That must at least One integer value that is the foreighn key for the School
	 *
	 * @return Member
	 */
	public function add(array $dataToAdd)
	{
		//Validating the entry data
		if(!isset($dataToAdd['name']))
		{
			throw ExceptionFactory::paramNotInsertedException('name');
		}

		if(!isset($dataToAdd['email']))
		{
			throw ExceptionFactory::paramNotInsertedException('email');
		}

		if(!empty($dataToAdd['schools']) && !is_array($dataToAdd['schools']))
		{
			throw ExceptionFactory::paramNotInsertedException('schools');
		}

		$member=new Member();

		$member->setName($dataToAdd['name'])->setEmail($dataToAdd['email']);

		$schoolRepository=$this->entityManager->getRepository('AppBundle:School');
		$foundSchools=array();

		if(!empty($dataToAdd['schools']))
		{
			if(!is_array($dataToAdd['schools']))
			{
				$dataToAdd['schools']=[$dataToAdd['schools']];
			}

			foreach($dataToAdd['schools'] as $school)
			{
				$school=$schoolRepository->findOneById(intval($school));
				$member->addSchool($school);

				$foundSchools[]=$school;
			}
		}

		$this->entityManager->persist($member);
		$this->entityManager->flush();

		return $member;
	}

	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\CrudManagerInterface::edit()
	 */
	public function edit(array $changedData)
	{
		//TODO:Implemeent Member Edit if requested
	}

	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\CrudManagerInterface::delete()
	 */
	public function delete(array $changedData)
	{
		//TODO:Impplement Member Dellete if requested
	}

	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\CrudManagerInterface::search()
	 *
	 * @return Member[]
	 */
	public function search(array $searchParams, array $order , $page, $limit)
	{
		/**
		 * @var \Doctrine\Common\Persistence\ObjectRepository $queryBuilder
		 */
		$queryBuilder=$this->entityManager->createQueryBuilder();

		$queryBuilder=$queryBuilder->select('m')->from('AppBundle:Member','m');

		if(!empty($searchParams['name']))
		{
			$queryBuilder->andWhere('m.name LIKE :name')->setParameter('name','%'.$searchParams['name'].'%');
		}

		if(!empty($searchParams['schools']))
		{
			if(!is_array($searchParams['schools']))
			{
				$searchParams['schools']=[$searchParams['schools']];
			}

			$queryBuilder->join('m.schools','s')->andWhere('s.id IN (:schools)')->setParameters(['schools'=>$searchParams['schools']]);
		}

		if(!empty($order))
		{
			if(isset($searchParams['name']))
			{
				$queryBuilder->addOrderBy('m.name',$order['name']);
			}
		}


		/**
		 * @var Doctrine\ORM\Query
		 */
		$query=$queryBuilder->getQuery();

		$limit=(int)$limit;
		$page=(int)$page;
		$query=PaginatorHelper::paginateQuery($query, $page, $limit);
		
		$queryString=$query->getDql();

		$results=$query->getResult();
		return $results;
	}
}
