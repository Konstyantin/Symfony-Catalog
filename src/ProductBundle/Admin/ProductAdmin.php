<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 22.12.16
 * Time: 17:45
 */
namespace ProductBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class ProductAdmin
 * @package ProductBundle\Admin
 */
class ProductAdmin extends AbstractAdmin
{
    protected $translationDomain = 'ProductBundle';
    /**
     * Configure fields which are displayed on the edit and create actions
     *
     * @param FormMapper $formMapper
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name','text',[
                'help' => 'product.help.name',
                'label' => 'product.admin.label.name'
            ])
            ->add('price','text',[
                'help' => 'product.help.price',
                'label' => 'product.admin.label.price'
            ])
            ->add('description','textarea',[
                'help' => 'product.help.description',
                'label' => 'product.admin.label.description'
            ])
            ->add('category',EntityType::class,[
                'class' => 'CategoryBundle:Category',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
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
            ->add('id', null, ['label' => 'product.filters.id'])
            ->add('name', null, ['label' => 'product.filters.name'])
            ->add('price', null, ['label' => 'product.filters.price']);
    }

    /**
     * Specific fields which are show when all model are listed
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, ['label' => 'product.list.name'])
            ->add('price', null, ['label' => 'product.list.price'])
            ->add('description', null, ['label' => 'product.list.description']);
    }

    /**
     * This receives the object to transform to a string as the first parameter
     *
     * @param mixed $object
     * @return string
     */
    public function toString($object)
    {
        if($object instanceof Category){
            return $object->getName();
        }

        return 'Product'; // shown in the breadcrumb on the create view
    }
}