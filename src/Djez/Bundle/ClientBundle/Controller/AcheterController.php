<?php

namespace Djez\Bundle\ClientBundle\Controller;

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
use Symfony\Component\Form\Exception\RuntimeException;
use Djez\Bundle\ClientBundle\Forms\AdvancedSearchCriteria;


class AcheterController extends Controller
{

			public function rechercherAnnonceAction(){
				//0. Main tab selector
				$selectedTab = 3; // Third tab Acheter
				$request = $this->getRequest();

				//1. Get ccy from request
			 $devise = $request->getSession()->get('devise');

			 //2. Gestion de la barre de recherche rapide
			 $categories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Categories')->getAllCategories();
			 $subCategories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:SuperCategorie')->getAllSuperCategories();
			 $prices = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Prix')->getAllPrices($devise);

				//3. Recuperation des champs du formulaire
				if (!empty($_POST)) {

					$searchCriteriaArray = array();

					foreach ($_POST as $name => $value) {
						$searchCriteriaArray[$name] = $value;
					}
					$searchCriteriaArray['category'] = explode("-", $_POST['categorie'])[1];
					$searchCriteriaArray['supercategory'] = explode("-", $_POST['categorie'])[0];

				//4. Validation des données et Construction du bean de transfert presentation persistence

					$searchCriteria = new AdvancedSearchCriteria($searchCriteriaArray);

			 //5. Gestion de pagination
				 $annoncesRepository = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Annonces');
				 $maxArticles = $this->container->getParameter('max_articles_per_page');
				 $page_block_size = $this->container->getParameter('page_block_size');
				 $articles_count = $annoncesRepository->countSearchResults($searchCriteria);

				 $pages_count = ceil($articles_count / $maxArticles);
				 if($pages_count == 1){
					 $pages_count = 0;
				 }
				 $pagination = array(
					 'page' => 1,
					 'route' => 'djez_accueil_pagination_homepage',
					 'pages_count' => $pages_count,
					 'page_per_block' => $page_block_size,
					 'route_params' => array()
					 );

			 //6. Recuration des annonces du jour via le repository Annonce
				 $annonces = $annoncesRepository->getAnnoncesByCriteria(1, $maxArticles, $searchCriteria);

				 return $this->render('DjezClientBundle:Client:accueil.html.twig', array(
					 'annonces'=>$annonces,
					 'pagination' => $pagination,
					 'categories' => $categories,
					 'subCategories' => $subCategories,
					 'prices' => $prices,
					 'devise' => $devise,
					 'selectedTab' => $selectedTab
					 ));

		 }else {

	 			return $this->render('DjezClientBundle:Client:acheter.html.twig', array(
	 				'categories' => $categories,
	 				'subCategories' => $subCategories,
	 				'prices' => $prices,
	 				'devise' => $devise,
	 				'selectedTab' => $selectedTab
	 				));
	 		}
		 }

			public function showFormulaireRechercheAction(){

				//0. Main tab selector
				$selectedTab = 3; // Third tab Acheter

				$logger = $this->get('logger');
				$logger->info('AcheterController::showFormulaireRecherche');

				$request = $this->getRequest();

				if($request->isXmlHttpRequest()){

					$queryAction = $request->get('queryAction');
					$idCategorie = $request->get('idCategorie');

					if($queryAction == "MARQUE" ){

						$marques = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Vehicules')->getMarques($idCategorie);
						return $this->container->get('templating')->renderResponse('DjezClientBundle:Partial:marques.html.twig', array('carBrands' => $marques, ));

					}elseif ($queryAction == "MODELE") {

						$idMarque = $request->get('idMarque');
						$modeles = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Vehicules')->getModeles($idMarque, $idCategorie);
						return $this->container->get('templating')->renderResponse('DjezClientBundle:Partial:modeles.html.twig', array('carModeles' => $modeles, ));
					}

				}else{

					//1. Get ccy from request
					$devise = $request->getSession()->get('devise');

					//2. Gestion de la barre de recherche rapide
					$categories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Categories')->getAllCategories();
					$subCategories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:SuperCategorie')->getAllSuperCategories();
					$prices = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Prix')->getAllPrices($devise);

					return $this->render('DjezClientBundle:Client:acheter.html.twig', array(
						'categories' => $categories,
						'subCategories' => $subCategories,
						'prices' => $prices,
						'devise' => $devise,
						'selectedTab' => $selectedTab
						));
				}

		}
}
