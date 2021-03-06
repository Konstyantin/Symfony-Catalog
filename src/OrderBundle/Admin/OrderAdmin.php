<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 09.02.17
 * Time: 21:42
 */

namespace OrderBundle\Admin;

use OrderBundle\Entity\Orders;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class OrderAdmin
 * @package OrderBundle\Admin
 */
class OrderAdmin extends AbstractAdmin
{
    protected $translationDomain = 'OrderBundle';

    /**
     * Configure fields which are displayed on the edit and create actions
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('status', EntityType::class, [
                'class' => 'OrderBundle:Status',
                'choice_label' => 'label',
                'label' => 'order.admin.form.field.status'
            ]);
    }

    /**
     * Configure the filters, used to filter and sort the list of models
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'order.admin.filter.label.id'
            ])
            ->add('user', null, [
                'label' => 'order.admin.filter.label.user'
            ])
            ->add('status', null, [
                'label' => 'order.admin.filter.label.status'
            ]);
    }

    /**
     * Specific fields which are show when all model are listed
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, [
                'row_align' => 'left',
                'label' => 'order.admin.list.label.id'
            ])
            ->addIdentifier('user', null, [
                'label' => 'order.admin.list.label.user'
            ])
            ->add('status', EntityType::class, [
                'class' => 'OrderBundle:Status',
                'header_style' => 'width: 50%',
                'label' => 'order.admin.list.label.status'
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
        if ($object instanceof Orders) {
            return $object->getStatus();
        }

        return 'Order'; // shown in the breadcrumb on the create view
    }
}