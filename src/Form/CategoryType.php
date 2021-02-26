<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('image', FileType::class, array(
            'label' => 'Input your main image',
            'required' => false,
            'mapped' => false 
         ))
            ->add('title',TextType::class, array(
                'label'=>"Name of category"
            ))
            ->add('text',TextType::class, array(
                'label'=>'Add some description if you want: '
            ))
            ->add('save', SubmitType::class,array(
                'label'=> 'Add'
            ))
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
