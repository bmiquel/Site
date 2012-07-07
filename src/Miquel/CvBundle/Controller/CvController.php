<?php

namespace Miquel\CvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CvController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('MiquelCvBundle:Cv:index.html.twig');
    }
	
	public function showAction()
	{
		return $this->render('MiquelCvBundle:Cv:show.html.twig');
	}
}
