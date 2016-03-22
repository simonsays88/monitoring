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

    const STATUS_NEW = 'new';
    const STATUS_ONGOING = 'ongoing';
    const STATUS_FINISHED = 'finished';
    const NB_DAYS = 84;
    const THEME = 'themes';
    const FOOD = 'food';
    const FOOD_BODY = 'food_body';
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
     * @var string
     *
     * @ORM\Column(name="pack_type", type="string", columnDefinition="ENUM('themes', 'food', 'food_body')", nullable=false)
     */
    private $pack_type;

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
     * @var int
     *
     * @ORM\Column(name="days_left", type="integer", nullable=true)
     */
    private $daysLeft = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ebook_recipes", type="boolean")
     */
    private $ebookRecipes = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ebook_tips", type="boolean")
     */
    private $ebookTips = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ebook_double", type="boolean")
     */
    private $ebookDouble = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ebook", type="boolean")
     */
    private $ebook = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="videos", type="boolean")
     */
    private $videos = 0;

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

    /**
     * Set daysLeft
     *
     * @param integer $daysLeft
     *
     * @return Pack
     */
    public function setDaysLeft($daysLeft)
    {
        $this->daysLeft = $daysLeft;

        return $this;
    }

    /**
     * Get daysLeft
     *
     * @return integer
     */
    public function getDaysLeft()
    {
        return $this->daysLeft;
    }

    /**
     * Set packType
     *
     * @param string $packType
     *
     * @return Pack
     */
    public function setPackType($packType)
    {
        $this->pack_type = $packType;

        return $this;
    }

    /**
     * Get packType
     *
     * @return string
     */
    public function getPackType()
    {
        return $this->pack_type;
    }

    /**
     * Set ebookRecipes
     *
     * @param boolean $ebookRecipes
     *
     * @return Pack
     */
    public function setEbookRecipes($ebookRecipes)
    {
        $this->ebookRecipes = $ebookRecipes;

        return $this;
    }

    /**
     * Get ebookRecipes
     *
     * @return boolean
     */
    public function getEbookRecipes()
    {
        return $this->ebookRecipes;
    }

    /**
     * Set ebookTips
     *
     * @param boolean $ebookTips
     *
     * @return Pack
     */
    public function setEbookTips($ebookTips)
    {
        $this->ebookTips = $ebookTips;

        return $this;
    }

    /**
     * Get ebookTips
     *
     * @return boolean
     */
    public function getEbookTips()
    {
        return $this->ebookTips;
    }


    /**
     * Set ebook
     *
     * @param boolean $ebook
     *
     * @return Pack
     */
    public function setEbook($ebook)
    {
        $this->ebook = $ebook;

        return $this;
    }

    /**
     * Get ebook
     *
     * @return boolean
     */
    public function getEbook()
    {
        return $this->ebook;
    }

    /**
     * Set videos
     *
     * @param boolean $videos
     *
     * @return Pack
     */
    public function setVideos($videos)
    {
        $this->videos = $videos;

        return $this;
    }

    /**
     * Get videos
     *
     * @return boolean
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * Set ebookDouble
     *
     * @param boolean $ebookDouble
     *
     * @return Pack
     */
    public function setEbookDouble($ebookDouble)
    {
        $this->ebookDouble = $ebookDouble;

        return $this;
    }

    /**
     * Get ebookDouble
     *
     * @return boolean
     */
    public function getEbookDouble()
    {
        return $this->ebookDouble;
    }

    public function getOptions(){
        $options = array();

        if($this->getEbookRecipes()){
            $options[] = "Ebook de recettes";
        }
        if($this->getEbookTips()){
            $options[] = "Ebook d'astuces et menus types";
        }
        if($this->getEbook()){
            $options[] = "Ebook";
        }
        if($this->getVideos()){
            $options[] = "Vidéos";
        }
        if($this->getEbookDouble()){
            $options[] = "Double Ebook";
        }

        return $options;
    }
}
