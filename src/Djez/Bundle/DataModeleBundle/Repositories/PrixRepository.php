<?php

namespace Djez\Bundle\DataModeleBundle\Repositories;

use Symfony\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityRepository;

class PrixRepository extends EntityRepository
{

	public function getAllPrices($devise = 'EUR'){
		$qb = $this->_em->createQueryBuilder(); 
		$qb->select( 'e' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Prix', 'e' )->where('e.actif = 1 and e.devise = :devise')->orderBy('e.valeur', 'ASC');
		$qb->setParameter('devise', $devise);
		//dump($qb);
		return $qb->getQuery()->getResult();
	}
}
