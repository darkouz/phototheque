<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, ["label" => "Prénom", "required" => true])
            ->add('name', TextType::class, ["label" => "Nom", "required" => true])
            ->add('email', RepeatedType::class,
                ["type" => EmailType::class,
                    "first_options" => [
                        "label" => "Votre Email",
                        "required"=>true
                    ],
                    "second_options" => [
                        "label" => "Confirmation Email"
                    ],
                    "invalid_message" => "L'email et sa confirmation doivent être identiques"
                ])
            ->add('plainPassword', RepeatedType::class,
                ['type' => PasswordType::class,
                    "first_options" => [
                        "label" => "Password",
                        "required"=>true
                    ],
                    "second_options" => [
                        "label" => "Confirmation password"
                    ],
                    "invalid_message" => "Le password et sa confirmation doivent être identiques"
                ])
            ->add('submit', SubmitType::class,
                ['label' => 'Valider',"attr"=>["class"=>"btn btn-primary"]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => User::class,
        ]);
    }
}
