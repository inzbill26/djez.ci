<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marques
 *
 * @ORM\Table(name="Marques")
 * @ORM\Entity
 */
class Marques
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMarque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMarque;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleMarque", type="string", length=50, nullable=true)
     */
    private $libelleMarque;

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
     * @ORM\OneToMany(targetEntity="Modeles", mappedBy="marque")
     **/
    private $modeles;

    /**
     * Get idMarques
     *
     * @return integer
     */
    public function getIdMarque()
    {
        return $this->idMarque;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modeles = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set libelleMarque
     *
     * @param string $libelleMarque
     * @return Marques
     */
    public function setLibelleMarque($libelleMarque)
    {
        $this->libelleMarque = $libelleMarque;

        return $this;
    }

    /**
     * Get libelleMarque
     *
     * @return string
     */
    public function getLibelleMarque()
    {
        return $this->libelleMarque;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Marques
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
     * @return Marques
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
     * @return Marques
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
     * Add modele
     *
     * @param \Djez\ModeleBundle\Entity\Modeles $modele
     * @return Annonces
     */
    public function addModele(\Djez\ModeleBundle\Entity\Modeles $modele)
    {
        $this->modeles[] = $modele;

        return $this;
    }

    /**
     * Remove modeles
     *
     * @param \Djez\ModeleBundle\Entity\Modeles $modele
     */
    public function removeModele(\Djez\ModeleBundle\Entity\Modeles $modele)
    {
        $this->modeles->removeElement($modele);
    }

    /**
     * Get modeles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModeles()
    {
        return $this->modeles;
    }
}
