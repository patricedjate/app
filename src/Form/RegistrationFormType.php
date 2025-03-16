<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                "attr"=>[
                    "class"=>"form-control floating"
                ],
                "label_attr"=>[
                    "class"=>"focus-label"
                ],
                "label"=>"Email"
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                "class"=>"form-control floating"
            ],
            "label_attr"=>[
                "class"=>"focus-label"
            ],
            "label"=>"Mot de passe",
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nom',TextType::class,[
                "attr"=>[
                    "class"=>"form-control floating"
                ],
                "label_attr"=>[
                    "class"=>"focus-label"
                ],
                "label"=>"Nom"
            ])
            ->add('prenom',TextType::class,
            [
                "attr"=>[
                    "class"=>"form-control floating"
                ],
                "label_attr"=>[
                    "class"=>"focus-label"
                ],
                "label"=>"Prenom"
            ])
            ->add('contact',TextType::class,
            [
                "attr"=>[
                    "class"=>"form-control floating"
                ],
                "label_attr"=>[
                    "class"=>"focus-label"
                ],
                "label"=>"Contact"
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
