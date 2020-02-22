<?php

namespace TresorerieBundle\Controller;

use StockageBundle\Entity\CommandeDAprovisionnement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use TresorerieBundle\Entity\FactureAchat;
use TresorerieBundle\Form\FactureAchatType;

class FactureAchatController extends Controller
{



    public function ajouterFactureParCommandeAction(Request $request,$id )
    {



        $facture= new FactureAchat();


        $commmade=$this->getDoctrine()->getManager()->getRepository(CommandeDAprovisionnement::class)->find($id);

        $facture->setCommandeAp($commmade);



        $form= $this->createForm(FactureAchatType::class,$facture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){


            $facture->setEtat("non_paye");
            $facture->setDateCreation(new \DateTime());
            $facture->setTotalPaye(0);

            $facture->setResteAPaye($facture->getTotalTTC());



            $commmade->setEtat('facturer');


            $ef= $this->getDoctrine()->getManager();
            $ef->persist($facture);
            $ef->flush();
            $ef->persist($commmade);
            $ef->flush();




            return $this->redirectToRoute("tresorerie_listFacture");



        }
        return $this->render("@Tresorerie/Facture/ajouterFactureParCommande.html.twig",array("form"=> $form->createView()));


    }

    public function ajouterFactureAction(Request $request )
    {



        $facture= new FactureAchat();





        $form= $this->createForm(FactureAchatType::class,$facture);
        $form->add('commandeAp',EntityType::class,['class'=>CommandeDAprovisionnement::class,'choice_label'=>'numeroC','multiple'=>false]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){


            $facture->setEtat("non_paye");
            $facture->setDateCreation(new \DateTime());
            $facture->setTotalPaye(0);
            $facture->setResteAPaye($facture->getTotalTTC());





            $ef= $this->getDoctrine()->getManager();
            $ef->persist($facture);
            $ef->flush();
            return $this->redirectToRoute("tresorerie_listFacture");



        }
        return $this->render("@Tresorerie/Facture/ajouterFactureAchat.html.twig",array("form"=> $form->createView()));


    }
    public function afficherAction( )
    {
        $factures= $this->getDoctrine()-> getRepository(FactureAchat::class)-> findAll();

        $achat=$this->getDoctrine()->getRepository(FactureAchat::class)->calculerTotalAchat();

        $restt=$this->getDoctrine()->getRepository(FactureAchat::class)->calculerRestelPaye();

        $payert=$this->getDoctrine()->getRepository(FactureAchat::class)->calculerRestelPaye();


        return $this->render("@Tresorerie/Facture/listeFactureAchat.html.twig",array ('factures'=>$factures,'tachat'=>$achat,'trest'=>$restt,'tpayer'=>$payert));
    }

    public function afficherCommandeAction( )
    {
        $commandes= $this->getDoctrine()-> getRepository(CommandeDAprovisionnement::class)-> findAll();

        return $this->render("@Tresorerie/Facture/ListeCommande.html.twig",array ('commandes'=>$commandes));
    }

    public function consulterAction( )
    {
        $factures= $this->getDoctrine()-> getRepository(FactureAchat::class)-> findAll();

        return $this->render("@Tresorerie/Facture/consulterListeFactureAchat.html.twig",array ('factures'=>$factures));
    }

}
