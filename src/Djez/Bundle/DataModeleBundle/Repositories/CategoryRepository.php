<?php

namespace Djez\Bundle\DataModeleBundle\Repositories;

use Symfony\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
	public function getAllCategories(){
		$qb = $this->_em->createQueryBuilder(); 
		$qb->select( 'e' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Categories',  'e' )->where('e.actif = true')->orderBy('e.idSuperCategorie', 'ASC');
		return $qb->getQuery()->getResult();
	}
}
