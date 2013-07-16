<?php

namespace ERP\GameBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType
{
    /**
     * @var bool $embed Flg q indica o form embed em outro 
     */
    private $embed;
    
    function __construct($embed = false) {
        $this->embed = $embed;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('file');
                
        if(!$this->embed){
            $builder->add('game');
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\GameBundle\Entity\Image'
        ));
    }

    public function getName()
    {
        return 'erp_gamebundle_imagetype';
    }
}
