<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Publication;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, array(
               'label' => 'Input your main image',
               'required' => false,
               'mapped' => false 
            ))
            ->add('title', TextType::class, array(
                'label' => "Enter your title",
                'attr' => [
                    'placeholder'=>'Input text here'
                ]
            ))
            ->add('content', TextareaType::class, array(
                'label'=>'Your text',
                'attr' => [
                    'placeholder'=>'Some text there'
                ]
            ))
            
            ->add('category', EntityType::class, array(
                'label'=> "Choise your category",
                'class'=> Category::class,
                'choice_label'=>'title',
                'attr'=> [
                    'placeholder'=>'Select category'
                ]
            ))
            ->add('save',SubmitType::class, array(
                'label' => 'Save and add',
                'attr'=>[
                    'class'=>'btn btn-success'
                ]
            ))
            ->add('delete',SubmitType::class, array(
                'label' => 'Delete',
                'attr'=>[
                    'class'=>'btn btn-danger'
                ]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
        ]);
    }
}
