<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 *
 * @ORM\Table(name="result")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Result
{

    const TWO_WEEKS_FOOD_BODY = 'two_weeks_food_body';
    const FOUR_WEEKS_FOOD_BODY = 'four_weeks_food_body';
    const TWO_WEEKS_FOOD = 'two_weeks_food';
    const FOUR_WEEKS_FOOD = 'four_weeks_food';
    const ESTHETIC = 'esthetic';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Pack", inversedBy="results")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pack;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255, nullable=true)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="imc", type="string", length=255, nullable=true)
     */
    private $imc;

    /**
     * @var string
     *
     * @ORM\Column(name="shoulders", type="string", length=255, nullable=true)
     */
    private $shoulders;

    /**
     * @var string
     *
     * @ORM\Column(name="pectorals", type="string", length=255, nullable=true)
     */
    private $pectorals;

    /**
     * @var string
     *
     * @ORM\Column(name="arms", type="string", length=255, nullable=true)
     */
    private $arms;

    /**
     * @var string
     *
     * @ORM\Column(name="hip_size", type="string", length=255, nullable=true)
     */
    private $hipSize;

    /**
     * @var string
     *
     * @ORM\Column(name="thighs", type="string", length=255, nullable=true)
     */
    private $thighs;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_front", type="string", length=255, nullable=true)
     */
    private $photoFront;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_side", type="string", length=255, nullable=true)
     */
    private $photoSide;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_back", type="string", length=255, nullable=true)
     */
    private $photoBack;

    /**
     * @var boolean
     *
     * @ORM\Column(name="completed", type="boolean")
     */
    private $completed = 0;

    /**
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="result_type", type="string", columnDefinition="ENUM('two_weeks_food_body', 'four_weeks_food_body', 'two_weeks_food', 'four_weeks_food', 'esthetic')", nullable=false)
     */
    protected $resultType;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Result
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set shoulders
     *
     * @param string $shoulders
     *
     * @return Result
     */
    public function setShoulders($shoulders)
    {
        $this->shoulders = $shoulders;

        return $this;
    }

    /**
     * Get shoulders
     *
     * @return string
     */
    public function getShoulders()
    {
        return $this->shoulders;
    }

    /**
     * Set pectorals
     *
     * @param string $pectorals
     *
     * @return Result
     */
    public function setPectorals($pectorals)
    {
        $this->pectorals = $pectorals;

        return $this;
    }

    /**
     * Get pectorals
     *
     * @return string
     */
    public function getPectorals()
    {
        return $this->pectorals;
    }

    /**
     * Set arms
     *
     * @param string $arms
     *
     * @return Result
     */
    public function setArms($arms)
    {
        $this->arms = $arms;

        return $this;
    }

    /**
     * Get arms
     *
     * @return string
     */
    public function getArms()
    {
        return $this->arms;
    }

    /**
     * Set hipSize
     *
     * @param string $hipSize
     *
     * @return Result
     */
    public function setHipSize($hipSize)
    {
        $this->hipSize = $hipSize;

        return $this;
    }

    /**
     * Get hipSize
     *
     * @return string
     */
    public function getHipSize()
    {
        return $this->hipSize;
    }

    /**
     * Set thighs
     *
     * @param string $thighs
     *
     * @return Result
     */
    public function setThighs($thighs)
    {
        $this->thighs = $thighs;

        return $this;
    }

    /**
     * Get thighs
     *
     * @return string
     */
    public function getThighs()
    {
        return $this->thighs;
    }

    /**
     * Set photoFront
     *
     * @param string $photoFront
     *
     * @return Result
     */
    public function setPhotoFront($photoFront)
    {
        $this->photoFront = $photoFront;

        return $this;
    }

    /**
     * Get photoFront
     *
     * @return string
     */
    public function getPhotoFront()
    {
        return $this->photoFront;
    }

    /**
     * Set photoSide
     *
     * @param string $photoSide
     *
     * @return Result
     */
    public function setPhotoSide($photoSide)
    {
        $this->photoSide = $photoSide;

        return $this;
    }

    /**
     * Get photoSide
     *
     * @return string
     */
    public function getPhotoSide()
    {
        return $this->photoSide;
    }

    /**
     * Set photoBack
     *
     * @param string $photoBack
     *
     * @return Result
     */
    public function setPhotoBack($photoBack)
    {
        $this->photoBack = $photoBack;

        return $this;
    }

    /**
     * Get photoBack
     *
     * @return string
     */
    public function getPhotoBack()
    {
        return $this->photoBack;
    }

    /**
     * Set pack
     *
     * @param \AppBundle\Entity\Pack $pack
     *
     * @return Result
     */
    public function setPack(\AppBundle\Entity\Pack $pack)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return \AppBundle\Entity\Pack
     */
    public function getPack()
    {
        return $this->pack;
    }

    /**
     * Set completed
     *
     * @param boolean $completed
     *
     * @return Result
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return boolean
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set imc
     *
     * @param string $imc
     *
     * @return Result
     */
    public function setImc($imc)
    {
        $this->imc = $imc;

        return $this;
    }

    /**
     * Get imc
     *
     * @return string
     */
    public function getImc()
    {
        return $this->imc;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Result
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
     * Set resultType
     *
     * @param string $resultType
     *
     * @return Result
     */
    public function setResultType($resultType)
    {
        $this->resultType = $resultType;

        return $this;
    }

    /**
     * Get resultType
     *
     * @return string
     */
    public function getResultType()
    {
        return $this->resultType;
    }
}
