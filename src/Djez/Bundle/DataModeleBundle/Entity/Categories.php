<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="Categories", uniqueConstraints={@ORM\UniqueConstraint(name="libelleCategorie_UNIQUE", columns={"libelleCategorie"})}, indexes={@ORM\Index(name="idSuperCategorie_idx", columns={"idSuperCategorie"})})
 * @ORM\Entity(repositoryClass="Djez\Bundle\DataModeleBundle\Repositories\CategoryRepository")
 */
class Categories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCategorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleCategorie", type="string", length=50, nullable=false)
     */
    private $libelleCategorie;

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
     * @var \Supercategorie
     *
     * @ORM\ManyToOne(targetEntity="SuperCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSuperCategorie", referencedColumnName="idSuperCategorie")
     * })
     */
    private $idSuperCategorie;



    /**
     * Get idCategorie
     *
     * @return integer
     */
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * Set libelleCategorie
     *
     * @param string $libelleCategorie
     * @return Categories
     */
    public function setLibelleCategorie($libelleCategorie)
    {
        $this->libelleCategorie = $libelleCategorie;

        return $this;
    }

    /**
     * Get libelleCategorie
     *
     * @return string
     */
    public function getLibelleCategorie()
    {
        return $this->libelleCategorie;
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

    /**
     * Set idSuperCategorie
     *
     * @param \Djez\Bundle\DataModeleBundle\Entity\SuperCategorie $idSuperCategorie
     * @return Categories
     */
    public function setIdSuperCategorie(\Djez\Bundle\DataModeleBundle\Entity\SuperCategorie $idSuperCategorie = null)
    {
        $this->idSuperCategorie = $idSuperCategorie;

        return $this;
    }

    /**
     * Get idSuperCategorie
     *
     * @return \Djez\Bundle\DataModeleBundle\Entity\SuperCategorie
     */
    public function getIdSuperCategorie()
    {
        return $this->idSuperCategorie;
    }
}
