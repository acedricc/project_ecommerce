<?php

namespace App\Form;

use App\Entity\Commandes;
use App\Entity\Coupons;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('created_at')
            ->add('coupons',EntityType::class,[
                "class" =>Coupons::class,
                "choice_label"=>'code'
                ])
            
            
            
            ->add('user', EntityType::class,[
                "class" =>User::class,
                "choice_label"=>'prenom',

                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class,
            'user' => null,
        ]);
    }
}
