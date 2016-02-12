<?php

namespace Djez\Bundle\DataModeleBundle\Repositories;

use Symfony\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

class AnnoncesRepository extends EntityRepository
{

    public function getAnnonces($page=1, $maxperpage=10){

    	$qb = $this->_em->createQueryBuilder();
    	$qb->select( 'e' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Annonces',  'e' )->where('e.actif = 1')->orderBy('e.dateCreation', 'ASC');
      $qb->setFirstResult(($page-1) * $maxperpage)->setMaxResults($maxperpage);
      return new Paginator($qb);
    }

    public function countPublishedTotal(){

    	$qb = $this->_em->createQueryBuilder();
    	return $qb->select( 'COUNT(e)' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Annonces',  'e' )->where('e.actif = true')->getQuery()->getSingleScalarResult();
    }

    public function getAnnoncesPagerFanta($page=1, $maxperpage=10)
    {
    	$qb = $this->_em->createQueryBuilder();
    	$qb->select( 'e' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Annonces',  'e' )->where('e.actif = 1')->orderBy('e.dateCreation', 'ASC');
    	$pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
    	$pagerfanta->setMaxPerPage($maxperpage);
    	try {
    		$pagerfanta->setCurrentPage($page);
    	} catch(NotValidCurrentPageException $e) {
    		throw new NotFoundHttpException();
    	}
    	return $pagerfanta;
    }

    public function getAnnonceById($idAnnonce){
        $qb = $this->_em->createQueryBuilder();
        $qb->select( 'e' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Annonces',  'e' )->where('e.idAnnonce = :idAnnonce');
        $qb->setParameter('idAnnonce', $idAnnonce);

        return $qb->getQuery()->getSingleResult();
    }

    public function countSearchResults($searchCriteria){
          $query = $this->_em->createQuery($searchCriteria->buildCriteriaCount());
          $query->getResult();
    }

    public function getAnnoncesByCriteria($page=1, $maxperpage=10, $searchCriteria){
      $qb = $this->_em->createQuery($searchCriteria->buildCriteriaString());
      $qb->setFirstResult(($page-1) * $maxperpage)->setMaxResults($maxperpage);
      return new Paginator($qb);
    }

    // Marques et modeles

    public function getMarques($idCategorie){

  		$sqlQuery = "SELECT m.libelleMarque, m.idMarque
  					 FROM Marques m, CategorieMarques cm
  					 WHERE m.idMarque = cm.idMarque
  					 AND cm.actif = 1
  					 AND cm.idCategorie = ?";

  		dump($sqlQuery);
  		$rsm = new ResultSetMapping();
  		$rsm->addScalarResult("libelleMarque", "libelleChamp");
  		$rsm->addScalarResult("idMarque", "valeurChamp");

  		$doctrineNativeQuery = $this->_em->createNativeQuery($sqlQuery, $rsm);
  		$doctrineNativeQuery->setParameter(1, $idCategorie);

  		return $doctrineNativeQuery->getResult();
  	}


  	public function getModeles($idMarque, $idCategorie){

  		$sqlQuery = "SELECT m.libelleModele, m.idModele
  					 FROM Modeles m, CategorieMarques cm
  					 WHERE m.idMarque = cm.idMarque
  					 AND cm.actif = 1
  					 AND cm.idMarque = ?
  					 AND cm.idCategorie = ?";

  		$rsm = new ResultSetMapping();
  		$rsm->addScalarResult("libelleModele", "libelleChamp");
  		$rsm->addScalarResult("idModele", "valeurChamp");

  		$doctrineNativeQuery = $this->_em->createNativeQuery($sqlQuery, $rsm);
  		$doctrineNativeQuery->setParameter(1, $idMarque);
  		$doctrineNativeQuery->setParameter(2, $idCategorie);

  		return $doctrineNativeQuery->getResult();
  	}


}
