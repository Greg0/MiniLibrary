<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 26.11.2016
 * Time: 16:08
 */

namespace AppBundle\Admin;


use AppBundle\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('name', TextType::class);
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name');
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('name');
    }


    /**
     * @param $object
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Category
            ? $object->getName()
            : 'Category'; // shown in the breadcrumb on the create view
    }
}