<?php

namespace App\Form;

use App\Entity\Profiles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichFileType::class, [
                'label' => 'Fichier d\'image',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'asset_helper' => true,
                // Ajoutez des contraintes de validation si nécessaire
                'constraints' => [new File(['maxSize' => '100M', 'mimeTypes' => ['image/jpeg', 'image/png']])],
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profiles::class,
        ]);
    }
}
