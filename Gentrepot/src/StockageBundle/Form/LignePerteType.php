<?php

namespace StockageBundle\Form;

use AchatBundle\Entity\ProduitAchat;
use StockageBundle\Entity\Perte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LignePerteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('perte',EntityType::class,['class'=>Perte::class,'choice_label'=>'id','multiple'=>false])
            ->add('produit',EntityType::class,['class'=>ProduitAchat::class,'choice_label'=>'reference','multiple'=>false])
            ->add('quantite')->add('raisonPerte');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StockageBundle\Entity\LignePerte'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stockagebundle_ligneperte';
    }


}
