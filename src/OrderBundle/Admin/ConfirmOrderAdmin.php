<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 09.02.17
 * Time: 22:40
 */

namespace OrderBundle\Admin;

use OrderBundle\Entity\Sales;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ConfirmOrderAdmin extends AbstractAdmin
{
    /**
     * Configure the filters, used to filter and sort the list of models
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('order', null, [
                'label' => 'OrderId'
            ])
            ->add('phone')
            ->add('amount');
    }

    /**
     * Specific fields which are show when all model are listed
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('order', EntityType::class, [
                'class' => 'OrderBundle:Status',
                'label' => 'OrderId'
            ])
            ->add('phone', null, [
                'row_align' => 'left',
            ])
            ->add('amount', null, [
                'row_align' => 'left'
            ])
            ->add('_action', null, [
                'actions' => [
                    'delete' => []
                ]
            ]);
    }

    /**
     * This receives the object to transform to a string as the first parameter
     *
     * @param mixed $object
     * @return string
     */
    public function toString($object)
    {
        if ($object instanceof Sales) {
            return $object->getOrder();
        }

        return 'Product'; // shown in the breadcrumb on the create view
    }
}