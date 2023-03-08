<?php

namespace App\Form;

use App\Entity\DriverChecked;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DriverCheckedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('startLoading', TimeType::class, [
                'label' => 'Début de la prise en charge du camion',
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['class' => 'start-loading'],
                'data' => new \DateTime() // Définit la valeur par défaut à la date actuelle
                        ])
            ->add('stopLoading', TimeType::class, [
                'label' => 'Fin de la prise en charge du camion',
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['class' => 'stop-loading'],
                'data' => new \DateTime() // Définit la valeur par défaut à la date actuelle
            ])
            // ->add('durationLoading')
            ->add('isCompliant', CheckboxType::class, [
                'label' => 'Avez vous effectué le controle des marchandises ?'
            ])
            ->add('palletsChecked', TextType::class, [
                'label' => 'Nombre de palettes contrôlées',
                'required' => true
            ])
            ->add('isSplited', CheckboxType::class, [
                'label' => 'Y a t-il des palettes splitées ?',
                'required' => false,
                
            ])
            ->add('splitedNumber', TextType::class, [
                'label' => 'Indiquez le nombre de palettes splitées',
                'required' => false
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Indiquez vos remarques',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DriverChecked::class,
        ]);
    }
}
