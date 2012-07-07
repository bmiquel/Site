<?php

namespace Miquel\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DatepickerType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array(
            'choices' => array(
                'm' => 'Male',
                'f' => 'Female',
            )
        );
    }

    public function getName()
    {
        return 'miquel_sitebundle_datepicker';
    }
}