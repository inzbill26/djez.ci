<?php

namespace Djez\Bundle\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Djez\Bundle\DataModeleBundle\Repositories\AnnoncesRepository;
use Djez\Bundle\DataModeleBundle\Repositories\CategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SuperCategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SpecifiqueRepository;
use Djez\Bundle\DataModeleBundle\Entity\Annonces;
use Djez\Bundle\DataModeleBundle\Entity\Photos;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;


class AccueilController extends Controller
{
	//public function accueilAction($page)
	public function annoncesDuJourAction($page)
	{
				//0. Main tab selector
		$selectedTab = 1; // Acceuil tab
        //1. Get ccy from request
		$devise = $this->getRequest()->getSession()->get('devise');

        //2. Gestion de la barre de recherche rapide
		$categories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Categories')->getAllCategories();
		$subCategories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:SuperCategorie')->getAllSuperCategories();
		$prices = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Prix')->getAllPrices($devise);

       //3. Gestion de pagination
		$annoncesRepository = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Annonces');
		$maxArticles = $this->container->getParameter('max_articles_per_page');
		$page_block_size = $this->container->getParameter('page_block_size');
		$articles_count = $annoncesRepository->countPublishedTotal();

		$pages_count = ceil($articles_count / $maxArticles);
		if($pages_count == 1){
			$pages_count = 0;
		}
		$pagination = array(
			'page' => $page,
			'route' => 'djez_accueil_pagination_homepage',
			'pages_count' => $pages_count,
			'page_per_block' => $page_block_size,
			'route_params' => array()
			);

		 //4. Recuration des annonces du jour via le repository Annonce
		$annonces = $annoncesRepository->getAnnonces($page, $maxArticles);

		return $this->render('DjezClientBundle:Client:accueil.html.twig', array(
			'annonces'=>$annonces,
			'pagination' => $pagination,
			'categories' => $categories,
			'subCategories' => $subCategories,
			'prices' => $prices,
			'devise' => $devise,
			'selectedTab' => $selectedTab
			));
	}

	public function choixDeviseAction($devise)
	{
        //Put the ccy preferency in user session
		$this->getRequest()->getSession()->set('devise',$devise);
		return $this->redirect($this->generateUrl('djez_accueil_homepage', array('page'=>1)));
	}
}
