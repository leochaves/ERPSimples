<?php

namespace ERP\GameBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProdutoItemType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $today = new \DateTime();
        $year = $today->format('Y') + 2;
        $builder
                ->add('dataEntrada', 'date', array(
                    'empty_value' => array('year' => 'Ano', 'month' => 'Mês', 'day' => 'Dia'),
                    'format' => 'dd-MM-yyyy',
                    'years' => range($year, 1980)))
                ->add('valorEntrada','money',array('currency'=> false))
                ->add('quantidade')
                //->add('saldo')
                //->add('flgConsolidado')
                ->add('fornecedor')
                ->add('game')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\GameBundle\Entity\ProdutoItem'
        ));
    }

    public function getName() {
        return 'erp_gamebundle_produtoitemtype';
    }

}
