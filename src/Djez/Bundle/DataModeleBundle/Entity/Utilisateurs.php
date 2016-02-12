<?php

namespace Djez\Bundle\DataModeleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Utilisateurs
 *
 * @ORM\Table(name="Utilisateurs", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_514AEAA692FC23A8", columns={"adresseEmail"}), @ORM\UniqueConstraint(name="UNIQ_514AEAA6A0D96FBF", columns={"nomUtilisateur"})})
 * @ORM\Entity(repositoryClass="Djez\Bundle\DataModeleBundle\Repositories\UtilisateursRepository")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="salt",
 *          column=@ORM\Column(
 *              name     = "salt",
 *              type     = "string",
 *              length   = 50,
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="password",
 *          column=@ORM\Column(
 *              name     = "password",
 *              type     = "string",
 *              length   = 50,
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="credentialsExpired",
 *          column=@ORM\Column(
 *              name     = "identifiantsExpirer",
 *              type     = "boolean",
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="credentialsExpireAt",
 *          column=@ORM\Column(
 *              name     = "dateExpirationIdentifiant",
 *              type     = "datetime",
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="passwordRequestedAt",
 *          column=@ORM\Column(
 *              name     = "dateExpirationmotDePasse",
 *              type     = "datetime",
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="email",
 *          column=@ORM\Column(
 *              name     = "adresseEmail",
 *              type     = "string",
 *              length   = 150,
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="emailCanonical",
 *          column=@ORM\Column(
 *              name     = "adresseEmailCanonic",
 *              type     = "string",
 *              length   = 150,
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="confirmationToken",
 *          column=@ORM\Column(
 *              name     = "confirmationToken",
 *              type     = "string",
 *              length   = 250,
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="lastLogin",
 *          column=@ORM\Column(
 *              name     = "dateDerniereConnection",
 *              type     = "datetime",
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="username",
 *          column=@ORM\Column(
 *              name     = "nomUtilisateur",
 *              type     = "string",
 *              length   = 250,
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="usernameCanonical",
 *          column=@ORM\Column(
 *              name     = "nomUtilisateurCanonic",
 *              type     = "string",
 *              length   = 250,
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="enabled",
 *          column=@ORM\Column(
 *              name     = "actif",
 *              type     = "boolean",
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="locked",
 *          column=@ORM\Column(
 *              name     = "bloquer",
 *              type     = "boolean",
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="expired",
 *          column=@ORM\Column(
 *              name     = "expirer",
 *              type     = "boolean",
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="expiresAt",
 *          column=@ORM\Column(
 *              name     = "dateExpiration",
 *              type     = "datetime",
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 */
class Utilisateurs extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUtilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=15, nullable=true)
     */
    private $telephone;


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
     * @var string
     *
     * @ORM\Column(name="typeUtilisateur", type="string", nullable=true)
     */
    private $typeUtilisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReinitialisation", type="datetime", nullable=true)
     */
    private $dateReinitialisation;

    protected $username;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->annonces = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idUtilisateur
     *
     * @return integer
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Utilisateurs
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }


    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Utilisateurs
     */
    public function setDateCreation(DateTime $dateCreation = NULL)
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
     * @return Utilisateurs
     */
    public function setDateModification(DateTime $dateModification = NULL)
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
     * Set typeUtilisateur
     *
     * @param string $typeUtilisateur
     * @return Utilisateurs
     */
    public function setTypeUtilisateur($typeUtilisateur)
    {
        $this->typeUtilisateur = $typeUtilisateur;

        return $this;
    }

    /**
     * Get typeUtilisateur
     *
     * @return string
     */
    public function getTypeUtilisateur()
    {
        return $this->typeUtilisateur;
    }


    /**
     * Set dateReinitialisation
     *
     * @param \DateTime $dateReinitialisation
     * @return Utilisateurs
     */
    public function setDateReinitialisation(DateTime $dateReinitialisation = NULL)
    {
        $this->dateReinitialisation = $dateReinitialisation;

        return $this;
    }

    /**
     * Get dateReinitialisation
     *
     * @return \DateTime
     */
    public function getDateReinitialisation()
    {
        return $this->dateReinitialisation;
    }

    /**
     * Get annonces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonces()
    {
        return $this->annonces;
    }
}
