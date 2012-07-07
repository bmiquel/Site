<?php

namespace Miquel\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SiteController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('MiquelSiteBundle::base.html.twig');
    }
}
