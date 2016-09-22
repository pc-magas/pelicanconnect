<?php

namespace AppBundle\Managers\CRUD;

use AppBundle\Interfaces\CrudManagerInterface;
use AppBundle\Entity\School;
use Doctrine\ORM\EntityManager;

class SchoolManager implements CrudManagerInterface
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
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Interfaces\CrudManagerInterface::add()
	 *
	 * @return School
	 */
	public function add(array $dataToAdd)
	{
		//Validating the entry data
		if(!isset($dataToAdd['name']))
		{
			throw ExceptionFactory::paramNotInsertedException('name');
		}

		$school= new School();

		$school->setName($dataToAdd['name']);

		$this->entityManager->persist($school);
		$this->entityManager->flush();

		return $school;
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Interfaces\CrudManagerInterface::delete()
	 */
	public function delete(array $changedData)
	{
		// TODO: Auto-generated method stub
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Interfaces\CrudManagerInterface::edit()
	 */
	public function edit(array $changedData)
	{
		// TODO: Auto-generated method stub
	}

	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Interfaces\CrudManagerInterface::search()
	 */
	public function search(array $searchParams, array $order, $page, $limit) 
	{
		/**
		 * @var \Doctrine\Common\Persistence\ObjectRepository $queryBuilder
		 */
		$queryBuilder=$this->entityManager->createQueryBuilder();
		
		$queryBuilder=$queryBuilder->select('m')->from('AppBundle:School','m');
		
		if(!empty($searchParams['name']))
		{
			$queryBuilder->andWhere('m.name LIKE :name')->setParameter('name','%'.$searchParams['name'].'%');
		}
		
		if(!empty($order))
		{
			if(isset($searchParams['name']))
			{
				$queryBuilder->addOrderBy('m.name',$order['name']);
			}
		}
		
		if((int)$limit>0)
		{
			$queryBuilder->setFirstResult((int)$page)->setMaxResults($limit);
		}
				
		/**
		 * @var Doctrine\ORM\Query
		 */
		$query=$queryBuilder->getQuery();
		
		$queryString=$query->getDql();
		
		$results=$query->getResult();
		return $results;
	}


}
