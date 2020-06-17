<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body', CKEditorType::class, [
                'config' => array('toolbar' => 'full'),
            ])
            ->add('frontpage')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label_format' => "Image",
                'label' => "Image",
                'download_link' => true,
                'allow_delete' => true,
                'asset_helper' => true,
                'empty_data' => $builder->getForm()->getData('blog')->getImageFile(),
                //  'download_uri' => '...',
                'download_label' => 'download_file',
                'attr' => [
                    'height' => 150,
                ],
            ])
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
