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
    public function indexAction($page)
    {
        return $this->render('MiquelLinkBundle:Link:index.html.twig', array(
            'page'  => $page
        ));
    }
    
    public function createAction()
    {
        
        $link = new Link();
        
        // On crée le formulaire
        $form = $this->createForm(new LinkType, $link);
        
        // On crée le gestionnaire pour ce formulaire, avec les outils dont il a besoin
        $formHandler = new LinkHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

         // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if ($formHandler->process())
        {
            return $this->redirect( $this->generateUrl('MiquelLinkBundle_show', array('id' => $link->getId())) );
        }
            
            
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule.
        return $this->render('MiquelLinkBundle:Link:create.html.twig', array(
            'form' => $form->createView(),
        ));
       
    }
    
    public function showAction(Link $link)
    {
        return $this->render('MiquelLinkBundle:Link:show.html.twig', array(
            'link' => $link
        ));
    }
    
    public function editAction(Link $link)
    {
        // On crée le formulaire
        $form = $this->createForm(new LinkType, $link);
        
        // On crée le gestionnaire pour ce formulaire, avec les outils dont il a besoin
        $formHandler = new LinkHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

         // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if ($formHandler->process())
        {
            return $this->redirect( $this->generateUrl('MiquelLinkBundle_show', array('id' => $link->getId())) );
        }
        
        return $this->render('MiquelLinkBundle:Link:edit.html.twig', array(
            'form' => $form->createView(),
            'link' => $link,
        ));
    }
    
    public function deleteAction()
    {
        return new Response("Page de suppression");
    }
}