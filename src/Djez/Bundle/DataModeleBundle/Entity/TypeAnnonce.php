<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typeannonce
 *
 * @ORM\Table(name="TypeAnnonce", uniqueConstraints={@ORM\UniqueConstraint(name="libelleType_idx", columns={"libelleType"})})
 * @ORM\Entity
 */
class TypeAnnonce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTypeAnnonce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeannonce;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleType", type="string", length=50, nullable=false)
     */
    private $libelleType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime", nullable=true)
     */
    private $dateModification;



    /**
     * Get idTypeannonce
     *
     * @return integer 
     */
    public function getIdTypeannonce()
    {
        return $this->idTypeannonce;
    }

    /**
     * Set libelleType
     *
     * @param string $libelleType
     * @return TypeAnnonce
     */
    public function setLibelleType($libelleType)
    {
        $this->libelleType = $libelleType;

        return $this;
    }

    /**
     * Get libelleType
     *
     * @return string 
     */
    public function getLibelleType()
    {
        return $this->libelleType;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return TypeAnnonce
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return TypeAnnonce
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return TypeAnnonce
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }
}
