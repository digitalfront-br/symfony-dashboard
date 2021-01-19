<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr'  => [
                    'placeholder'  => 'Email',
                    'class' => 'uk-input',
                ]
            ])
            ->add('password', PasswordType::class, [
                'required'  => false,
                'empty_data' => '12345',
                'attr'  => [
                    'placeholder'  => 'Senha',
                    'class' => 'uk-input',
                    'type'  =>  'password'
                ]
            ])
            ->add('name', TextType::class, [
                'attr'  => [
                    'placeholder'  => 'Nome',
                    'class' => 'uk-input',
                ]
            ])
            ->add('status', ChoiceType::class, [
                'required' => true,
                'multiple'  => false,
                'expanded'  => false,
                'empty_data' => 1,
                'choices' => [
                    'Inativo' => 0,
                    'Ativo' => 1,
                    'Trial' => 2,
                ],
                'attr'  => [
                    'placeholder'  => 'Tipo',
                    'class' => 'uk-select'
                ]
            ])
            ->add('bio', TextareaType::class, [
                'required'  => false,
                'empty_data' => 'Coloque aqui uma descrição',
                'attr'  => [
                    'placeholder'  => 'Descrição',
                    'class' => 'uk-textarea',
                    'rows' => 4,
                    'type'  =>  'password'
                ]
            ])
            ->add('avatar', TextType::class, [
                'required'  => false,
                'empty_data' => 'default-avatar.jpg',
                'attr'  => [
                    'placeholder'  => 'Avatar',
                    'class' => 'uk-input',
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple'  => false,
                'expanded'  => false,
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN'
                ],
                'attr'  => [
                    'placeholder'  => 'Tipo',
                    'class' => 'uk-select'
                ]
            ]);
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    return count($rolesArray) ? $rolesArray[0] : null;
                },
                function ($rolesString) {
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
