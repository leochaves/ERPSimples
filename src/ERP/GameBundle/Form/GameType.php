<?php

namespace ERP\GameBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GameType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $today = new \DateTime();
        $year = $today->format('Y') + 2;
        $builder
                ->add('name')
                ->add('description')
                ->add('releaseDate', 'date', array(
                    'empty_value' => array('year' => 'Ano', 'month' => 'Mês', 'day' => 'Dia'),
                    'format' => 'dd-MM-yyyy',
                    'years' => range($year, 1980)
                ))
                ->add('console')
                ->add('region')
                ->add('images', 'collection', array(
                    'type' => new ImageType(true),
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'prototype' => true,
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\GameBundle\Entity\Game'
        ));
    }

    public function getName() {
        return 'erp_gamebundle_gametype';
    }

}
