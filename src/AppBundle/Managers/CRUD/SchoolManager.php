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
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Interfaces\CrudManagerInterface::search()
	 *
	 *
	 */
	public function search(array $searchParams, $page, $limit)
	{
		// TODO: Auto-generated method stub
	}


}
