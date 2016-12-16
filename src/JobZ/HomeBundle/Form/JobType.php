<?php

namespace JobZ\HomeBundle\Form;


use JobZ\HomeBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class JobType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Title'))
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Full-time' => 'full-time',
                    'Part-time' => 'part-time',
                    'Freelance' => 'freelance',
                ),
            ))
            ->add('email', EmailType::class, array('label' => 'Email address'))
            ->add('location', TextType::class, array('label' => 'Location'))
            ->add('position', TextType::class, array('label' => 'Position'))
            ->add('company', TextType::class, array('label' => 'Company'))
            ->add('description', TextareaType::class)
            ->add('apply', TextareaType::class)
            ->add('url', UrlType::class, array('required' => false))
            ->add('category', EntityType::class, array(
                'label' => 'Category',
                'class' => Category::class,
                'choice_label' => 'name'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JobZ\HomeBundle\Entity\Job'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jobz_homebundle_job';
    }


}
