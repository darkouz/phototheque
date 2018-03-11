<?php

namespace App\Form;

use App\Entity\Photo;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', FileType::class,[
                'label'=>'Photo',
                'required'=>true,
                //'multiple'=>true
            ])
            ->add("tags", EntityType::class,[
                'class'=> Tag::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>false,
                'required'=>true
            ])
            ->add('submit', SubmitType::class,
                ['label' => 'Ajouter',"attr"=>["class"=>"btn btn-primary"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class"=>Photo::class,
        ]);
    }
}
