<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 26.11.2016
 * Time: 16:24
 */

namespace AppBundle\Admin;


use AppBundle\Entity\BlogPost;
use AppBundle\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BlogPostAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('General')
                ->add('title', TextType::class)
                ->add('body', TextareaType::class)
            ->end();
        $form
            ->with('Metadata')
                ->add('category', EntityType::class, [
                    'class' => 'AppBundle:Category',
                    'choice_label' => 'name'
                ])
            ->end();
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('title');
        $list->add('category.name');
        $list->add('draft');
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('title');
        $filter->add('category.name');
    }

    /**
     * @param $object
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view
    }
}