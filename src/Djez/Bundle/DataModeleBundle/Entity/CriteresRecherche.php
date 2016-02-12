<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Criteresrecherche
 *
 * @ORM\Table(name="CriteresRecherche", indexes={@ORM\Index(name="idPreferenceRecherche_idx", columns={"idPreferenceRecherche"})})
 * @ORM\Entity
 */
class CriteresRecherche
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCriteresRecherche", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCriteresRecherche;

    /**
     * @var string
     *
     * @ORM\Column(name="cleRecherche", type="string", length=50, nullable=true)
     */
    private $cleRecherche;

    /**
     * @var string
     *
     * @ORM\Column(name="valeurCle", type="string", length=50, nullable=true)
     */
    private $valeurCle;

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
     * @var \Preferencerecherche
     *
     * @ORM\ManyToOne(targetEntity="PreferenceRecherche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPreferenceRecherche", referencedColumnName="idPreferenceRecherche")
     * })
     */
    private $idpreferenceRecherche;



    /**
     * Get idCriteresRecherche
     *
     * @return integer 
     */
    public function getIdCriteresRecherche()
    {
        return $this->idCriteresRecherche;
    }

    /**
     * Set cleRecherche
     *
     * @param string $cleRecherche
     * @return CriteresRecherche
     */
    public function setCleRecherche($cleRecherche)
    {
        $this->cleRecherche = $cleRecherche;

        return $this;
    }

    /**
     * Get cleRecherche
     *
     * @return string 
     */
    public function getCleRecherche()
    {
        return $this->cleRecherche;
    }

    /**
     * Set valeurCle
     *
     * @param string $valeurCle
     * @return CriteresRecherche
     */
    public function setValeurCle($valeurCle)
    {
        $this->valeurCle = $valeurCle;

        return $this;
    }

    /**
     * Get valeurCle
     *
     * @return string 
     */
    public function getValeurCle()
    {
        return $this->valeurCle;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return CriteresRecherche
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
     * @return CriteresRecherche
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
     * @return CriteresRecherche
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
     * Set idpreferenceRecherche
     *
     * @param \Djez\ModeleBundle\Entity\PreferenceRecherche $idpreferenceRecherche
     * @return CriteresRecherche
     */
    public function setIdpreferenceRecherche(\Djez\ModeleBundle\Entity\PreferenceRecherche $idpreferenceRecherche = null)
    {
        $this->idpreferenceRecherche = $idpreferenceRecherche;

        return $this;
    }

    /**
     * Get idpreferenceRecherche
     *
     * @return \Djez\ModeleBundle\Entity\PreferenceRecherche 
     */
    public function getIdpreferenceRecherche()
    {
        return $this->idpreferenceRecherche;
    }
}
