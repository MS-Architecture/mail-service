<?php

namespace App\Form;

use App\Entity\TransportEncryption;
use App\Entity\TransportProtocol;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TransportType
 * @package App\Form
 */
class TransportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('transportName', TextType::class, [
                'required' => true,
                'label' => 'Name'
            ])
            ->add('transportDescription', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('transportProtocol', EntityType::class, [
                'class' => TransportProtocol::class,
                'choice_label' => TransportProtocol::PROPERTY_DESCRIPTION,
                'label' => 'Protocol'
            ])
            ->add('transportEncryption', EntityType::class, [
                'class' => TransportEncryption::class,
                'choice_label' => TransportEncryption::PROPERTY_DESCRIPTION,
                'label' => 'Encryption'
            ])
            ->add('transportPropertyHost', TextType::class, [
                'required' => false,
                'label' => 'Host'
            ])
            ->add('transportPropertyPort', TextType::class, [
                'required' => false,
                'label' => 'Port'
            ])
            ->add('transportPropertyUsername', TextType::class, [
                'required' => false,
                'label' => 'Username'
            ])
            ->add('transportPropertyPassword', TextType::class, [
                'required' => false,
                'label' => 'Password'
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TransportModel::class,
            'allow_extra_fields' => true
        ]);
    }
}
