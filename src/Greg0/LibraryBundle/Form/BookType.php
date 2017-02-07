<?php

namespace Greg0\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label' => 'Tytuł'])
            ->add('shortDescription', null, ['label' => 'Skrócony opis'])
            ->add('description', null, ['label' => 'Opis'])
            ->add('coverFile', FileType::class, array(
                'label'         => 'Okładka',
                'data_class'    => 'Symfony\Component\HttpFoundation\File\File',
                'property_path' => 'coverFile',
            ))
            ->add('author', null, [
                'label' => 'Autorzy',
                'attr' => [
                    'class' => 'selectpicker',
                ],
            ])
            ->add('save', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Greg0\LibraryBundle\Entity\Book',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'greg0_librarybundle_book';
    }


}
