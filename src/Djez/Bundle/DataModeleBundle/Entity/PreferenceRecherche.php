<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Preferencerecherche
 *
 * @ORM\Table(name="PreferenceRecherche", indexes={@ORM\Index(name="idUtilisateur_idx", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class PreferenceRecherche
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPreferenceRecherche", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPreferenceRecherche;

    /**
     * @var string
     *
     * @ORM\Column(name="libellePreferenceRecherche", type="string", length=50, nullable=true)
     */
    private $libellePreferenceRecherche;

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
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs", inversedBy="preferenceRecherches")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $utilisateur;


    /**
     * Get idPreferenceRecherche
     *
     * @return integer 
     */
    public function getIdPreferenceRecherche()
    {
        return $this->idPreferenceRecherche;
    }

    /**
     * Set libellePreferenceRecherche
     *
     * @param string $libellePreferenceRecherche
     * @return PreferenceRecherche
     */
    public function setLibellePreferenceRecherche($libellePreferenceRecherche)
    {
        $this->libellePreferenceRecherche = $libellePreferenceRecherche;

        return $this;
    }

    /**
     * Get libellePreferenceRecherche
     *
     * @return string 
     */
    public function getLibellePreferenceRecherche()
    {
        return $this->libellePreferenceRecherche;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return PreferenceRecherche
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
     * @return PreferenceRecherche
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
     * @return PreferenceRecherche
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
     * Set utilisateur
     *
     * @param \Djez\ModeleBundle\Entity\Utilisateurs $utilisateur
     * @return PreferenceRecherche
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
