<?php

namespace Djez\Bundle\DataModeleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DjezDataModeleBundle:Default:index.html.twig', array('name' => $name));
    }
}
