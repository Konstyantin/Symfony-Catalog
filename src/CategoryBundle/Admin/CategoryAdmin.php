<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 21.12.16
 * Time: 0:20
 */
namespace CategoryBundle\Admin;

use CategoryBundle\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CategoryAdmin
 * @package CategoryBundle\Admin
 */
class CategoryAdmin extends AbstractAdmin
{
    /**
     * Configure fields which are displayed on the edit and create actions
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text',[
            'help' => 'Enter name category',
        ]);
    }

    /**
     * Configure the filters, used to filter and sort the list of models
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    /**
     * Specific fields which are show when all model are listed
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
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

        return 'Category'; // shown in the breadcrumb on the create view
    }
}