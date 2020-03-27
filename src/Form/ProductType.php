<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('imageFile', VichImageType::class, [
                'allow_delete' => true,
                'asset_helper' => true,
                'download_link' => null,
                'download_uri' => true,
                //'form.label.download' => true,
                'download_label' => 'download',
            ])
            ->add('model')
            ->add('color')
            ->add('descOne')
            ->add('descTwo')
            ->add('mainCategories')
            ->add('subCategory')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
