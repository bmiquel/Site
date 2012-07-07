<?php

namespace Miquel\MemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('nom', 'text', array('attr' => array('placeholder' => 'Nom de la catégorie')));
    }

    public function getName()
    {
        return 'miquel_memobundle_categorietype';  // N'oubliez pas de changer le nom du formulaire.
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Miquel\MemoBundle\Entity\Categorie', // Ni de modifier la classe ici.
        );
    }
}