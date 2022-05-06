<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            
            ->add('firstname', TextType::class, [
                'attr'=>[
                    'label' => 'First name',
                    
                ]
                
            ])

            ->add('lastname', TextType::class, [
              'attr'=>[
                'label' => 'Last name',
                
              ] 
            ])
            ->add('username', TextType::class, [
                'attr'=>[
                    'label' => 'Username',
                    
                ]  
            ])
            ->add('email', TextType::class, [
                'attr'=>[
                    'label' => 'Email Adress',
                    
            ]
            ])
            
            ->add('phone', null, [
                'attr'=>[
                    'label' => 'Phone',
                    
            ]
            ] )
            ->add('sexe', ChoiceType::class, [
                'placeholder'=>'Choose your gender',   
                'choices'=> [
                    'Male'=>'Male',
                    'Female'=>'Female',
                ],
                'attr'=>[
                    'label' => 'Gender',
                  
            ]
            ])
          
            
            ->add('plainpassword', RepeatedType::class,  [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => false, 'attr'=>['placeholder'=> 'Password']],
                'second_options' => ['label' => false, 'attr'=>['placeholder'=> 'Confirm Password']],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length(['min' => 6, 'minMessage' => 'Your password should be at least {{ limit }} characters','max'=>4096]) 
                ]
            ])
            // ->add('createdAt')
            // ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
