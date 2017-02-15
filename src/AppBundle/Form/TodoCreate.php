<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoCreate extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('category', TextType::class)
            ->add('description', TextareaType::class)
            ->add('dueDate', DateTimeType::class)
            ->add('priority', ChoiceType::class, array(
                'choices' => array(
                    'Low' => 'Low',
                    'Normal' => 'Normal',
                    'High' => 'High'
                )))
            ->add('Save', SubmitType::class, array(
                'label' => 'Create Todo',
                'attr' => array(
                    'class' => 'btn btn-primary',
                    'style' => 'margin-bottom:15px'
                ))
            );

        //KNP Universtity proposal for date:
        //->add('dueDate', DateTimeType::class, array('widget', => 'single_text',));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Todo'
        ));//tells which Model or DB we have to use for the form

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_todo_create';
    }
}
