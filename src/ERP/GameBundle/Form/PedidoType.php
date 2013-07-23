<?php

namespace ERP\GameBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valor')
            ->add('data')
            ->add('cod_postagem')
            ->add('flg_pago')
            ->add('cliente')
            ->add('game')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\GameBundle\Entity\Pedido'
        ));
    }

    public function getName()
    {
        return 'erp_gamebundle_pedidotype';
    }
}
