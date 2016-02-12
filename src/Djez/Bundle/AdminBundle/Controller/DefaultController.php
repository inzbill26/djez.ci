<?php

namespace Djez\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DjezAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
