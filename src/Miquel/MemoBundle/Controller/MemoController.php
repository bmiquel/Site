<?php

namespace Miquel\MemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MemoController extends Controller
{
    
	public function aideAction()
    {
        return $this->render('MiquelMemoBundle:Default:aide.html.twig');
    }
	
	public function indexAction()
    {
        return $this->render('MiquelMemoBundle:Default:index.html.twig');
    }
}
