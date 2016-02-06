<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Monitoring
 *
 * @ORM\Table(name="monitoring")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MonitoringRepository")
 */
class Monitoring
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255)
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=255)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_mobile", type="string", length=255)
     */
    private $phoneMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="exercises", type="text")
     */
    private $exercises;

    /**
     * @var string
     *
     * @ORM\Column(name="health", type="text")
     */
    private $health;

    /**
     * @var string
     *
     * @ORM\Column(name="treatment", type="text")
     */
    private $treatment;

    /**
     * @var string
     *
     * @ORM\Column(name="smoker", type="string", length=255)
     */
    private $smoker;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=255)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="shoulders", type="string", length=255)
     */
    private $shoulders;

    /**
     * @var string
     *
     * @ORM\Column(name="arms", type="string", length=255)
     */
    private $arms;

    /**
     * @var string
     *
     * @ORM\Column(name="hip_size", type="string", length=255)
     */
    private $hipSize;

    /**
     * @var string
     *
     * @ORM\Column(name="thighs", type="string", length=255)
     */
    private $thighs;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="text")
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="attention", type="text")
     */
    private $attention;

    /**
     * @var string
     *
     * @ORM\Column(name="preferences", type="text")
     */
    private $preferences;

    /**
     * @var string
     *
     * @ORM\Column(name="drinking", type="text")
     */
    private $drinking;

    /**
     * @var string
     *
     * @ORM\Column(name="dietary_supplement", type="text")
     */
    private $dietarySupplement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="training_time", type="time")
     */
    private $trainingTime;

    /**
     * @var string
     *
     * @ORM\Column(name="diet", type="text")
     */
    private $diet;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text")
     */
    private $note;

    /**
     * @var bool
     *
     * @ORM\Column(name="homemade_food", type="boolean")
     */
    private $homemadeFood;

    /**
     * @var int
     *
     * @ORM\Column(name="restaurant", type="integer")
     */
    private $restaurant;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Monitoring
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Monitoring
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
     * Set job
     *
     * @param string $job
     *
     * @return Monitoring
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Monitoring
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Monitoring
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Monitoring
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phoneMobile
     *
     * @param string $phoneMobile
     *
     * @return Monitoring
     */
    public function setPhoneMobile($phoneMobile)
    {
        $this->phoneMobile = $phoneMobile;

        return $this;
    }

    /**
     * Get phoneMobile
     *
     * @return string
     */
    public function getPhoneMobile()
    {
        return $this->phoneMobile;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Monitoring
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
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Monitoring
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set exercises
     *
     * @param string $exercises
     *
     * @return Monitoring
     */
    public function setExercises($exercises)
    {
        $this->exercises = $exercises;

        return $this;
    }

    /**
     * Get exercises
     *
     * @return string
     */
    public function getExercises()
    {
        return $this->exercises;
    }

    /**
     * Set health
     *
     * @param string $health
     *
     * @return Monitoring
     */
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get health
     *
     * @return string
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set treatment
     *
     * @param string $treatment
     *
     * @return Monitoring
     */
    public function setTreatment($treatment)
    {
        $this->treatment = $treatment;

        return $this;
    }

    /**
     * Get treatment
     *
     * @return string
     */
    public function getTreatment()
    {
        return $this->treatment;
    }

    /**
     * Set smoker
     *
     * @param string $smoker
     *
     * @return Monitoring
     */
    public function setSmoker($smoker)
    {
        $this->smoker = $smoker;

        return $this;
    }

    /**
     * Get smoker
     *
     * @return string
     */
    public function getSmoker()
    {
        return $this->smoker;
    }

    /**
     * Set height
     *
     * @param string $height
     *
     * @return Monitoring
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Monitoring
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
     * @return Monitoring
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
     * Set arms
     *
     * @param string $arms
     *
     * @return Monitoring
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
     * @return Monitoring
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
     * @return Monitoring
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
     * Set source
     *
     * @param string $source
     *
     * @return Monitoring
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set attention
     *
     * @param string $attention
     *
     * @return Monitoring
     */
    public function setAttention($attention)
    {
        $this->attention = $attention;

        return $this;
    }

    /**
     * Get attention
     *
     * @return string
     */
    public function getAttention()
    {
        return $this->attention;
    }

    /**
     * Set preferences
     *
     * @param string $preferences
     *
     * @return Monitoring
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;

        return $this;
    }

    /**
     * Get preferences
     *
     * @return string
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * Set drinking
     *
     * @param string $drinking
     *
     * @return Monitoring
     */
    public function setDrinking($drinking)
    {
        $this->drinking = $drinking;

        return $this;
    }

    /**
     * Get drinking
     *
     * @return string
     */
    public function getDrinking()
    {
        return $this->drinking;
    }

    /**
     * Set dietarySupplement
     *
     * @param string $dietarySupplement
     *
     * @return Monitoring
     */
    public function setDietarySupplement($dietarySupplement)
    {
        $this->dietarySupplement = $dietarySupplement;

        return $this;
    }

    /**
     * Get dietarySupplement
     *
     * @return string
     */
    public function getDietarySupplement()
    {
        return $this->dietarySupplement;
    }

    /**
     * Set trainingTime
     *
     * @param \DateTime $trainingTime
     *
     * @return Monitoring
     */
    public function setTrainingTime($trainingTime)
    {
        $this->trainingTime = $trainingTime;

        return $this;
    }

    /**
     * Get trainingTime
     *
     * @return \DateTime
     */
    public function getTrainingTime()
    {
        return $this->trainingTime;
    }

    /**
     * Set diet
     *
     * @param string $diet
     *
     * @return Monitoring
     */
    public function setDiet($diet)
    {
        $this->diet = $diet;

        return $this;
    }

    /**
     * Get diet
     *
     * @return string
     */
    public function getDiet()
    {
        return $this->diet;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Monitoring
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set homemadeFood
     *
     * @param boolean $homemadeFood
     *
     * @return Monitoring
     */
    public function setHomemadeFood($homemadeFood)
    {
        $this->homemadeFood = $homemadeFood;

        return $this;
    }

    /**
     * Get homemadeFood
     *
     * @return bool
     */
    public function getHomemadeFood()
    {
        return $this->homemadeFood;
    }

    /**
     * Set restaurant
     *
     * @param integer $restaurant
     *
     * @return Monitoring
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return int
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
