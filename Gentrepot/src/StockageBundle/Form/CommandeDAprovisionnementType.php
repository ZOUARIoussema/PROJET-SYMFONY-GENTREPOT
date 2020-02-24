<?php

namespace StockageBundle\Form;

use AchatBundle\Entity\Fournisseur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeDAprovisionnementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numeroC')->add('dateCreation')->add('etat', ChoiceType::class, array('choices' => array('non_facturer' => 'non_facturer','facturer' => 'facturer')))->add('tauxRemise')
            ->add('fournisseur',EntityType::class,['class'=>Fournisseur::class,'choice_label'=>'matriculeFiscale','multiple'=>false]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StockageBundle\Entity\CommandeDAprovisionnement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stockagebundle_commandedaprovisionnement';
    }


}
