<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prix
 *
 * @ORM\Table(name="Prix")
 * @ORM\Entity(repositoryClass="Djez\Bundle\DataModeleBundle\Repositories\PrixRepository")
 */

class Prix
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPrix", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrix;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="integer", length=50, nullable=false)
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="devise", type="integer", length=50, nullable=false)
     */
    private $devise;

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
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;


    /**
     * Get idPrix
     *
     * @return integer 
     */
    public function getIdPrix()
    {
        return $this->idPrix;
    }

    /**
     * Set valeur
     *
     * @param string $valeur
     * @return Categories
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string 
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Categories
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
     * @return Categories
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

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Categories
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
}