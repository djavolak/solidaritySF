<?php

namespace App\Form\Admin;

use App\Entity\DamagedEducator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DamagedEducatorEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Ime',
            ])
            ->add('city', TextType::class, [
                'label' => 'Grad (Prebivalište oštećenog)',
            ])
            ->add('amount', IntegerType::class, [
                'label' => 'Cifra',
                'attr' => [
                    'min' => 500,
                    'max' => DamagedEducator::MONTHLY_LIMIT,
                ],
            ])
            ->add('accountNumber', TextType::class, [
                'label' => 'Broj računa',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Sačuvaj',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DamagedEducator::class,
        ]);
    }
}
