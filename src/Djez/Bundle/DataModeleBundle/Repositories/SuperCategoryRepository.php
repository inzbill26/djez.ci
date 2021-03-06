<?php

namespace Djez\Bundle\DataModeleBundle\Repositories;

use Symfony\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityRepository;

class SuperCategoryRepository extends EntityRepository
{
	public function getAllSuperCategories(){
		$qb = $this->_em->createQueryBuilder(); 
		$qb->select( 'e' )->from( 'Djez\Bundle\DataModeleBundle\Entity\SuperCategorie',  'e' )->where('e.actif = true')->orderBy('e.idSuperCategorie', 'ASC');
		return $qb->getQuery()->getResult();
	}
}
