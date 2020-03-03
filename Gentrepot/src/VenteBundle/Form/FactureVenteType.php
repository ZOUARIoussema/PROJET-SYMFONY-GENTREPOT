<?php

namespace VenteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureVenteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('dateCreation')
            ->add('dateEchaillancePaiement')
            ->add('totalTTC')
            //->add('etat')
            //->add('totalPaye')
           // ->add('resteAPaye')
            ->add('timbreFiscale')
            ->add('fraisTransport');
            //->add('BonLivraison');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VenteBundle\Entity\FactureVente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ventebundle_facturevente';
    }


}
