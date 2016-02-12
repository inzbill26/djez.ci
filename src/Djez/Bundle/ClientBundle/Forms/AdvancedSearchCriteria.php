<?php

namespace Djez\Bundle\ClientBundle\Forms;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * This classe encapsulate the search criteria for avanced search
 */
class AdvancedSearchCriteria
{

  private $motcle;
  private $superCategorie;
  private $categorie;
  private $marque;
  private $modele;
  private $transmission;
  private $anneeMin;
  private $anneeMax;
  private $puissanceMin;
  private $puissanceMax;
  private $kilometrageMin;
  private $kilometrageMax;
  private $prixMin;
  private $prixMax;
  private $carburant;
  private $deviseAnnonce;
  private $particulier;
  private $professionnel;

  function __construct($criteriaMap){
    $this->motcle =  addcslashes( (isset($criteriaMap['motcle']) ? $criteriaMap['motcle'] : null ),"%_");
    $this->superCategorie = addcslashes((isset($criteriaMap['supercategory']) ? $criteriaMap['supercategory'] : null ),"%_");
    $this->categorie = addcslashes((isset($criteriaMap['category']) ? $criteriaMap['category'] : null ),"%_");
    $this->marque = addcslashes( (isset($criteriaMap['marque']) ? $criteriaMap['marque'] : null ),"%_");
    $this->modele = addcslashes((isset($criteriaMap['modele']) ? $criteriaMap['modele'] : null ),"%_");
    $this->transmission = addcslashes((isset($criteriaMap['transmission']) ? $criteriaMap['transmission'] : null ),"%_");
    $this->anneeMin = addcslashes((isset($criteriaMap['annee_min']) ? $criteriaMap['annee_min'] : null ),"%_");
    $this->anneeMax = addcslashes((isset($criteriaMap['annee_max']) ? $criteriaMap['annee_max'] : null ),"%_");
    $this->puissanceMin = addcslashes((isset($criteriaMap['puissance_min']) ? $criteriaMap['puissance_min'] : null ),"%_");
    $this->puissanceMax = addcslashes((isset($criteriaMap['puissance_max']) ? $criteriaMap['puissance_max'] : null ),"%_");
    $this->carburant = addcslashes((isset($criteriaMap['carburant']) ? $criteriaMap['carburant'] : null ),"%_");
    $this->kilometrageMin = addcslashes((isset($criteriaMap['kilometrage_min']) ? $criteriaMap['kilometrage_min'] : null ),"%_");
    $this->kilometrageMax = addcslashes((isset($criteriaMap['kilometrage_max']) ? $criteriaMap['kilometrage_max'] : null ),"%_");
    $this->prixMin = addcslashes((isset($criteriaMap['prix_min']) ? $criteriaMap['prix_min'] : null ),"%_");
    $this->prixMax = addcslashes((isset($criteriaMap['prix_max']) ? $criteriaMap['prix_max'] : null ),"%_");
    $this->deviseAnnonce = addcslashes((isset($criteriaMap['devise_annonce']) ? $criteriaMap['devise_annonce'] : null ),"%_");
    $this->particulier = addcslashes((isset($criteriaMap['particulier']) ? $criteriaMap['particulier'] : null ),"%_");
    $this->professionnel = addcslashes((isset($criteriaMap['professionnel']) ? $criteriaMap['professionnel'] : null ),"%_");

  }

