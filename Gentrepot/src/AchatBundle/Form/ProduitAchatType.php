<?php

namespace AchatBundle\Form;

use AchatBundle\Entity\SousCategorieAchat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitAchatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('reference')
            ->add('libelle')
            ->add('quantiteEnStock')
            ->add('classe')
            ->add('quantiteStockSecurite')
            ->add('dernierPrixAchat')
            ->add('tVA')
            ->add('dimension')
            ->add('description')
            ->add('typeDeConditionnement')
            ->add('prixVente')
            ->add('image',FileType::class,array('label'=>'Veuillez selectionner votre photo','data_class'=>null))
            ->add('image1',FileType::class,array('label'=>'Veuillez selectionner votre photo','data_class'=>null))
            ->add('image2',FileType::class,array('label'=>'Veuillez selectionner votre photo','data_class'=>null))
            ->add('image3',FileType::class,array('label'=>'Veuillez selectionner votre photo','data_class'=>null))
            ->add('image4',FileType::class,array('label'=>'Veuillez selectionner votre photo','data_class'=>null))

            ->add('sousCategorie',EntityType::class,array('class'=>SousCategorieAchat::class,'choice_label'=>'name'));




    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AchatBundle\Entity\ProduitAchat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'achatbundle_produitachat';
    }


}
