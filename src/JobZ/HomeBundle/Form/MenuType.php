<?php

namespace JobZ\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('position', 'choice', array(
                'choices'  => array(
                    'Header' => 'Header',
                    'Footer' => 'Footer'
                )))
            ->add('information', 'entity', array(
                'label' => 'Information',
                'class' => 'JobZ\HomeBundle\Entity\Information',
                'choice_label' => 'title'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JobZ\HomeBundle\Entity\Menu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jobz_homebundle_menu';
    }


}
