<?php

namespace Djez\Bundle\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	// Redirection de toutes les url non resolu vers la page d'acceuil
	public function indexAction($url){
		return $this->redirect($this->generateUrl('djez_accueil_homepage'));
	}
}
