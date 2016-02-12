<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modeles
 *
 * @ORM\Table(name="Modeles")
 * @ORM\Entity
 */
class Modeles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idModele", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idModele;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleModele", type="string", length=50, nullable=true)
     */
    private $libelleModele;

    /**
     * @var \Marques
     *
     * @ORM\ManyToOne(targetEntity="Marques", inversedBy="modeles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMarque", referencedColumnName="idMarque")
     * })
     */
    private $marque;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"default" = 1})
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
     * Get idModele
     *
     * @return integer 
     */
    public function getIdModele()
    {
        return $this->idModele;
    }

    /**
     * Set libelleModele
     *
     * @param string $libelleModele
     * @return Modeles
     */
    public function setLibelleModele($libelleModele)
    {
        $this->libelleModele = $libelleModele;

        return $this;
    }

    /**
     * Get libelleModele
     *
     * @return string 
     */
    public function getLibelleModele()
    {
        return $this->libelleModele;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Modeles
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
     * @return Modeles
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
     * @return Modele
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
     * Set marque
     *
     * @param \Djez\ModeleBundle\Entity\Marques $marque
     * @return Modeles
     */
    public function setMarque(\Djez\ModeleBundle\Entity\Marques $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \Djez\ModeleBundle\Entity\Marques 
     */
    public function getMarque()
    {
        return $this->marque;
    }
}
