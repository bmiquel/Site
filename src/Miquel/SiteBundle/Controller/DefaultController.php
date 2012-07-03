<?php

namespace Miquel\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('MiquelSiteBundle:Default:index.html.twig');
    }
}
