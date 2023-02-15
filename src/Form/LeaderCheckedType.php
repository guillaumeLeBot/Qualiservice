<?php

namespace App\Form;

use App\Entity\LeaderChecked;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LeaderCheckedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isDispatch', CheckboxType::class, [
                'label' => 'S\'agit il d\une expédition ?',
                'required' => false
            ])
            ->add('isChargeable', CheckboxType::class, [
                'label' => 'L\'expédition est-elle refacturable ?',
                'required' => false
            ])
            ->add('transferCost', TextType::class, [
                'label' => 'Indiquez le coût du transport',
                'required' => false
            ])
            ->add('isDelivery', CheckboxType::class, [
                'label' => 'S\'agit-il d\une Livraison ?',
                'required' => false
            ])
            ->add('isTruckDocChecked', CheckboxType::class, [
                'label' => 'Les documents de transport ont-ils été vérifiés ?',
                'required' => true
            ])
            ->add('isAlcohol', CheckboxType::class, [
                'label' => 'S\'agit il d\une Livraison d\' alcool ?',
                'required' => false
            ])
            ->add('isCustomDocChecked', CheckboxType::class, [
                'label' => 'Les documents des douannes ont-ils été verifiés ?',
                'required' => false
            ])
            ->add('commentApprehensionCustom', TextareaType::class, [
                'label' => 'Commentaire appurement',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LeaderChecked::class,
        ]);
    }
}
