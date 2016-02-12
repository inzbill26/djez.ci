<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photos
 *
 * @ORM\Table(name="Photos", uniqueConstraints={@ORM\UniqueConstraint(name="nomUnique_idx", columns={"nomUnique"})}, indexes={@ORM\Index(name="idAnnonce_idx", columns={"idAnnonce"})})
 * @ORM\Entity(repositoryClass="Djez\Bundle\DataModeleBundle\Repositories\PhotosRepository")
 */
class Photos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPiecesJointe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPiecesjointe;

    /**
     * @var string
     *
     * @ORM\Column(name="nomAffiche", type="string", length=50, nullable=true)
     */
    private $nomAffiche;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUnique", type="string", length=100, nullable=false)
     */
    private $nomUnique;

    /**
     * @var string
     *
     * @ORM\Column(name="repertoireStockage", type="string", length=50, nullable=true)
     */
    private $repertoireStockage;

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
     * @var boolean
     *
     * @ORM\Column(name="accroche", type="boolean", nullable=true)
     */
    private $accroche;

    /**
     * @var \Annonces
     *
     * @ORM\ManyToOne(targetEntity="Annonces", inversedBy="photos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAnnonce", referencedColumnName="idAnnonce")
     * })
     */
    private $annonce;

    public function getUrl()
    {
        $url = $this->repertoireStockage . "/" . $this->nomUnique;
        return $url;
    }

    /**
     * Get idPiecesjointe
     *
     * @return integer
     */
    public function getIdPiecesjointe()
    {
        return $this->idPiecesjointe;
    }

    /**
     * Set nomAffiche
     *
     * @param string $nomAffiche
     * @return Photos
     */
    public function setNomAffiche($nomAffiche)
    {
        $this->nomAffiche = $nomAffiche;

        return $this;
    }

    /**
     * Get nomAffiche
     *
     * @return string
     */
    public function getNomAffiche()
    {
        return $this->nomAffiche;
    }

    /**
     * Set nomUnique
     *
     * @param string $nomUnique
     * @return Photos
     */
    public function setNomUnique($nomUnique)
    {
        $this->nomUnique = $nomUnique;

        return $this;
    }

    /**
     * Get nomUnique
     *
     * @return string
     */
    public function getNomUnique()
    {
        return $this->nomUnique;
    }

    /**
     * Set repertoireStockage
     *
     * @param string $repertoireStockage
     * @return Photos
     */
    public function setRepertoireStockage($repertoireStockage)
    {
        $this->repertoireStockage = $repertoireStockage;

        return $this;
    }

    /**
     * Get repertoireStockage
     *
     * @return string
     */
    public function getRepertoireStockage()
    {
        return $this->repertoireStockage;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Photos
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
     * @return Photos
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
     * @return Photos
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
     * Set accroche
     *
     * @param boolean $accroche
     * @return Photos
     */
    public function setAccroche($accroche)
    {
        $this->accroche = $accroche;

        return $this;
    }

    /**
     * Get accroche
     *
     * @return boolean
     */
    public function getAccroche()
    {
        return $this->accroche;
    }

    /**
     * Set annonce
     *
     * @param \Djez\Bundle\DataModeleBundle\Entity\Annonces $annonce
     * @return Photos
     */
    public function setAnnonce(\Djez\Bundle\DataModeleBundle\Entity\Annonces $annonce = null)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \Djez\Bundle\ModeleBundle\Entity\Annonces
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }
}
