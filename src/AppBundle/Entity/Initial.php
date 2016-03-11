<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Pack;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Initial
 *
 * @ORM\Table(name="initial")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InitialRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Initial {

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
     * @ORM\OneToMany(targetEntity="Pack", mappedBy="initial")
     */
    private $packs;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=255, nullable=true)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_mobile", type="string", length=255, nullable=true)
     */
    private $phoneMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="exercises", type="text", nullable=true)
     */
    private $exercises;

    /**
     * @var string
     *
     * @ORM\Column(name="health", type="text", nullable=true)
     */
    private $health;

    /**
     * @var string
     *
     * @ORM\Column(name="treatment", type="text", nullable=true)
     */
    private $treatment;

    /**
     * @var string
     *
     * @ORM\Column(name="smoker", type="string", length=255, nullable=true)
     */
    private $smoker;

    /**
     * @var string
     *
     * @ORM\Column(name="objectives", type="string", length=255, nullable=true)
     */
    private $objectives;

    /**
     * @var string
     *
     * @ORM\Column(name="objectives_detail", type="text", length=255, nullable=true)
     */
    private $objectivesDetail;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=255, nullable=true)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="imc", type="string", length=255, nullable=true)
     */
    private $imc;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255, nullable=true)
     */
    private $weight;

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
     * @ORM\Column(name="source", type="text", nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="attention", type="text", nullable=true)
     */
    private $attention;

    /**
     * @var string
     *
     * @ORM\Column(name="preferences", type="text", nullable=true)
     */
    private $preferences;

    /**
     * @var string
     *
     * @ORM\Column(name="drinking", type="text", nullable=true)
     */
    private $drinking;

    /**
     * @var string
     *
     * @ORM\Column(name="dietary_supplement", type="text", nullable=true)
     */
    private $dietarySupplement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="training_time", type="time", nullable=true)
     */
    private $trainingTime;

    /**
     * @var string
     *
     * @ORM\Column(name="diet", type="text", nullable=true)
     */
    private $diet;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

    /**
     * @var bool
     *
     * @ORM\Column(name="homemade_food", type="boolean", nullable=true)
     */
    private $homemadeFood;

    /**
     * @var int
     *
     * @ORM\Column(name="restaurant", type="integer", nullable=true)
     */
    private $restaurant;

    /**
     * @var string
     * @Assert\File
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
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Initial
     */
    public function setUserId($userId) {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Set job
     *
     * @param string $job
     *
     * @return Initial
     */
    public function setJob($job) {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob() {
        return $this->job;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Initial
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Initial
     */
    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode() {
        return $this->zipCode;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Initial
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set phoneMobile
     *
     * @param string $phoneMobile
     *
     * @return Initial
     */
    public function setPhoneMobile($phoneMobile) {
        $this->phoneMobile = $phoneMobile;

        return $this;
    }

    /**
     * Get phoneMobile
     *
     * @return string
     */
    public function getPhoneMobile() {
        return $this->phoneMobile;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Initial
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Initial
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Set exercises
     *
     * @param string $exercises
     *
     * @return Initial
     */
    public function setExercises($exercises) {
        $this->exercises = $exercises;

        return $this;
    }

    /**
     * Get exercises
     *
     * @return string
     */
    public function getExercises() {
        return $this->exercises;
    }

    /**
     * Set health
     *
     * @param string $health
     *
     * @return Initial
     */
    public function setHealth($health) {
        $this->health = $health;

        return $this;
    }

    /**
     * Get health
     *
     * @return string
     */
    public function getHealth() {
        return $this->health;
    }

    /**
     * Set treatment
     *
     * @param string $treatment
     *
     * @return Initial
     */
    public function setTreatment($treatment) {
        $this->treatment = $treatment;

        return $this;
    }

    /**
     * Get treatment
     *
     * @return string
     */
    public function getTreatment() {
        return $this->treatment;
    }

    /**
     * Set smoker
     *
     * @param string $smoker
     *
     * @return Initial
     */
    public function setSmoker($smoker) {
        $this->smoker = $smoker;

        return $this;
    }

    /**
     * Get smoker
     *
     * @return string
     */
    public function getSmoker() {
        return $this->smoker;
    }

    /**
     * Set height
     *
     * @param string $height
     *
     * @return Initial
     */
    public function setHeight($height) {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Initial
     */
    public function setWeight($weight) {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     * Set shoulders
     *
     * @param string $shoulders
     *
     * @return Initial
     */
    public function setShoulders($shoulders) {
        $this->shoulders = $shoulders;

        return $this;
    }

    /**
     * Get shoulders
     *
     * @return string
     */
    public function getShoulders() {
        return $this->shoulders;
    }

    /**
     * Set arms
     *
     * @param string $arms
     *
     * @return Initial
     */
    public function setArms($arms) {
        $this->arms = $arms;

        return $this;
    }

    /**
     * Get arms
     *
     * @return string
     */
    public function getArms() {
        return $this->arms;
    }

    /**
     * Set hipSize
     *
     * @param string $hipSize
     *
     * @return Initial
     */
    public function setHipSize($hipSize) {
        $this->hipSize = $hipSize;

        return $this;
    }

    /**
     * Get hipSize
     *
     * @return string
     */
    public function getHipSize() {
        return $this->hipSize;
    }

    /**
     * Set thighs
     *
     * @param string $thighs
     *
     * @return Initial
     */
    public function setThighs($thighs) {
        $this->thighs = $thighs;

        return $this;
    }

    /**
     * Get thighs
     *
     * @return string
     */
    public function getThighs() {
        return $this->thighs;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Initial
     */
    public function setSource($source) {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource() {
        return $this->source;
    }

    /**
     * Set attention
     *
     * @param string $attention
     *
     * @return Initial
     */
    public function setAttention($attention) {
        $this->attention = $attention;

        return $this;
    }

    /**
     * Get attention
     *
     * @return string
     */
    public function getAttention() {
        return $this->attention;
    }

    /**
     * Set preferences
     *
     * @param string $preferences
     *
     * @return Initial
     */
    public function setPreferences($preferences) {
        $this->preferences = $preferences;

        return $this;
    }

    /**
     * Get preferences
     *
     * @return string
     */
    public function getPreferences() {
        return $this->preferences;
    }

    /**
     * Set drinking
     *
     * @param string $drinking
     *
     * @return Initial
     */
    public function setDrinking($drinking) {
        $this->drinking = $drinking;

        return $this;
    }

    /**
     * Get drinking
     *
     * @return string
     */
    public function getDrinking() {
        return $this->drinking;
    }

    /**
     * Set dietarySupplement
     *
     * @param string $dietarySupplement
     *
     * @return Initial
     */
    public function setDietarySupplement($dietarySupplement) {
        $this->dietarySupplement = $dietarySupplement;

        return $this;
    }

    /**
     * Get dietarySupplement
     *
     * @return string
     */
    public function getDietarySupplement() {
        return $this->dietarySupplement;
    }

    /**
     * Set trainingTime
     *
     * @param \DateTime $trainingTime
     *
     * @return Initial
     */
    public function setTrainingTime($trainingTime) {
        $this->trainingTime = $trainingTime;

        return $this;
    }

    /**
     * Get trainingTime
     *
     * @return \DateTime
     */
    public function getTrainingTime() {
        return $this->trainingTime;
    }

    /**
     * Set diet
     *
     * @param string $diet
     *
     * @return Initial
     */
    public function setDiet($diet) {
        $this->diet = $diet;

        return $this;
    }

    /**
     * Get diet
     *
     * @return string
     */
    public function getDiet() {
        return $this->diet;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Initial
     */
    public function setNote($note) {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote() {
        return $this->note;
    }

    /**
     * Set homemadeFood
     *
     * @param boolean $homemadeFood
     *
     * @return Initial
     */
    public function setHomemadeFood($homemadeFood) {
        $this->homemadeFood = $homemadeFood;

        return $this;
    }

    /**
     * Get homemadeFood
     *
     * @return bool
     */
    public function getHomemadeFood() {
        return $this->homemadeFood;
    }

    /**
     * Set restaurant
     *
     * @param integer $restaurant
     *
     * @return Initial
     */
    public function setRestaurant($restaurant) {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return int
     */
    public function getRestaurant() {
        return $this->restaurant;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->packs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pack
     *
     * @param \AppBundle\Entity\Pack $pack
     *
     * @return Initial
     */
    public function addPack(\AppBundle\Entity\Pack $pack) {
        $this->packs[] = $pack;

        return $this;
    }

    /**
     * Remove pack
     *
     * @param \AppBundle\Entity\Pack $pack
     */
    public function removePack(\AppBundle\Entity\Pack $pack) {
        $this->packs->removeElement($pack);
    }

    /**
     * Get packs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPacks() {
        return $this->packs;
    }

    /**
     * Set pectorals
     *
     * @param string $pectorals
     *
     * @return Initial
     */
    public function setPectorals($pectorals) {
        $this->pectorals = $pectorals;

        return $this;
    }

    /**
     * Get pectorals
     *
     * @return string
     */
    public function getPectorals() {
        return $this->pectorals;
    }

    /**
     * Set photoFront
     *
     * @param string $photoFront
     *
     * @return Initial
     */
    public function setPhotoFront($photoFront) {
        $this->photoFront = $photoFront;

        return $this;
    }

    /**
     * Get photoFront
     *
     * @return string
     */
    public function getPhotoFront() {
        return $this->photoFront;
    }

    /**
     * Set photoSide
     *
     * @param string $photoSide
     *
     * @return Initial
     */
    public function setPhotoSide($photoSide) {
        $this->photoSide = $photoSide;

        return $this;
    }

    /**
     * Get photoSide
     *
     * @return string
     */
    public function getPhotoSide() {
        return $this->photoSide;
    }

    /**
     * Set photoBack
     *
     * @param string $photoBack
     *
     * @return Initial
     */
    public function setPhotoBack($photoBack) {
        $this->photoBack = $photoBack;

        return $this;
    }

    /**
     * Get photoBack
     *
     * @return string
     */
    public function getPhotoBack() {
        return $this->photoBack;
    }

    /**
     * Set objectives
     *
     * @param string $objectives
     *
     * @return Initial
     */
    public function setObjectives($objectives) {
        $this->objectives = $objectives;

        return $this;
    }

    /**
     * Get objectives
     *
     * @return string
     */
    public function getObjectives() {
        return $this->objectives;
    }

    /**
     * Set objectivesDetail
     *
     * @param string $objectivesDetail
     *
     * @return Initial
     */
    public function setObjectivesDetail($objectivesDetail) {
        $this->objectivesDetail = $objectivesDetail;

        return $this;
    }

    /**
     * Get objectivesDetail
     *
     * @return string
     */
    public function getObjectivesDetail() {
        return $this->objectivesDetail;
    }

    /**
     * Set imc
     *
     * @param string $imc
     *
     * @return Initial
     */
    public function setImc($imc) {
        $this->imc = $imc;

        return $this;
    }

    /**
     * Get imc
     *
     * @return string
     */
    public function getImc() {
        return $this->imc;
    }


    /**
     * Set completed
     *
     * @param boolean $completed
     *
     * @return Initial
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Initial
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Initial
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Initial
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }
}
