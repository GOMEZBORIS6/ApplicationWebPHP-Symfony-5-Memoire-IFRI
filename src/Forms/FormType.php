<?php

namespace App\Forms;

use App\Entity\Classeetudiant;
use App\Entity\Ecue;
use App\Entity\Jour;
use App\Entity\Programmation;
use App\Entity\Ue;
use App\Repository\ClasseetudiantRepository;
use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('semainedeb', DateType::class, [  
                'input'  => 'datetime',
               // 'mapped' => false,
              
                'widget' => 'single_text', 
                'label' => 'Start-week'
            ])

            ->add('semainefin', DateType::class, [ 
                'input'  => 'datetime',
               // 'mapped' => false,
                'widget' => 'single_text', 
                'label' => 'End-week'                       
                ])

            ->add('heuredeb', TimeType::class, [
                //'mapped' => false,
                  'widget'=>'single_text',
                  'with_minutes'=>true,
                  'with_seconds'=>true,
                  'label' => 'Hour-Start' 
                ])

            ->add('heurefin', TimeType::class, [
                    //'input'  => 'timestamp',
                   // 'mapped' => false,
                    'widget' =>'single_text',
                    'with_minutes'=>true,
                    'with_seconds'=>true,
                    'label' => 'Hour-End' 
                ])

             ->add('jour', EntityType::class, [
                   'class' => Jour::class,
                   'placeholder' => 'Choisir le jour du cours',
                   'label' => 'Day of course' 
                
             ])

             ->add('classeetudiant', EntityType::class, [
                   'class' => Classeetudiant::class,
                   'placeholder' => 'Selectionner la classe',
                   'label' => 'Class' 
               ]) 
             ;  
            //->add('save', SubmitType::class);            

         $builder
          ->get('classeetudiant')->addEventListener(
                  FormEvents::POST_SUBMIT,
              function (FormEvent $event){
                 //dump($event->getForm());
                 // dump($event->getData());
                
                $form = $event->getForm();
                $this->addUeField( $form ->getParent(), $form->getData());
           
              }
         );

         $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function(FormEvent $event){
                $data = $event->getData();
               
                /* @var $ecue Ecue*/
                $ecue = $data->getEcue();
                $form = $event->getForm();
                if($ecue) {
                    $ue = $ecue->getUe();
                    $classeetudiant = $ue->getClasseetudiant();
                   
                    $this->addUeField($form, $classeetudiant);
                    $this->addEcueField($form, $ue);
                    $form->get('classeetudiant')->setData($classeetudiant);
                    $form->get('ue')->setData($ue);
                }else{
                    $this->addUeField($form, null);
                    $this->addEcueField($form, null);
                }
            }
        );
    
    }

        /**
         * Rajoute un champs ue au formulaire
        * @param FormInterface $form
        * @param Classeetudiant $classeetudiant
        */
        private function addUeField(FormInterface $form, ?Classeetudiant $classeetudiant){
            $builder= $form->getConfig()->getFormFactory()->createNamedBuilder(
                'ue',
                EntityType::class,
                null,
                [
                    'class' => 'App\Entity\Ue',
                    'placeholder' => $classeetudiant ? 'Selectionnez votre ue' : 'Selectionnez d\'abord votre classe',
                    'mapped'=> false,
                    'label' => 'Ue', 
                    'required'=> false,
                    'auto_initialize' => false,
                    'choices' => $classeetudiant ? $classeetudiant->getUe() : []
                ]
                );
            //$form ->getParent()->add('ue', EntityType::class, [] );

                $builder->addEventListener(
                    FormEvents::POST_SUBMIT, 
                    function (FormEvent $event){
                       // dump($event->getForm());
                       $form = $event->getForm();
                       $this->addEcueField($form->getParent(), $form->getData());
                    }
                );
                $form->add($builder->getForm());
        }

        /**
        * Rajoute un champs ecue au formulaire
        * @param FormInterface $form
        * @param Ue $ue
        */
        private function addEcueField(FormInterface $form, ?Ue $ue){
            $form->add('ecue', EntityType::class, [
                'class'=>'App\Entity\Ecue',
                'placeholder' =>  $ue ? 'Selectionnez votre ecue' : 'Selectionnez d\'abord votre ue',
                'label' => 'Course', 
                'choices'=> $ue ? $ue->getEcue() : []

                
            ]);
        }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Programmation::class]);
    }
}
