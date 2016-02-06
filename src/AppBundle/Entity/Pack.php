<?php

// src/AppBundle/Entity/Pack.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PackRepository")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Monitoring")
     * @ORM\JoinColumn(nullable=false)
     */
    private $monitoring;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set monitoring
     *
     * @param \AppBundle\Entity\Monitoring $monitoring
     *
     * @return Pack
     */
    public function setMonitoring(\AppBundle\Entity\Monitoring $monitoring)
    {
        $this->monitoring = $monitoring;

        return $this;
    }

    /**
     * Get monitoring
     *
     * @return \AppBundle\Entity\Monitoring
     */
    public function getMonitoring()
    {
        return $this->monitoring;
    }
}
