<?php

namespace Djez\Bundle\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Djez\Bundle\DataModeleBundle\Repositories\CategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SuperCategoryRepository;
use Djez\Bundle\DataModeleBundle\Repositories\SpecifiqueRepository;


class HeaderController extends Controller
{
	public function quicksearchAction(){
		//1. Get ccy from request
		$devise = $this->getRequest()->getSession()->get('devise');
		//2. Gestion de la barre de recherche rapide
		$categories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Categories')->getAllCategories();
		$subCategories = $this->getDoctrine()->getRepository('DjezDataModeleBundle:SuperCategorie')->getAllSuperCategories();
		$prices = $this->getDoctrine()->getRepository('DjezDataModeleBundle:Prix')->getAllPrices($devise);

		return $this->render('DjezClientBundle:Partial:quicksearch.html.twig', 
			array('categories'=>$categories,
				  'subCategories'=>$subCategories,
				  'prices'=>$prices,
				  'devise'=>$devise
			));
	}
}