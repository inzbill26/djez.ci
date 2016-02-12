<?php

namespace Djez\Bundle\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Djez\Bundle\DataModeleBundle\Repositories\AnnoncesRepository;
use Djez\Bundle\DataModeleBundle\Repositories\CategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SuperCategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SpecifiqueRepository;


class DetailsController extends Controller
{
	public function showDetailsAnnonceAction(){

		//0. Main tab selector
		if (!isset($_POST['selectedTab'])) {
			return $this->redirect($this->generateUrl('djez_accueil_homepage'));
		}
		$selectedTab = $_POST['selectedTab'];
		if( isset($_POST['annonceId']) && isset($_POST['pageNumber']) ){
			$annonceId = $_POST['annonceId'];
			$pageNumber = $_POST['pageNumber'];
			$annoncesRepository = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Annonces');
			$annonce = $annoncesRepository->getAnnonceById($annonceId);
			return $this->render('DjezClientBundle:Client:detail.annonce.html.twig', array('annonce'=>$annonce, 'page'=>$pageNumber, 'selectedTab'=>$selectedTab));
		}else
		{
			$accueilController = $this->container->get('djez_accueil_service');
			//var_dump($accueilController);
			$accueilController->annoncesDuJourAction(1);
		}
	}
}
