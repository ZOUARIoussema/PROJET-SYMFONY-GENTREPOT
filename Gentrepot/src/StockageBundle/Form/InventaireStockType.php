<?php

namespace StockageBundle\Form;
use StockageBundle\Entity\Emplacement;
use AchatBundle\Entity\ProduitAchat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventaireStockType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateCreation')->add('produit',EntityType::class,['class'=>ProduitAchat::class,'choice_label'=>'libelle','multiple'=>false])
            ->add('emplacement',EntityType::class,['class'=>Emplacement::class,'choice_label'=>'adresse','multiple'=>false])
            ->add('quantiteInventaire');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StockageBundle\Entity\InventaireStock'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stockagebundle_inventairestock';
    }


}
