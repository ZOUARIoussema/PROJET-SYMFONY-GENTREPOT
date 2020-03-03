<?php


namespace UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'attr' => [
                    'class' =>'input-text',
                    'cols' => 10,
                ]
            ])
            ->add('prenom')
            ->add('ville')
             ->add('DateNaissance',DateType::class ,[
             'placeholder' => [
        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
    ]])


             ->add('tel')
             ->add('type')
        ->add('roles', CollectionType::class, array(
        'entry_type' => ChoiceType::class,
        'entry_options' => [
            'label' => false,
            'choices'   => array(
                'Fournisseur'   => 'ROLE_FOURN',
                'Responsble vente'      => 'ROLE_RVENT',
                'Responsable achat'      => 'ROLE_RACHA',
                'Responsable stock'      => 'ROLE_STOCK',
                'Caisse'      => 'ROLE_ACAIS',
                'Chef de parc'      => 'ROLE_CPARC',
                'admin'      => 'ROLE_ADMIN',
                'Client'      => 'ROLE_CLIEN',



            )]));



    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }


}