<?php

namespace Djez\Bundle\DataModeleBundle\Repositories;

use Symfony\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

class PhotosRepository extends EntityRepository
{

    public function getPhoto($uniqueName){
    	
    	$qb = $this->_em->createQueryBuilder();
    	$qb->select( 'p' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Photos',  'p' )->where('p.nomUnique = :nomUnique');
        $qb->setParameter('nomUnique', $uniqueName);
        return $qb->getQuery()->getResult();
    }

    public function getPhoto($idAnnonce){
    	
    	$qb = $this->_em->createQueryBuilder();
    	$qb->select( 'p' )->from( 'Djez\Bundle\DataModeleBundle\Entity\Photos',  'p' )->where('p.nomUnique = :nomUnique');
        $qb->setParameter('nomUnique', $uniqueName);
        return $qb->getQuery()->getResult();
    }
}