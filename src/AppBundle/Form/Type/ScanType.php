<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScanType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('range', 'text', array('required' => true, 'label' => 'Netzwerk Range:'));
        $builder->add('store', 'checkbox', array('required' => false, 'label' => 'Netzwerk speichern'));
        $builder->add('name', 'text', array('required' => false, 'label' => 'Netzwerk Name:'));
        $builder->add('scan', 'submit', array('label' => 'Scan'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            "data_class" => "AppBundle\Form\Model\Scan",
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'appbundle_scan';
    }
}