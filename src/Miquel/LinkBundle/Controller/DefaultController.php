<?php

namespace Miquel\LinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('MiquelLinkBundle:Default:index.html.twig', array('name' => $name));
    }
}
