<?php

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['class' => 'input input-bordered w-full max-w-xs', 'placeholder' => 'Firstname'],
                'label' => false,
                'row_attr' => ['class' => 'divBottom']
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['class' => 'input input-bordered w-full max-w-xs', 'placeholder' => 'Lastname'],
                'label' => false,
                'row_attr' => ['class' => 'divBottom']
            ])
            ->add('email', TextType::class, [
                'attr' => ['class' => 'input input-bordered', 'placeholder' => 'Email'],
                'label' => false,
                'row_attr' => ['class' => 'divBottom']
            ])
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'input input-bordered w-full max-w-xs', 'placeholder' => 'Password'],
                'label' => false,
                'row_attr' => ['class' => 'divBottom']
            ])
            ->add('save', SubmitType::class, ['label' => 'Sign up', 'attr' => ['class' => 'btn btn-primary']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}