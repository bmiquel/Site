<?php

namespace Miquel\LinkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
	    $builder
            ->add('url', 'url', array('attr' => array('class' => 'span12', 'placeholder' => 'Lien du site')))
            ->add('description', 'text', array('attr' => array('class' => 'span12', 'placeholder' => 'Description')));
    }

    public function getName()
    {
        return 'miquel_linkbundle_linktype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Miquel\LinkBundle\Entity\Link',
        );
    }
}