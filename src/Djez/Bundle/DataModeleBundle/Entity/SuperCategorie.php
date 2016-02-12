<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supercategorie
 *
 * @ORM\Table(name="SuperCategorie", uniqueConstraints={@ORM\UniqueConstraint(name="libelleCategorie_UNIQUE", columns={"libelleSuperCategorie"})})
 * @ORM\Entity(repositoryClass="Djez\Bundle\DataModeleBundle\Repositories\SuperCategoryRepository")
 */
class SuperCategorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSuperCategorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSuperCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleSuperCategorie", type="string", length=50, nullable=false)
     */
    private $libelleSuperCategorie;

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
     * Get idSuperCategorie
     *
     * @return integer 
     */
    public function getIdSuperCategorie()
    {
        return $this->idSuperCategorie;
    }

    /**
     * Set libelleSuperCategorie
     *
     * @param string $libelleSuperCategorie
     * @return SuperCategorie
     */
    public function setLibelleSuperCategorie($libelleSuperCategorie)
    {
        $this->libelleSuperCategorie = $libelleSuperCategorie;

        return $this;
    }

    /**
     * Get libelleSuperCategorie
     *
     * @return string 
     */
    public function getLibelleSuperCategorie()
    {
        return $this->libelleSuperCategorie;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return SuperCategorie
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
     * @return SuperCategorie
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
     * @return SuperCategorie
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