  public function buildCriteriaString(){

    $queryString = "SELECT e "
                   ."FROM Djez\Bundle\DataModeleBundle\Entity\Annonces e "
                   ."WHERE e.actif = 1 ";

    if (!$this->isNullOrEmptyString($this->categorie)) {
      $queryString .= "AND e.idCategorie = ". $this->categorie ." ";
    }
    if (!$this->isNullOrEmptyString($this->marque)) {
      $queryString .= "AND e.marque = ". $this->marque . " ";
    }
    if (!$this->isNullOrEmptyString($this->modele)) {
      $queryString .= "AND e.modele = ". $this->modele . " ";
    }
    if (!$this->isNullOrEmptyString($this->transmission)) {
      $queryString .= "AND e.transmission = '". $this->transmission . "' ";
    }
    if (!$this->isNullOrEmptyString($this->carburant)) {
      $queryString .= "AND e.carburant = '". $this->carburant . "' ";
    }
    if (!$this->isNullOrEmptyString($this->deviseAnnonce)) {
      $queryString .= "AND e.devise = '". $this->deviseAnnonce . "' ";
    }

    if (!$this->isNullOrEmptyString($this->particulier) && !$this->isNullOrEmptyString($this->professionnel)) {
      $queryString .= "AND ( e.typeAnnonceur = 'PARTICULIER' OR e.typeAnnonceur = 'PROFESSIONEL' ) ";
    }elseif (!$this->isNullOrEmptyString($this->particulier)) {
      $queryString .= "AND e.typeAnnonceur = 'PARTICULIER' ";
    }elseif (!$this->isNullOrEmptyString($this->professionnel)) {
      $queryString .= "AND e.typeAnnonceur = 'PROFESSIONEL' ";
    }

    if (!$this->isNullOrEmptyString($this->anneeMin) && !$this->isNullOrEmptyString($this->anneeMax)) {
      $queryString .= "AND v.annee BETWEEN ". $this->anneeMin . " AND " . $this->anneeMax ." ";
    }elseif (!$this->isNullOrEmptyString($this->anneeMin)) {
      $queryString .= "AND v.annee >= ". $this->anneeMin ." ";
    }elseif (!$this->isNullOrEmptyString($this->anneeMax)) {
      $queryString .= "AND v.annee <= ". $this->anneeMax ." ";
    }

    if (!$this->isNullOrEmptyString($this->puissanceMin) && !$this->isNullOrEmptyString($this->puissanceMax)) {
      $queryString .= "AND v.puissance BETWEEN ". $this->puissanceMin . " AND " . $this->puissanceMax ." ";
    }elseif (!$this->isNullOrEmptyString($this->puissanceMin)) {
      $queryString .= "AND v.puissance >= ". $this->puissanceMin ." ";
    }elseif (!$this->isNullOrEmptyString($this->puissanceMax)) {
      $queryString .= "AND v.puissance <= ". $this->puissanceMax ." ";
    }

    if (!$this->isNullOrEmptyString($this->kilometrageMin) && !$this->isNullOrEmptyString($this->kilometrageMax)) {
      $queryString .= "AND v.kilometrage BETWEEN ". $this->kilometrageMin . " AND " . $this->kilometrageMax ." ";
    }elseif (!$this->isNullOrEmptyString($this->kilometrageMin)) {
      $queryString .= "AND v.kilometrage >= ". $this->kilometrageMin ." ";
    }elseif (!$this->isNullOrEmptyString($this->kilometrageMax)) {
      $queryString .= "AND v.kilometrage <= ". $this->kilometrageMax ." ";
    }

    if (!$this->isNullOrEmptyString($this->prixMin) && !$this->isNullOrEmptyString($this->prixMin)) {
      $queryString .= "AND e.prixObjet BETWEEN ". $this->prixMin . " AND " . $this->prixMax ." ";
    }elseif (!$this->isNullOrEmptyString($this->prixMin)) {
      $queryString .= "AND e.prixObjet >= ". $this->prixMin ." ";
    }elseif (!$this->isNullOrEmptyString($this->prixMax)) {
      $queryString .= "AND e.prixObjet <= ". $this->prixMax ." ";
    }

    $queryString .= "ORDER BY e.dateCreation ASC";

    return $queryString;
  }


  public function buildCriteriaCount(){

    $queryString = "SELECT COUNT(e.idAnnonce) "
                   ."FROM Djez\Bundle\DataModeleBundle\Entity\Annonces e "
                   ."WHERE e.actif = 1 ";

    if (!$this->isNullOrEmptyString($this->categorie)) {
      $queryString .= "AND e.idCategorie = ". $this->categorie ." ";
    }
    if (!$this->isNullOrEmptyString($this->marque)) {
      $queryString .= "AND e.marque = ". $this->marque . " ";
    }
    if (!$this->isNullOrEmptyString($this->modele)) {
      $queryString .= "AND e.modele = ". $this->modele . " ";
    }
    if (!$this->isNullOrEmptyString($this->transmission)) {
      $queryString .= "AND e.transmission = '". $this->transmission . "' ";
    }
    if (!$this->isNullOrEmptyString($this->carburant)) {
      $queryString .= "AND e.carburant = '". $this->carburant . "' ";
    }
    if (!$this->isNullOrEmptyString($this->deviseAnnonce)) {
      $queryString .= "AND e.devise = '". $this->deviseAnnonce . "' ";
    }

    if (!$this->isNullOrEmptyString($this->particulier) && !$this->isNullOrEmptyString($this->professionnel)) {
      $queryString .= "AND ( e.typeAnnonceur = 'PARTICULIER' OR e.typeAnnonceur = 'PROFESSIONEL' ) ";
    }elseif (!$this->isNullOrEmptyString($this->particulier)) {
      $queryString .= "AND e.typeAnnonceur = 'PARTICULIER' ";
    }elseif (!$this->isNullOrEmptyString($this->professionnel)) {
      $queryString .= "AND e.typeAnnonceur = 'PROFESSIONEL' ";
    }

    if (!$this->isNullOrEmptyString($this->anneeMin) && !$this->isNullOrEmptyString($this->anneeMax)) {
      $queryString .= "AND v.annee BETWEEN ". $this->anneeMin . " AND " . $this->anneeMax ." ";
    }elseif (!$this->isNullOrEmptyString($this->anneeMin)) {
      $queryString .= "AND v.annee >= ". $this->anneeMin ." ";
    }elseif (!$this->isNullOrEmptyString($this->anneeMax)) {
      $queryString .= "AND v.annee <= ". $this->anneeMax ." ";
    }

    if (!$this->isNullOrEmptyString($this->puissanceMin) && !$this->isNullOrEmptyString($this->puissanceMax)) {
      $queryString .= "AND v.puissance BETWEEN ". $this->puissanceMin . " AND " . $this->puissanceMax ." ";
    }elseif (!$this->isNullOrEmptyString($this->puissanceMin)) {
      $queryString .= "AND v.puissance >= ". $this->puissanceMin ." ";
    }elseif (!$this->isNullOrEmptyString($this->puissanceMax)) {
      $queryString .= "AND v.puissance <= ". $this->puissanceMax ." ";
    }

    if (!$this->isNullOrEmptyString($this->kilometrageMin) && !$this->isNullOrEmptyString($this->kilometrageMax)) {
      $queryString .= "AND v.kilometrage BETWEEN ". $this->kilometrageMin . " AND " . $this->kilometrageMax ." ";
    }elseif (!$this->isNullOrEmptyString($this->kilometrageMin)) {
      $queryString .= "AND v.kilometrage >= ". $this->kilometrageMin ." ";
    }elseif (!$this->isNullOrEmptyString($this->kilometrageMax)) {
      $queryString .= "AND v.kilometrage <= ". $this->kilometrageMax ." ";
    }

    if (!$this->isNullOrEmptyString($this->prixMin) && !$this->isNullOrEmptyString($this->prixMin)) {
      $queryString .= "AND e.prixObjet BETWEEN ". $this->prixMin . " AND " . $this->prixMax ." ";
    }elseif (!$this->isNullOrEmptyString($this->prixMin)) {
      $queryString .= "AND e.prixObjet >= ". $this->prixMin ." ";
    }elseif (!$this->isNullOrEmptyString($this->prixMax)) {
      $queryString .= "AND e.prixObjet <= ". $this->prixMax ." ";
    }

    $queryString .= "ORDER BY e.dateCreation ASC";

    return $queryString;
  }



