<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonces
 *
 * @ORM\Table(name="Annonces", indexes={@ORM\Index(name="idCategorie_idx", columns={"idCategorie"}), @ORM\Index(name="idAnnonceur_idx", columns={"idUtilisateur"})})
 * @ORM\Entity(repositoryClass="Djez\Bundle\DataModeleBundle\Repositories\AnnoncesRepository")
 */
class Annonces
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAnnonce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="titreAnnonce", type="string", length=50, nullable=false)
     */
    private $titreAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionAnnonce", type="string", length=700, nullable=false)
     */
    private $descriptionAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="defautObjet", type="string", length=500, nullable=true)
     */
    private $defautObjet;

    /**
     * @var integer
     *
     * @ORM\Column(name="prixObjet", type="integer", nullable=false)
     */
    private $prixObjet;

    /**
     * @var string
     *
     * @ORM\Column(name="devise", type="string", length=50, nullable=false)
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
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=50, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="Photos", mappedBy="annonce", cascade={"all"})
     **/
    private $photos;


    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=50, nullable=true)
     */
    private $marque;


     /**
      * @var string
      *
      * @ORM\Column(name="modele", type="string", length=50, nullable=true)
      */
    private $modele;


    /**
     * @var integer
     *
     * @ORM\Column(name="annee", type="integer", nullable=true)
     */
    private $annee;

    /**
     * @var integer
     *
     * @ORM\Column(name="kilometrage", type="integer", nullable=true)
     */
    private $kilometrage;

    /**
     * @var integer
     *
     * @ORM\Column(name="puissance", type="integer", nullable=true)
     */
    private $puissance;

    /**
     * @var string
     *
     * @ORM\Column(name="transmission", type="string", length=12, nullable=true)
     */
    private $transmission;

    /**
     * @var string
     *
     * @ORM\Column(name="carburant", type="string", length=10, nullable=true)
     */
    private $carburant;

    /**
     * @var boolean
     *
     * @ORM\Column(name="negociable", type="boolean", nullable=true)
     */
    private $negociable;

  /**
    * @var string
    *
    * @ORM\Column(name="typeAnnonceur", type="string", length=45, nullable=true)
    */
    private $typeAnnonceur;

    /**
    * @var string
    *
    * @ORM\Column(name="emailAnnonceur", type="string", length=100, nullable=true)
    */
    private $emailAnnonceur;


      /**
      * @var string
      *
      * @ORM\Column(name="telephoneAnnonceur", type="string", length=45, nullable=true)
      */
      private $telephoneAnnonceur;

      /**
      * @var string
      *
      * @ORM\Column(name="localisation", type="string", length=100, nullable=true)
      */
      private $localisation;

      /**
       * @var string
       *
       * @ORM\Column(name="unitePrix", type="string", length=10, nullable=true)
       */
      private $unitePrix;



    public function getAccroche()
    {
        $accroche = "custom/images/default.jpg";
        foreach ( $this->photos as $photo ) {
            if ( $photo->getAccroche() ) {
                $accroche = $photo->getRepertoireStockage()."/".$photo->getNomUnique();
                break;
            }
        }
        unset($photo);
        return $accroche;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idAnnonce
     *
     * @return integer
     */
    public function getIdAnnonce()
    {
        return $this->idAnnonce;
    }

    /**
     * Set titreAnnonce
     *
     * @param string $titreAnnonce
     * @return Annonces
     */
    public function setTitreAnnonce($titreAnnonce)
    {
        $this->titreAnnonce = $titreAnnonce;

        return $this;
    }

    /**
     * Get titreAnnonce
     *
     * @return string
     */
    public function getTitreAnnonce()
    {
        return $this->titreAnnonce;
    }

    /**
     * Set descriptionAnnonce
     *
     * @param string $descriptionAnnonce
     * @return Annonces
     */
    public function setDescriptionAnnonce($descriptionAnnonce)
    {
        $this->descriptionAnnonce = $descriptionAnnonce;

        return $this;
    }

    /**
     * Get descriptionAnnonce
     *
     * @return string
     */
    public function getDescriptionAnnonce()
    {
        return $this->descriptionAnnonce;
    }

    /**
     * Set defautObjet
     *
     * @param string $defautObjet
     * @return Annonces
     */
    public function setDefautObjet($defautObjet)
    {
        $this->defautObjet = $defautObjet;

        return $this;
    }

    /**
     * Get defautObjet
     *
     * @return string
     */
    public function getDefautObjet()
    {
        return $this->defautObjet;
    }

    /**
     * Set prixObjet
     *
     * @param integer $prixObjet
     * @return Annonces
     */
    public function setPrixObjet($prixObjet)
    {
        $this->prixObjet = $prixObjet;

        return $this;
    }

    /**
     * Get prixObjet
     *
     * @return integer
     */
    public function getPrixObjet()
    {
        return $this->prixObjet;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Annonces
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
     * @return Annonces
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
     * @return Annonces
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
     * Set categorie
     *
     * @param $categorie
     * @return Annonces
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getcategorie()
    {
        return $this->categorie;
    }

    /**
     * Set localisation
     *
     * @return Annonces
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Add photos
     *
     * @param \Djez\Bundle\DataModeleBundle\Entity\Photos $photos
     * @return Annonces
     */
    public function addPhoto(\Djez\Bundle\DataModeleBundle\Entity\Photos $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \Djez\Bundle\DataModeleBundle\Entity\Photos $photos
     */
    public function removePhoto(\Djez\Bundle\DataModeleBundle\Entity\Photos $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set devise
     *
     * @param string $devise
     * @return Annonces
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return string
     */
    public function getDevise()
    {
        return $this->devise;
    }


    /**
     * Set annee
     *
     * @param integer $annee
     * @return Annonces
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }


    /**
     * Set kilometrage
     *
     * @param integer $kilometrage
     * @return Annonces
     */
    public function setKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    /**
     * Get kilometrage
     *
     * @return integer
     */
    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    /**
     * Set puissance
     *
     * @param puissance $puissance
     * @return Annonces
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getPuissance()
    {
        return $this->puissance;
    }


    /**
     * Set transmission
     *
     * @param transmission $transmission
     * @return Annonces
     */
    public function setTransmission($transmission)
    {
        $this->transmission = $transmission;

        return $this;
    }

    /**
     * Get transmission
     *
     * @return integer
     */
    public function getTransmission()
    {
        return $this->transmission;
    }


    /**
     * Set carburant
     *
     * @param  $carburant
     * @return Annonces
     */
    public function setCarburant($carburant)
    {
        $this->carburant = $carburant;

        return $this;
    }

    /**
     * Get carburant
     *
     * @return string
     */
    public function getCarburant()
    {
        return $this->carburant;
    }


    /**
     * Set modele
     *
     * @param  $modele
     * @return Annonces
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }


    /**
     * Set marque
     *
     * @param  $marque
     * @return Annonces
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }


    /**
     * Set typeAnnonceur
     *
     * @param string $typeAnnonceur
     * @return Annonces
     */
    public function setTypeAnnonceur($typeAnnonceur)
    {
        $this->typeAnnonceur = $typeAnnonceur;

        return $this;
    }

    /**
     * Get typeAnnonceur
     *
     * @return string
     */
    public function getTypeAnnonceur()
    {
        return $this->typeAnnonceur;
    }


    /**
     * Set negociable
     *
     * @param boolean $negociable
     * @return Annonces
     */
    public function setNegociable($negociable)
    {
        $this->negociable = $negociable;

        return $this;
    }

    /**
     * Get negociable
     *
     * @return boolean
     */
    public function getNegociable()
    {
        return $this->negociable;
    }

    /**
     * Set emailAnnonceur
     *
     * @param boolean $emailAnnonceur
     * @return Annonces
     */
    public function setEmailAnnonceur($emailAnnonceur)
    {
        $this->emailAnnonceur = $emailAnnonceur;

        return $this;
    }

    /**
     * Get emailAnnonceur
     *
     * @return boolean
     */
    public function getEmailAnnonceur()
    {
        return $this->emailAnnonceur;
    }

    /**
     * Set telephoneAnnonceur
     *
     * @param string $telephoneAnnonceur
     * @return Annonces
     */
    public function setTelephoneAnnonceur($telephoneAnnonceur)
    {
        $this->telephoneAnnonceur = $telephoneAnnonceur;

        return $this;
    }

    /**
     * Get telephoneAnnonceur
     *
     * @return string
     */
    public function getTelephoneAnnonceur()
    {
        return $this->telephoneAnnonceur;
    }

    /**
     * Set unitePrix
     *
     * @param string $unitePrix
     * @return Annonces
     */
    public function setUnitePrix($unitePrix)
    {
        $this->unitePrix = $unitePrix;

        return $this;
    }

    /**
     * Get unitePrix
     *
     * @return string
     */
    public function getUnitePrix()
    {
        return $this->unitePrix;
    }
}
