<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Image;
use App\Form\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            // ->add('description')
            ->add('isActive')
            ->add('stock')
        //     ->add('category', EntityType::class, [
        //         'class' => Category::class,
        //         'choice_label' => 'name',
        //     ])
        //     ->add('imagesFiles', FileType::class, [
        //         'label' => "Images",
        //         'mapped' => false,
        //         'multiple' => true
        //     ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
