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

class TodoEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('category', TextType::class)
            ->add('description', TextareaType::class)
            ->add('due_date', DateTimeType::class)
            ->add('priority', ChoiceType::class, array(
                'choices' => array(
                    'Low' => 'Low',
                    'Normal' => 'Normal',
                    'High' => 'High'
                )))
            ->add('Save', SubmitType::class, array(
                    'label' => 'Update Todo',
                    'attr' => array(
                        'class' => 'btn btn-primary',
                        'style' => 'margin-bottom:15px'
                    ))
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Todo'
        ));//tells which Model or DB we have to use for the form
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_todo_edit';
    }
}
