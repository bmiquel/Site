<?php

namespace Miquel\MemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Miquel\MemoBundle\Entity\Fiche;
use Miquel\MemoBundle\Form\FicheType;
use Miquel\MemoBundle\Form\FicheHandler;

use Miquel\MemoBundle\Entity\Categorie;
use Miquel\MemoBundle\Form\CategorieType;
use Miquel\MemoBundle\Form\CategorieHandler;


class CategorieController extends Controller
{
    
	public function indexAction()
    {
        		
		// On r�cup�re le repository
        $repository = $this->getDoctrine()
									  ->getEntityManager()
									  ->getRepository('MiquelMemoBundle:Categorie');
								
        // On r�cup�re les fiches qu'il faut gr�ce � findBy() :
        $categories = $repository->findAll(
            array(),                 // Pas de crit�re
            array('nom' => 'asc') // On tri par nom croissante
        );

        return $this->render('MiquelMemoBundle:Categorie:index.html.twig', array(
            'categories' => $categories
        ));
    }
	
	 public function voirAction(Categorie $categorie)
    {
        $repository = $this->getDoctrine()->getEntityManager()->getRepository('MiquelMemoBundle:Categorie')->getAllFiches($categorie);
        
        $listeFiches = array();
        
        foreach($repository as $cat)
            foreach ($cat->getFiches() as $temp)
                $listeFiches[] = $temp;

        
        return $this->render('MiquelMemoBundle:Categorie:voir.html.twig', array(
            'categorie' => $categorie,
            'listeFiches' => $listeFiches
        ));
    }

    public function ajouterAction()
    {
		
		$categorie = new Categorie;

        $form = $this->createForm(new CategorieType, $categorie);
		
        $formHandler 	= new CategorieHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

        if($formHandler->process())
        {
            return $this->redirect( $this->generateUrl('MiquelMemo_CategorieVoir', array('id' => $categorie->getId())) );
        }

        return $this->render('MiquelMemoBundle:Categorie:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
		
    }

    public function modifierAction(Categorie $categorie)
    {
		// On r�cup�re l'EntityManager
		$em = $this->getDoctrine()->getEntityManager();

        // On passe la $categorie r�cup�r� au formulaire
        $form  = $this->createForm(new CategorieType, $categorie);
		
        $formHandler 	= new CategorieHandler($form, $this->get('request'), $em);

        if($formHandler->process())
        {
            return $this->redirect( $this->generateUrl('MiquelMemo_CategorieVoir', array('id' => $categorie->getId())) );
        }

        return $this->render('MiquelMemoBundle:Categorie:modifier.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function supprimerAction(Categorie $categorie)
    {
		
		// On r�cup�re l'EntityManager
		$em = $this->getDoctrine()->getEntityManager();
		$em->remove($categorie);
		$em->flush();
	
		// Puis on redirige vers l'accueil.
		return $this->redirect( $this->generateUrl('MiquelMemo_CategorieAccueil') );

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
