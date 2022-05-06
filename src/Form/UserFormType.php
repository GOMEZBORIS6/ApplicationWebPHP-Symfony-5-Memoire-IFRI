<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr'=> ['placeholder' => 'First name'] 
            ])
            ->add('lastname', TextType::class, [
                'attr'=> ['placeholder' => 'Last name'] 
            ])
            ->add('username', TextType::class, [
               
               'attr'=> ['placeholder' => 'Username'] 
            ])
            ->add('email', EmailType::class, [
               
                'attr' => ['placeholder' => 'Email Address']
            ])
            ->add('phone', TextType::class, [
               'attr'=> ['placeholder' => 'Phone number'] 
            ])
            ->add('sexe', null, [
                'attr' => ['placeholder' => 'Choose your gender']
            ])
                
              //->add('roles')
           // ->add('password')
            
            // ->add('isVerified')
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
