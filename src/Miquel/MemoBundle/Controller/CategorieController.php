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
        		
		// On récupère le repository
        $repository = $this->getDoctrine()
									  ->getEntityManager()
									  ->getRepository('MiquelMemoBundle:Categorie');
								
        // On récupère les fiches qu'il faut grâce à findBy() :
        $categories = $repository->findAll(
            array(),                 // Pas de critère
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
		// On récupère l'EntityManager
		$em = $this->getDoctrine()->getEntityManager();

        // On passe la $categorie récupéré au formulaire
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
		
		// On récupère l'EntityManager
		$em = $this->getDoctrine()->getEntityManager();
		$em->remove($categorie);
		$em->flush();
	
		// Puis on redirige vers l'accueil.
		return $this->redirect( $this->generateUrl('MiquelMemo_CategorieAccueil') );

    }
	
	public function testAction()
	{
		// On récupère l'EntityManager.
		$em = $this->getDoctrine()->getEntityManager();

		// On récupère les groupes par défaut à l'inscription d'un membre.
		// Cette méthode n'existe pas, il faudrait la créer bien sûr.
		$fiche = $em->getRepository('MiquelMemoBundle:Fiche')->findOneById(6);

		// On persiste juste le membre.
		// En effet, les groupes existent déjà et on ne les modifie pas, donc pas besoin de les persister.
		// Et la relation entre membre et groupe, c'est le membre qui la gère, donc persister le membre persistera la relation.
		$em->remove($fiche);

		// On déclenche l'enregistrement.
		$em->flush();

		//return new Response('OK');
	}
	
}
