<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\ResultExercise;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\Image(
     *     allowLandscape = false,
     * )
     * @ORM\Column(name="photo_front", type="string", length=255, nullable=true)
     */
    private $photoFront;

    /**
     * @var string
     * @Assert\Image(
     *     allowLandscape = false,
     * )
     * @ORM\Column(name="photo_side", type="string", length=255, nullable=true)
     */
    private $photoSide;

    /**
     * @var string
     * @Assert\Image(
     *     allowLandscape = false,
     * )
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
     * @var string
     *
     * @ORM\Column(name="feedback", type="text", nullable=true)
     */
    private $feedback;

    /**
     * @var string
     *
     * @ORM\Column(name="method", type="text", nullable=true)
     */
    private $method;

    /**
     * @var string
     *
     * @ORM\Column(name="recovery", type="text", nullable=true)
     */
    private $recovery;

    /**
     * @var string
     *
     * @ORM\Column(name="performance", type="text", nullable=true)
     */
    private $performance;

    /**
     * @var string
     *
     * @ORM\Column(name="feeling", type="text", nullable=true)
     */
    private $feeling;

    /**
     * @var string
     *
     * @ORM\Column(name="evaluation", type="integer", nullable=true)
     */
    private $evaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="fail", type="text", nullable=true)
     */
    private $fail;

    /**
     * @var string
     *
     * @ORM\Column(name="tips", type="text", nullable=true)
     */
    private $tips;

    /**
     * @var string
     *
     * @ORM\Column(name="physical_change", type="text", nullable=true)
     */
    private $physicalChange;

    /**
     * @var string
     *
     * @ORM\Column(name="questions", type="text", nullable=true)
     */
    private $questions;
    
    /**
     * @ORM\OneToMany(targetEntity="ResultExercise", mappedBy="result", cascade={"all"})
     * */
    protected $resultExercise;

    protected $exercises;

    public function __construct()
    {
        $this->resultExercise = new \Doctrine\Common\Collections\ArrayCollection();
        $this->exercises = new \Doctrine\Common\Collections\ArrayCollection();
    }
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

    /**
     * Set feedback
     *
     * @param string $feedback
     *
     * @return Result
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get feedback
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return Result
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set recovery
     *
     * @param string $recovery
     *
     * @return Result
     */
    public function setRecovery($recovery)
    {
        $this->recovery = $recovery;

        return $this;
    }

    /**
     * Get recovery
     *
     * @return string
     */
    public function getRecovery()
    {
        return $this->recovery;
    }

    /**
     * Set performance
     *
     * @param string $performance
     *
     * @return Result
     */
    public function setPerformance($performance)
    {
        $this->performance = $performance;

        return $this;
    }

    /**
     * Get performance
     *
     * @return string
     */
    public function getPerformance()
    {
        return $this->performance;
    }

    /**
     * Set feeling
     *
     * @param string $feeling
     *
     * @return Result
     */
    public function setFeeling($feeling)
    {
        $this->feeling = $feeling;

        return $this;
    }

    /**
     * Get feeling
     *
     * @return string
     */
    public function getFeeling()
    {
        return $this->feeling;
    }

    /**
     * Set evaluation
     *
     * @param integer $evaluation
     *
     * @return Result
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get evaluation
     *
     * @return integer
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Set fail
     *
     * @param string $fail
     *
     * @return Result
     */
    public function setFail($fail)
    {
        $this->fail = $fail;

        return $this;
    }

    /**
     * Get fail
     *
     * @return string
     */
    public function getFail()
    {
        return $this->fail;
    }

    /**
     * Set tips
     *
     * @param string $tips
     *
     * @return Result
     */
    public function setTips($tips)
    {
        $this->tips = $tips;

        return $this;
    }

    /**
     * Get tips
     *
     * @return string
     */
    public function getTips()
    {
        return $this->tips;
    }

    /**
     * Set physicalChange
     *
     * @param string $physicalChange
     *
     * @return Result
     */
    public function setPhysicalChange($physicalChange)
    {
        $this->physicalChange = $physicalChange;

        return $this;
    }

    /**
     * Get physicalChange
     *
     * @return string
     */
    public function getPhysicalChange()
    {
        return $this->physicalChange;
    }

    /**
     * Set questions
     *
     * @param string $questions
     *
     * @return Result
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * Get questions
     *
     * @return string
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    public function __toString()
    {
        return $this->id;
    }

    public function getExercise()
    {
        $exercises = new \Doctrine\Common\Collections\ArrayCollection();

        foreach($this->resultExercise as $r)
        {
            $exercises[] = $r->getExercise();
        }

        return $exercises;
    }

    public function setExercise($exercises)
    {
        foreach($exercises as $r)
        {
            $re = new ResultExercise();

            $re->setResult($this);
            $re->setExercise($r);

            $this->addResultExercise($re);
        }

    }

    public function getResult()
    {
        return $this;
    }

    public function addResultExercise($resultExercise)
    {
        $this->resultExercise[] = $resultExercise;
    }

    public function removePo($resultExercise)
    {
        return $this->resultExercise->removeElement($resultExercise);
    }


    /**
     * Remove resultExercise
     *
     * @param \AppBundle\Entity\ResultExercise $resultExercise
     */
    public function removeResultExercise(\AppBundle\Entity\ResultExercise $resultExercise)
    {
        $this->resultExercise->removeElement($resultExercise);
    }

    /**
     * Get resultExercise
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultExercise()
    {
        return $this->resultExercise;
    }
}
