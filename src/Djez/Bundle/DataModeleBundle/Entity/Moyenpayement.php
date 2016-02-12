<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moyenpayement
 *
 * @ORM\Table(name="MoyenPayement", indexes={@ORM\Index(name="idUtilisateur_idx", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class MoyenPayement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMoyenPayement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMoyenPayement;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=50, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="informationStocke", type="string", length=100, nullable=true)
     */
    private $informationStocke;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;

    /**
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $utilisateur;



    /**
     * Get idMoyenPayement
     *
     * @return integer 
     */
    public function getIdMoyenPayement()
    {
        return $this->idMoyenPayement;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return MoyenPayement
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return MoyenPayement
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
     * Set informationStocke
     *
     * @param string $informationStocke
     * @return MoyenPayement
     */
    public function setInformationStocke($informationStocke)
    {
        $this->informationStocke = $informationStocke;

        return $this;
    }

    /**
     * Get informationStocke
     *
     * @return string 
     */
    public function getInformationStocke()
    {
        return $this->informationStocke;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return MoyenPayement
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime 
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     * @return MoyenPayement
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime 
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return MoyenPayement
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
     * Set utilisateur
     *
     * @param \Djez\ModeleBundle\Entity\Utilisateurs $utilisateur
     * @return MoyenPayement
     */
    public function setUtilisateur(\Djez\ModeleBundle\Entity\Utilisateurs $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Djez\ModeleBundle\Entity\Utilisateurs 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
