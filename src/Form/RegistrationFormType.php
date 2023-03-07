<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                    new Regex(
                        '/^.+@(qualiservice|loreal)\.fr$/',
                        'Votre mail doit être au format ...@qualiservice.fr ou ...@loreal.fr'
                    ),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passe doivent être identiques',
                'mapped' => false,
                'options' => ['attr' => ['autocomplete' => 'new-password']],
                'required' => true,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' =>
                            'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex(
                        '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()]).{7,}$/',
                        'Vous devez utiliser 1 lettre majuscule 1 chiffre et 1 caractère spécial'
                    ),
                ],
            ]);

        // Set default role based on email domain
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                /** @var User $user */
                $user = $event->getData();

                if ($user->getEmail()) {
                    $emailDomain = explode('@', $user->getEmail())[1];

                    if ($emailDomain === 'qualiservice.fr') {
                        $user->setRoles(['ROLE_ADMIN']);
                    } elseif ($emailDomain === 'loreal.fr') {
                        $user->setRoles(['ROLE_LOREAL']);
                    }
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}