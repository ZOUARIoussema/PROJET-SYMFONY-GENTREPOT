<?php

namespace StockageBundle\Form;


use AchatBundle\Entity\ProduitAchat;
use StockageBundle\Entity\CommandeDAprovisionnement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneCommandeDApprovisionnementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('produit',EntityType::class,['class'=>ProduitAchat::class,'choice_label'=>'libelle','multiple'=>false])
            ->add('prix')->add('quantite')->add('tva')
            ->add('commande',EntityType::class,['class'=>CommandeDAprovisionnement::class,'choice_label'=>'numeroC','multiple'=>false])
            ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StockageBundle\Entity\LigneCommandeDApprovisionnement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stockagebundle_lignecommandedapprovisionnement';
    }


}
