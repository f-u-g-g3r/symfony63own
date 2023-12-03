<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class ,[
                'attr' => ['class' => 'form-control', 'autofocus' => '1'],
                'label' => 'Eesnimi',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('lastName', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Perekonnanimi',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'E-posti aadress',
                'row_attr' => ['class' => 'form-group']
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'attr' => ['class' => 'form-control', 'autocomplete' => 'new-password'],
                'label' => 'Salasõna',
                'row_attr' => ['class' => 'form-group'],
                'mapped' => false,
//                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Sisestage kehtiv salasõna',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Salasõna peab sisaldama vähemalt {{ limit }} märki',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
//            ->add('agreeTerms', CheckboxType::class, [
//                'attr' => ['class' => 'form-control'],
//                'label' => 'Nõustun tingimustega',
//                'row_attr' => ['class' => 'form-group'],
//                'mapped' => false,
//                'constraints' => [
//                    new IsTrue([
//                        'message' => 'You should agree to our terms.',
//                    ]),
//                ],
//            ])
            ->add('submit', SubmitType::class, [
                'row_attr' => ['class' => 'float-right'],
                'label' => 'Loo konto',
                'attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
