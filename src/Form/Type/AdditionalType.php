<?php

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdditionalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('additional1', TextType::class, [
                'attr' => ['class' => 'input input-bordered w-full max-w-xs', 'placeholder' => 'Additional info 1'],
                'label' => false,
                'row_attr' => ['class' => 'divBottom']
            ])
            ->add('additional2', TextType::class, [
                'attr' => ['class' => 'input input-bordered w-full max-w-xs', 'placeholder' => 'Additional info 2'],
                'label' => false,
                'row_attr' => ['class' => 'divBottom']
            ])
            ->add('additional3', TextType::class, [
                'attr' => ['class' => 'input input-bordered w-full max-w-xs', 'placeholder' => 'Additional info 3'],
                'label' => false,
                'row_attr' => ['class' => 'divBottom']
            ])
            ->add('save', SubmitType::class, ['label' => 'Save', 'attr' => ['class' => 'btn btn-primary']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}