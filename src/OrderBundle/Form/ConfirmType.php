<?php

namespace OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * Class Confirm
 * @package OrderBundle\Form
 */
class ConfirmType extends AbstractType
{
    /**
     * Build Form and define form field
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phone', NumberType::class,[
                'required' => false,
                'translation_domain' => 'OrderBundle',
                'attr' => [
                    'placeholder' => 'order.form.field.placeholder.phone'
                ],
                'label' => 'order.form.field.label.phone'
            ])
            ->add('Submit', SubmitType::class, [
                'translation_domain' => 'OrderBundle',
                'attr' => [
                    'class' => 'btn btn-success'
                ],
                'label' => 'order.form.field.label.submit'
            ]);
    }

    /**
     * Configuration the options for this type
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'OrderBundle\Entity\Sales'
        ]);
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
