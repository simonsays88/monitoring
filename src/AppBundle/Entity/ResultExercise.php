<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResultExercise
 *
 * @ORM\Table(name="result_exercise")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultExerciseRepository")
 */
class ResultExercise
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="repetition", type="integer", nullable=true)
     */
    private $repetition;

    /**
     * @ORM\ManyToOne(targetEntity="Result", inversedBy="re")
     * @ORM\JoinColumn(name="result_id", referencedColumnName="id")
     * */
    protected $result;

    /**
     * @ORM\ManyToOne(targetEntity="Exercise", inversedBy="re")
     * @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     * */
    protected $exercise;

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
     * Set value
     *
     * @param string $value
     *
     * @return ResultExercise
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set result
     *
     * @param \AppBundle\Entity\Result $result
     *
     * @return ResultExercise
     */
    public function setResult(\AppBundle\Entity\Result $result = null)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return \AppBundle\Entity\Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set exercise
     *
     * @param \AppBundle\Entity\Exercise $exercise
     *
     * @return ResultExercise
     */
    public function setExercise(\AppBundle\Entity\Exercise $exercise = null)
    {
        $this->exercise = $exercise;

        return $this;
    }

    /**
     * Get exercise
     *
     * @return \AppBundle\Entity\Exercise
     */
    public function getExercise()
    {
        return $this->exercise;
    }

    public function __toString()
    {
        return $this->getExercise()->getName();
    }


    /**
     * Set repetition
     *
     * @param integer $repetition
     *
     * @return ResultExercise
     */
    public function setRepetition($repetition)
    {
        $this->repetition = $repetition;

        return $this;
    }

    /**
     * Get repetition
     *
     * @return integer
     */
    public function getRepetition()
    {
        return $this->repetition;
    }
}
