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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class CategoryAdmin
 * @package CategoryBundle\Admin
 */
class CategoryAdmin extends AbstractAdmin
{
    protected $translationDomain = 'CategoryBundle';

    /**
     * Configure fields which are displayed on the edit and create actions
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('parent', EntityType::class,[
                'class' => 'CategoryBundle:Category',
                'choice_label' => 'name',
                'help' => 'category.help.parent.category',
                'label' => 'category.admin.label.parent.category',
                'multiple' => false,
                'required' => false
            ])
            ->add('name', 'text',[
                'help' => 'category.help.name',
                'label' => 'category.admin.label.name'
            ]);
    }

    /**
     * Configure the filters, used to filter and sort the list of models
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name', null, ['label' => 'category.filters.name']);
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
                'label' => 'id',
                'row_align' => 'left',
                'header_style' => 'width: 30%'
            ])
            ->addIdentifier('name', null, [
                'label' => 'category.list.name',
                'header_style' => 'width: 40%'
            ])
            ->add('_action',null, [
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
        if($object instanceof Category){
            return $object->getName();
        }

        return 'Category'; // shown in the breadcrumb on the create view
    }
}