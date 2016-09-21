<?php

namespace AppBundle\Entity;

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Interfaces\ArrayAbleInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="schools")
 */
class School implements ArrayAbleInterface
{
	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=200)
	 */
	private $name;

	/**
	 *
	 * @var unknown
	 */
	private $school_id;

	/**
	 * @var unknown
	 * @ORM\ManyToMany(targetEntity="Member", inversedBy="schools")
	 */
	private $members;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return School
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Add member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return School
     */
    public function addMember(\AppBundle\Entity\Member $member)
    {
        $this->members[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param \AppBundle\Entity\Member $member
     */
    public function removeMember(\AppBundle\Entity\Member $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     *
     * {@inheritDoc}
     * @see \AppBundle\Interfaces\ArrayAbleInterface::toArray()
     */
    public function toArray()
    {
    	$array=['id'=>$this->getId(),'name'=>$this->getName()];

    	return $array;
    }
}
