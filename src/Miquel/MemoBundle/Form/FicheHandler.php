<?php

namespace Miquel\MemoBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

use Miquel\MemoBundle\Entity\Fiche;

class FicheHandler
{
    protected $form;
    protected $request;
    protected $em;

    public function __construct(Form $form, Request $request, EntityManager $em)
    {
        $this->form    = $form;
        $this->request = $request;
        $this->em      = $em;
    }

    public function process()
    {
        if( $this->request->getMethod() == 'POST' )
        {
            $this->form->bindRequest($this->request);

            if( $this->form->isValid() )
            {
                $this->onSuccess($this->form->getData());

                return true;
            }
        }

        return false;
    }

    public function onSuccess(Fiche $fiche)
    {
		$this->em->persist($fiche);

        // On persiste toutes les categories de la fiche.
        foreach($fiche->getCategories() as $categorie)
        {
            $this->em->persist($categorie);
        }

        $this->em->flush();
    }
}