<?php

namespace App\Form;

use App\Entity\Coupons;
use App\Entity\CouponTypes;
use App\Form\CouponTypesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CouponsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('description')
            ->add('remise')
            ->add('max_usage')
            ->add('date_validation')
            ->add('is_valid')
            ->add('created_at')
            ->add('coupons_types', EntityType::class,
            ['class' => CouponTypes::class,
            'choice_label' => 'name',
            'placeholder'=>"sélectionnez un type de coupon"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coupons::class,
        ]);
    }
}
