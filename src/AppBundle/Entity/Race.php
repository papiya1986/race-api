<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Race
 *
 * @ORM\Table(name="race")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RaceRepository")
 */
class Race
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Competitor")
     * @ORM\JoinColumn(name="competitor_id", referencedColumnName="id")
     */
    private $competitor;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="distance", type="string", length=255)
     */
    private $distance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;


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
     * @return mixed
     */
    public function getCompetitor()
    {
        return $this->competitor;
    }

    /**
     * @param Competitor $competitor
     *
     * @return Race
     */
    public function setCompetitor(Competitor $competitor)
    {
        $this->competitor = $competitor;

        return $this;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Race
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set distance
     *
     * @param string $distance
     *
     * @return Race
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return string
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Race
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }
    public function setAgecategory($agecategory)
    {
        $this->agecategory = $agecategory;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getAgecategory()
    {
        return $this->agecategory;
    }
}

