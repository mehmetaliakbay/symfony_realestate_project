<?php

namespace App\Form;

use App\Entity\Estate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('keywords')
            ->add('description')
            ->add('image')
            ->add('star')
            ->add('adress')
            ->add('phone')
            ->add('fax')
            ->add('email')
            ->add('city')
            ->add('location')
            ->add('status')
            ->add('created_at')
            ->add('updated_at')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Estate::class,
        ]);
    }
}
