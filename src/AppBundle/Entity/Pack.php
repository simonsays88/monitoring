<?php

// src/AppBundle/Entity/Pack.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Initial;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PackRepository")
 * @ORM\Table(name="pack")
 */
class Pack {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Initial", inversedBy="packs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $initial;

    /**
     * @ORM\OneToMany(targetEntity="Result", mappedBy="pack")
     */
    private $results;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="pack_type_id", type="integer", nullable=true)
     */
    private $pack_type_id;

    /**
     * @var string
     *
     * @ORM\Column(name="pack_name", type="string", nullable=true)
     */
    private $pack_name;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_step", type="integer", nullable=true)
     */
    private $nbStep;

    /**
     * @var int
     *
     * @ORM\Column(name="step", type="integer", nullable=true)
     */
    private $step;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_days", type="integer", nullable=true)
     */
    private $nbDays = 0;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;
    
    /**
     * @var \Date
     * 
     * @ORM\Column(name="started_at", type="date", nullable=true)
     */
    private $startedAt;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('new', 'ongoing', 'finished', 'pause')", nullable=false)
     */
    protected $status;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set initial
     *
     * @param \AppBundle\Entity\Initial $initial
     *
     * @return Pack
     */
    public function setInitial(\AppBundle\Entity\Initial $initial) {
        $this->initial = $initial;

        return $this;
    }

    /**
     * Get initial
     *
     * @return \AppBundle\Entity\Initial
     */
    public function getInitial() {
        return $this->initial;
    }


    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Pack
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set nbStep
     *
     * @param integer $nbStep
     *
     * @return Pack
     */
    public function setNbStep($nbStep)
    {
        $this->nbStep = $nbStep;

        return $this;
    }

    /**
     * Get nbStep
     *
     * @return integer
     */
    public function getNbStep()
    {
        return $this->nbStep;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Pack
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set startedAt
     *
     * @param \DateTime $startedAt
     *
     * @return Pack
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Get startedAt
     *
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }


    /**
     * Set step
     *
     * @param integer $step
     *
     * @return Pack
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return integer
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set packTypeId
     *
     * @param integer $packTypeId
     *
     * @return Pack
     */
    public function setPackTypeId($packTypeId)
    {
        $this->pack_type_id = $packTypeId;

        return $this;
    }

    /**
     * Get packTypeId
     *
     * @return integer
     */
    public function getPackTypeId()
    {
        return $this->pack_type_id;
    }

    /**
     * Set packName
     *
     * @param string $packName
     *
     * @return Pack
     */
    public function setPackName($packName)
    {
        $this->pack_name = $packName;

        return $this;
    }

    /**
     * Get packName
     *
     * @return string
     */
    public function getPackName()
    {
        return $this->pack_name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->results = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add result
     *
     * @param \AppBundle\Entity\Result $result
     *
     * @return Pack
     */
    public function addResult(\AppBundle\Entity\Result $result)
    {
        $this->results[] = $result;

        return $this;
    }

    /**
     * Remove result
     *
     * @param \AppBundle\Entity\Result $result
     */
    public function removeResult(\AppBundle\Entity\Result $result)
    {
        $this->results->removeElement($result);
    }

    /**
     * Get results
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Set nbDays
     *
     * @param integer $nbDays
     *
     * @return Pack
     */
    public function setNbDays($nbDays)
    {
        $this->nbDays = $nbDays;

        return $this;
    }

    /**
     * Get nbDays
     *
     * @return integer
     */
    public function getNbDays()
    {
        return $this->nbDays;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Pack
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
