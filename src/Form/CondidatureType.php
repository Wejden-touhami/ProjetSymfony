<?php

namespace App\Form;

use App\Entity\Condidature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CondidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomCondidat')
            ->add('PrenomCondidat')
            ->add('AgeCondidat')
            ->add('NumTelCondidat')
            ->add('MailCondidat')
            ->add('AdressVille')
            ->add('LienLinkedin')
            ->add('LienGithub')
             ->add('CvCondidat', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('IdAnnonce')
            ->add('IdCondidat')
            ->add('IdEntretien')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Condidature::class,
        ]);
    }
}
