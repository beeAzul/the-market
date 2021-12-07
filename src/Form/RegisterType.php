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
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    /**
     * Describe the register form with some constraints validation and inputs types
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Firstname',
                'constraints'=> new Length(2, 2, 30),
                'attr' => [
                    'placeholder' => 'Please enter your firstname'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Lastname',
                'constraints'=> new Length(2, 2, 30),
                'attr' => [
                    'placeholder' => 'Please enter your lastname'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints'=> new Length(2, 2, 30),
                'attr' => [
                    'placeholder' => 'Please enter valid email'
                ]
            ])
            // RepeatedType is used to get password confirmation
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Passwords must be identical',
                'label' => 'Password',
                'required' => true,
                'first_options' =>
                    [
                        'label' => 'Password',
                        'attr' => ['placeholder' => 'Please enter valid password']
                    ],
                'second_options' =>
                    [
                        'label' => 'Confirm password',
                        'attr' => ['placeholder' => 'Please confirm password']
                    ],
                'attr' => [
                    'placeholder' => 'Please enter valid password'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
