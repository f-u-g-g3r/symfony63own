<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class, [
                'attr' => ['class' => 'form-control', 'autofocus' => '1'],
                'label' => 'Company name',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('companyEmail', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Company email',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('companyAddress', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Company address',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('contactPhoneNumber', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Contact phone number',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('requirements', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Requirements',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Title',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('body', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Main text',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('posted_until', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'label' => 'Expiration date',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('submit', SubmitType::class, [
                'row_attr' => ['class' => 'float-right'],
                'label' => 'Add post',
                'attr' => ['class' => 'btn btn-primary']])
        ;
    }
}