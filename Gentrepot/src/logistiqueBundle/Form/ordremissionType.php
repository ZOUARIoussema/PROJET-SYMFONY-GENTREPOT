<?php

namespace logistiqueBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use VenteBundle\Entity\BonLivraison;

class ordremissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id')->add('datecreation')->add('datesortie')->add('dateretour')


            ->add('id_vehicule')
          //  ->add('id_chauffeur')
            ->add('id_aidechauff')
        ->add('bondelivraisons',EntityType::class,['class'=>BonLivraison::class,'choice_label'=>'id','multiple'=>true]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'logistiqueBundle\Entity\ordremission'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'logistiquebundle_ordremission';
    }


}
