<?php

namespace TresorerieBundle\Form;

use StockageBundle\Entity\CommandeDAprovisionnement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureAchatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder->add('numeroF')
            //    ->add('dateCreation')
            ->add('dateEchaillancePaiement')
            ->add('totalTTC')
            //   ->add('etat')
            //  ->add('totalPaye')
            // ->add('resteAPaye')
            ->add('timbreFiscale')
            ->add('fraisTransport')
            //->add('commandeAp');
            ->add('commandeAp',EntityType::class,['class'=>CommandeDAprovisionnement::class,'choice_label'=>'numeroC','multiple'=>false])
            ->add('Ajout',SubmitType::class);




    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TresorerieBundle\Entity\FactureAchat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tresoreriebundle_factureachat';
    }


}
