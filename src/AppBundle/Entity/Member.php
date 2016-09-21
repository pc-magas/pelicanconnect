<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="members")
 */
class Member 
{
	/**
	 * @var int 
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
   	 * @ORM\Column(type="string", length=20)
	 */
	private $email;
	
	
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
        $this->email = $email;

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
}
