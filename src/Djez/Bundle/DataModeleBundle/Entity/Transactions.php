<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transactions
 *
 * @ORM\Table(name="Transactions", indexes={@ORM\Index(name="idAnnonce_idx", columns={"idAnnonce"}), @ORM\Index(name="idService_idx", columns={"idService"}), @ORM\Index(name="idVendeur_idx", columns={"idVendeur"}), @ORM\Index(name="idAcheteur_idx", columns={"idAcheteur"})})
 * @ORM\Entity
 */
class Transactions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTransaction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTransaction;

    /**
     * @var string
     *
     * @ORM\Column(name="typeTransaction", type="string", length=10, nullable=true)
     */
    private $typeTransaction;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=true)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePaiementAcheteur", type="datetime", nullable=true)
     */
    private $datepaiementacheteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePaiementVendeur", type="datetime", nullable=true)
     */
    private $datePaiementvendeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLivraison", type="datetime", nullable=true)
     */
    private $dateLivraison;

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
     * @var \Annonces
     *
     * @ORM\ManyToOne(targetEntity="Annonces")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAnnonce", referencedColumnName="idAnnonce")
     * })
     */
    private $idAnnonce;

    /**
     * @var \Services
     *
     * @ORM\ManyToOne(targetEntity="Services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idService", referencedColumnName="idServices")
     * })
     */
    private $idService;

    /**
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idVendeur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idVendeur;

    /**
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAcheteur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idAcheteur;



    /**
     * Get idTransaction
     *
     * @return integer 
     */
    public function getIdTransaction()
    {
        return $this->idTransaction;
    }

    /**
     * Set typeTransaction
     *
     * @param string $typeTransaction
     * @return Transactions
     */
    public function setTypeTransaction($typeTransaction)
    {
        $this->typeTransaction = $typeTransaction;

        return $this;
    }

    /**
     * Get typeTransaction
     *
     * @return string 
     */
    public function getTypeTransaction()
    {
        return $this->typeTransaction;
    }

    /**
     * Set montant
     *
     * @param float $montant
     * @return Transactions
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set datepaiementacheteur
     *
     * @param \DateTime $datepaiementacheteur
     * @return Transactions
     */
    public function setDatepaiementacheteur($datepaiementacheteur)
    {
        $this->datepaiementacheteur = $datepaiementacheteur;

        return $this;
    }

    /**
     * Get datepaiementacheteur
     *
     * @return \DateTime 
     */
    public function getDatepaiementacheteur()
    {
        return $this->datepaiementacheteur;
    }

    /**
     * Set datePaiementvendeur
     *
     * @param \DateTime $datePaiementvendeur
     * @return Transactions
     */
    public function setDatePaiementvendeur($datePaiementvendeur)
    {
        $this->datePaiementvendeur = $datePaiementvendeur;

        return $this;
    }

    /**
     * Get datePaiementvendeur
     *
     * @return \DateTime 
     */
    public function getDatePaiementvendeur()
    {
        return $this->datePaiementvendeur;
    }

    /**
     * Set dateLivraison
     *
     * @param \DateTime $dateLivraison
     * @return Transactions
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    /**
     * Get dateLivraison
     *
     * @return \DateTime 
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Transactions
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
     * @return Transactions
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
     * @return Transactions
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
     * Set idAnnonce
     *
     * @param \Djez\ModeleBundle\Entity\Annonces $idAnnonce
     * @return Transactions
     */
    public function setIdAnnonce(\Djez\ModeleBundle\Entity\Annonces $idAnnonce = null)
    {
        $this->idAnnonce = $idAnnonce;

        return $this;
    }

    /**
     * Get idAnnonce
     *
     * @return \Djez\ModeleBundle\Entity\Annonces 
     */
    public function getIdAnnonce()
    {
        return $this->idAnnonce;
    }

    /**
     * Set idService
     *
     * @param \Djez\ModeleBundle\Entity\Services $idService
     * @return Transactions
     */
    public function setIdService(\Djez\ModeleBundle\Entity\Services $idService = null)
    {
        $this->idService = $idService;

        return $this;
    }

    /**
     * Get idService
     *
     * @return \Djez\ModeleBundle\Entity\Services 
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * Set idVendeur
     *
     * @param \Djez\ModeleBundle\Entity\Utilisateurs $idVendeur
     * @return Transactions
     */
    public function setIdVendeur(\Djez\ModeleBundle\Entity\Utilisateurs $idVendeur = null)
    {
        $this->idVendeur = $idVendeur;

        return $this;
    }

    /**
     * Get idVendeur
     *
     * @return \Djez\ModeleBundle\Entity\Utilisateurs 
     */
    public function getIdVendeur()
    {
        return $this->idVendeur;
    }

    /**
     * Set idAcheteur
     *
     * @param \Djez\ModeleBundle\Entity\Utilisateurs $idAcheteur
     * @return Transactions
     */
    public function setIdAcheteur(\Djez\ModeleBundle\Entity\Utilisateurs $idAcheteur = null)
    {
        $this->idAcheteur = $idAcheteur;

        return $this;
    }

    /**
     * Get idAcheteur
     *
     * @return \Djez\ModeleBundle\Entity\Utilisateurs 
     */
    public function getIdAcheteur()
    {
        return $this->idAcheteur;
    }
}
