<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Interfaces\ArrayAbleInterface;
use AppBundle\Helpers\StringHelper;
use Symfony\Component\Routing\Exception\InvalidParameterException;

/**
 * @ORM\Entity
 * @ORM\Table(name="members")
 */
class Member implements ArrayAbleInterface
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
     * @ORM\Column(type="string", length=100)
	 */
	private $email;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=100)
	 */
	private $name;

	/**
	 * @ORM\ManyToMany(targetEntity="School",mappedBy="members")
	 * @ORM\JoinTable(name="members_have_schools")
	 */
	private $schools;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->schools = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Member
     */
    public function setEmail($email)
    {
    	try 
    	{
        	$this->email = StringHelper::validateEmail($email);
    	}
    	catch(InvalidParamException $i)
    	{
    		throw $i;	
    	}
    	
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add school
     *
     * @param \AppBundle\Entity\School $school
     *
     * @return Member
     */
    public function addSchool(\AppBundle\Entity\School $school)
    {
    	$school->addMember($this);
        $this->schools[] = $school;

        return $this;
    }

    /**
     * Remove school
     *
     * @param \AppBundle\Entity\School $school
     */
    public function removeSchool(\AppBundle\Entity\School $school)
    {
        $this->schools->removeElement($school);
    }

    /**
     * Get schools
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchools()
    {
        return $this->schools;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Member
     */
    public function setName($name)
    {
        $this->name = StringHelper::removeHtml($name);

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     * @see \AppBundle\Interfaces\ArrayAbleInterface::toArray()
     */
    public function toArray()
    {
    	$array=['id'=>$this->getId(),'name'=>$this->getName(),'email'=>$this->getEmail(),'schools'=>array()];

    	$schools=$this->getSchools()->getValues();

    	foreach($schools as $school)
    	{
    		$array['schools'][]=$school->toArray();
    	}

    	return $array;
    }
}
