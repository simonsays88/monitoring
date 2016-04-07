<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercise
 *
 * @ORM\Table(name="exercise")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExerciseRepository")
 */
class Exercise
{
    const PECTORALS = 'Pectoraux';
    const BACK = 'Dos';
    const SHOULDERS = 'Epaules';
    const THIGHS = 'Cuisses';
    const SPINAL = 'Spinaux';
    const BICEPS = 'Biceps';
    const TRICEPS = 'Triceps';
    const SHEATING = 'Gainage';
    const OTHER = 'Autre';

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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", columnDefinition="ENUM('Pectoraux', 'Dos', 'Epaules','Cuisses', 'Spinaux', 'Biceps','Triceps', 'Gainage', 'Autre')", nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=255, nullable=true)
     */
    private $unit;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="ResultExercise" , mappedBy="re" , cascade={"all"})
     * */
    protected $resultExercise;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reference", type="boolean")
     */
    private $reference = 0;
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
     * Set name
     *
     * @param string $name
     *
     * @return Exercise
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
     * Set description
     *
     * @param string $description
     *
     * @return Exercise
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function __toString()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resultExercise = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return Exercise
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Add resultExercise
     *
     * @param \AppBundle\Entity\ResultExercise $resultExercise
     *
     * @return Exercise
     */
    public function addResultExercise(\AppBundle\Entity\ResultExercise $resultExercise)
    {
        $this->resultExercise[] = $resultExercise;

        return $this;
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


    /**
     * Set type
     *
     * @param string $type
     *
     * @return Exercise
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set reference
     *
     * @param boolean $reference
     *
     * @return Exercise
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return boolean
     */
    public function getReference()
    {
        return $this->reference;
    }
}
