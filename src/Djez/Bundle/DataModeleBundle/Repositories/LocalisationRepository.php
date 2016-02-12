<?php

namespace Djez\Bundle\DataModeleBundle\Repositories;

use Symfony\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityRepository;

class LocalisationRepository extends EntityRepository
{

	public function getVilles($pays){
		$qb = $this->_em->createQueryBuilder();
		$qb->select( 'l' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Localisation', 'l' )->where('l.actif = 1 and l.pays = :pays')->orderBy('l.ville', 'ASC');
		$qb->setParameter('pays', $pays);
		return $qb->getQuery()->getResult();
	}

	public function getLocalisation($idLocalisation){
		$qb = $this->_em->createQueryBuilder();
		$qb->select( 'l' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Localisation', 'l' )->where('l.actif = 1 and l.idLocalisation = :idLocalisation');
		$qb->setParameter('idLocalisation', $idLocalisation);
		return $qb->getQuery()->getSingleResult();
	}

	public function getAllLocalisation(){
		$qb = $this->_em->createQueryBuilder();
		$qb->select( 'l' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Localisation', 'l' )->where('l.actif = 1')->orderBy('l.pays', 'ASC');
		return $qb->getQuery()->getResult();
	}

	public function getAllPays(){
		$qb = $this->_em->createQueryBuilder();
		$qb->select( 'DISTINCT l.pays' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Localisation', 'l' )->where('l.actif = 1')->orderBy('l.pays', 'ASC');
		return $qb->getQuery()->getResult();
	}
}
