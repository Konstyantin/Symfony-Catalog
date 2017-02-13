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

/**
 * Class ConfirmOrderAdmin
 * @package OrderBundle\Admin
 */
class ConfirmOrderAdmin extends AbstractAdmin
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
            ->add('order', EntityType::class, [
                'class' => 'OrderBundle:Orders',
                'choice_label' => 'id',
                'label' => 'order.admin.form.field.order'
            ])
            ->add('phone', 'text', [
                'label' => 'order.admin.form.field.phone'
            ])
            ->add('amount','text', [
                'label' => 'order.admin.form.field.amount'
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
            ->add('order', null, [
                'label' => 'order.admin.filter.label.order'
            ])
            ->add('phone', null, [
                'label' => 'order.admin.filter.label.phone'
            ])
            ->add('amount', null, [
                'label' => 'order.admin.filter.label.amount'
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
            ->addIdentifier('order', EntityType::class, [
                'class' => 'OrderBundle:Status',
                'label' => 'order.admin.list.label.order'
            ])
            ->add('phone', null, [
                'row_align' => 'left',
                'label' => 'order.admin.list.label.phone'
            ])
            ->add('amount', null, [
                'row_align' => 'left',
                'label' => 'order.admin.list.label.amount'
            ])
            ->add('_action', null, [
                'actions' => [
                    'delete' => []
                ],
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

        return 'Confirm';
    }
}