<?php

namespace App\Form;

use App\Entity\Contact;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Veulliez ecrire votre prénom',
                    'class' => 'form-control'
                ],
                'help' => 'Votre prenom doit être écrit en majuscule'
            ])

            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Veulliez ecrire votre nom',
                    'class' => 'form-control'
                ],
                'help' => 'Votre nom doit être écrit en majuscule'
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Veulliez ecrire votre mail',
                    'class' => 'form-control'
                ],
                'help' => 'Votre mail doit être écrit en majuscule'
            ])

            ->add('subject', TextType::class, [
                'attr' => [
                    'placeholder' => 'Veulliez ecrire votre sujet de mail',
                    'class' => 'form-control'
                ]
            ])
            
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Veulliez ecrire votre message',
                    'class' => 'form-control',
                    'rows' => 8
                ]
            ])

            ->add('phone', TelType::class, [
                'attr' => [
                    'placeholder' => 'Veulliez ecrire votre numero de télephone',
                    'class' => 'form-control'
                ]
            ])

            ->add('az842', TextType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'style' => 'display: none',
                    'autocomplete' => 'off',
                    'tabindex' => '-1'
                ]
            ])
            ->add('captcha', Recaptcha3Type::class,[
                'constraints' => new Recaptcha3(),
                'action_name' => 'homepage'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
