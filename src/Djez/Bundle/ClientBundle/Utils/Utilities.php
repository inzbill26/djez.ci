<?php

namespace Djez\Bundle\ClientBundle\Utils;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Djez\Bundle\DataModeleBundle\Repositories\AnnoncesRepository;
use Djez\Bundle\DataModeleBundle\Repositories\CategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SuperCategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SpecifiqueRepository;
use Djez\Bundle\DataModeleBundle\Entity\Annonces;
use Djez\Bundle\DataModeleBundle\Entity\Photos;
use Djez\Bundle\DataModeleBundle\Entity\Vehicules;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;


class Utilities
{
	//public function accueilAction($page)
	public function getPaginationData($page)
	{   
        //2. Gestion de la barre de recherche rapide
		$categories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Categories')->getAllCategories();
		$subCategories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:SuperCategorie')->getAllSuperCategories();
		$prices = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Prix')->getAllPrices($devise);

       //3. Gestion de pagination
		$annoncesRepository = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Annonces');
		$maxArticles = $this->container->getParameter('max_articles_per_page');
		$page_block_size = $this->container->getParameter('page_block_size');
		$articles_count = $annoncesRepository->countPublishedTotal();
		//$pages_count = ceil($articles_count / $maxArticles);
		$pages_count = ceil($articles_count / $maxArticles);
		if($pages_count == 1){
			$pages_count = 0;
		}
	}
}
