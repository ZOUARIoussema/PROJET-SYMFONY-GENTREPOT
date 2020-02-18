<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roles', CollectionType::class, array(
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



                )],

        ));
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}



