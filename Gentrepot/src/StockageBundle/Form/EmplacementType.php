<?php

namespace StockageBundle\Form;

use AchatBundle\Entity\ProduitAchat;
use StockageBundle\Entity\Entrepot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmplacementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('entrepot',EntityType::class,['class'=>Entrepot::class,'choice_label'=>'matriculeFiscal','multiple'=>false])
            ->add('adresse')->add('capaciteStockage')->add('quantiteStocker')->add('classe')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StockageBundle\Entity\Emplacement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stockagebundle_emplacement';
    }


}
