<?php

namespace Miquel\LinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;


use Miquel\LinkBundle\Entity\Link;
use Miquel\LinkBundle\Form\LinkHandler;
use Miquel\LinkBundle\Form\LinkType;


class LinkController extends Controller
{
    public function indexAction()
    {
        
        $link = new Link();
        
        // On crée le formulaire
        $form = $this->createForm(new LinkType, $link);
        
        $liens = $this->getDoctrine()->getEntityManager()->getRepository('MiquelLinkBundle:Link')->findAll();
        
         // On crée le gestionnaire pour ce formulaire, avec les outils dont il a besoin
        $formHandler = new LinkHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

         // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if ($formHandler->process())
        {
            return $this->redirect( sprintf('%s#%s', $this->generateUrl('MiquelLink_Accueil'), $link->getId()) );
        }
        
        return $this->render('MiquelLinkBundle:Link:index.html.twig', array(
            'form' => $form->createView(),
            'liens' => $liens
        ));
    }
        
    public function modifierAction(Link $link)
    {
        // On crée le formulaire
        $form = $this->createForm(new LinkType, $link);
        
        // On crée le gestionnaire pour ce formulaire, avec les outils dont il a besoin
        $formHandler = new LinkHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

         // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if ($formHandler->process())
        {
            return $this->redirect( $this->generateUrl('MiquelLink_Voir', array('id' => $link->getId())) );
        }
        
        return $this->render('MiquelLinkBundle:Link:modifier.html.twig', array(
            'form' => $form->createView(),
            'link' => $link,
        ));
    }
    
    public function supprimerAction(Link $link)
    {
        // On récupère l'EntityManager
		$em = $this->getDoctrine()->getEntityManager();
		$em->remove($link);
		$em->flush();
	
		// Puis on redirige vers l'accueil.
		return $this->redirect( $this->generateUrl('MiquelLink_Accueil') );
    }
}