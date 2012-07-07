<?php

namespace Miquel\MemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FicheType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
	    $builder
			->add('titre',   'text', array('attr' => array('placeholder' => 'Titre', 'class' => 'span12')))
            
			->add('auteur',  'text', array('attr' => array('placeholder' => 'Auteur', 'class' => 'span12')))
			
            ->add('contenu', 'textarea', array('attr' => array('class' => 'fiche-contenu span12')))
			
			->add('dateCreation', 'date', array('widget' => 'single_text', 'input' => 'datetime', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'span12 jquery-date')))
			
            ->add('categories', 'entity', array('class' => 'MiquelMemoBundle:Categorie', 
																 'property' => 'nom', 
																 'multiple' => true,
																 'attr' => array('class' => 'span12'))
					  );
    }

    public function getName()
    {
        return 'miquel_memobundle_fichetype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Miquel\MemoBundle\Entity\Fiche',
        );
    }
}