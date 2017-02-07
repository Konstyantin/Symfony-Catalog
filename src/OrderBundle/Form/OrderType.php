<?php

namespace OrderBundle\Form;

use OrderBundle\Entity\Orders;
use OrderBundle\Entity\Sales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class OrderType
 * @package OrderBundle\Form
 */
class OrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phone', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'Submit', 'translation_domain' => 'OrderBundle']);
    }

    /**
     * Configuration the options for this type
     * 
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Sales::class]);
    }

    /**
     * Return the prefix of the template block name for the name
     *
     * @return null|string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