  private function isNullOrEmptyString($varToCheck){
    return (!isset($varToCheck) || trim($varToCheck)==='');
  }

  public function getMotcle(){
		return $this->motcle;
	}

	public function setMotcle($motcle){
		$this->motcle = $motcle;
	}

	public function getCategorie(){
		return $this->categorie;
	}

	public function setCategorie($categorie){
		$this->categorie = $categorie;
	}

  public function getSuperCategorie(){
    return $this->superCategorie;
  }

  public function setSuperCategorie($superCategorie){
    $this->superCategorie = $superCategorie;
  }

	public function getMarque(){
		return $this->marque;
	}

	public function setMarque($marque){
		$this->marque = $marque;
	}

	public function getModele(){
		return $this->modele;
	}

	public function setModele($modele){
		$this->modele = $modele;
	}

	public function getTransmission(){
		return $this->transmission;
	}

	public function setTransmission($transmission){
		$this->transmission = $transmission;
	}

	public function getAnneeMin(){
		return $this->anneeMin;
	}

	public function setAnneeMin($anneeMin){
		$this->anneeMin = $anneeMin;
	}

	public function getAnneeMax(){
		return $this->anneeMax;
	}

	public function setAnneeMax($anneeMax){
		$this->anneeMax = $anneeMax;
	}

	public function getPuissanceMin(){
		return $this->puissanceMin;
	}

	public function setPuissanceMin($puissanceMin){
		$this->puissanceMin = $puissanceMin;
	}

	public function getPuissanceMax(){
		return $this->puissanceMax;
	}

	public function setPuissanceMax($puissanceMax){
		$this->puissanceMax = $puissanceMax;
	}

	public function getCarburant(){
		return $this->carburant;
	}

	public function setCarburant($carburant){
		$this->carburant = $carburant;
	}

	public function getKilometrageMin(){
		return $this->kilometrageMin;
	}

	public function setKilometrageMin($kilometrageMin){
		$this->kilometrageMin = $kilometrageMin;
	}

	public function getKilometrageMax(){
		return $this->kilometrageMax;
	}

	public function setKilometrageMax($kilometrageMax){
		$this->kilometrageMax = $kilometrageMax;
	}

	public function getPrixMin(){
		return $this->prixMin;
	}

	public function setPrixMin($prixMin){
		$this->prixMin = $prixMin;
	}

	public function getPrixMax(){
		return $this->prixMax;
	}

	public function setPrixMax($prixMax){
		$this->prixMax = $prixMax;
	}

	public function getDeviseAnnonce(){
		return $this->deviseAnnonce;
	}

	public function setDeviseAnnonce($deviseAnnonce){
		$this->deviseAnnonce = $deviseAnnonce;
	}

	public function getParticulier(){
		return $this->$particulier;
	}

	public function setParticulier($particulier){
		$this->particulier = $particulier;
	}

  public function getProfessionnel(){
    return $this->$professionnel;
  }

  public function setProfessionnel($professionnel){
    $this->professionnel = $professionnel;
  }

}
