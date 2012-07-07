<?php

namespace Miquel\MemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Miquel\MemoBundle\Entity\Fiche;
use Miquel\MemoBundle\Form\FicheType;
use Miquel\MemoBundle\Form\FicheHandler;


class FicheController extends Controller
{
    
	public function indexAction()
    {
        		
		// On r�cup�re le repository
        $repository = $this->getDoctrine()
									  ->getEntityManager()
									  ->getRepository('MiquelMemoBundle:Fiche');
									  
		

        // On r�cup�re les fiches qu'il faut gr�ce � findBy() :
        $fiches = $repository->findBy(
            array(),                 // Pas de crit�re
            array('dateCreation' => 'desc', 'id' => 'desc')
        );

        return $this->render('MiquelMemoBundle:Fiche:index.html.twig', array(
            'fiches' => $fiches
        ));
    }
	
	 public function voirAction(Fiche $fiche)
    {
        return $this->render('MiquelMemoBundle:Fiche:voir.html.twig', array(
            'fiche' => $fiche
        ));
    }

    public function ajouterAction()
    {
		
		$fiche = new Fiche;

        $form = $this->createForm(new FicheType, $fiche);
		
        $formHandler 	= new FicheHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

        if($formHandler->process())
        {
            return $this->redirect( $this->generateUrl('MiquelMemo_FicheVoir', array('id' => $fiche->getId())) );
        }

        return $this->render('MiquelMemoBundle:Fiche:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
		
    }

    public function modifierAction(Fiche $fiche)
    {
		// On r�cup�re l'EntityManager
		$em = $this->getDoctrine()->getEntityManager();

        // On passe la $fiche r�cup�r� au formulaire
        $form  = $this->createForm(new FicheType, $fiche);
		
        $formHandler 	= new FicheHandler($form, $this->get('request'), $em);

        if($formHandler->process())
        {
            return $this->redirect( $this->generateUrl('MiquelMemo_FicheVoir', array('id' => $fiche->getId())) );
        }

        return $this->render('MiquelMemoBundle:Fiche:modifier.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function supprimerAction(Fiche $fiche)
    {
		
		// On g�n�re un simple formulaire avec l'input de validation
		$form = $this->createFormBuilder()
							 ->getForm();

        if( $this->get('request')->getMethod() == 'POST' )
        {
			// On r�cup�re l'EntityManager
			$em = $this->getDoctrine()->getEntityManager();
			$em->remove($fiche);
			$em->flush();
		
            // Puis on redirige vers l'accueil.
            return $this->redirect( $this->generateUrl('MiquelMemo_FicheAccueil') );
        }

        // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer.
        return $this->render('MiquelMemoBundle:Fiche:supprimer.html.twig', array(
			'form' => $form->createView(),
        ));
    }
	
	public function testAction()
	{
		// On r�cup�re l'EntityManager.
		$em = $this->getDoctrine()->getEntityManager();

		// On r�cup�re les groupes par d�faut � l'inscription d'un membre.
		// Cette m�thode n'existe pas, il faudrait la cr�er bien s�r.
		$fiche = $em->getRepository('MiquelMemoBundle:Fiche')->findOneById(6);

		// On persiste juste le membre.
		// En effet, les groupes existent d�j� et on ne les modifie pas, donc pas besoin de les persister.
		// Et la relation entre membre et groupe, c'est le membre qui la g�re, donc persister le membre persistera la relation.
		$em->remove($fiche);

		// On d�clenche l'enregistrement.
		$em->flush();

		//return new Response('OK');
	}
	
}
