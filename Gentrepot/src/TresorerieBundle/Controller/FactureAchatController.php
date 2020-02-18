<?php

namespace TresorerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use TresorerieBundle\Entity\FactureAchat;
use TresorerieBundle\Form\FactureAchatType;

class FactureAchatController extends Controller
{


    public function ajouterFactureAction(Request $request )
    {



        $facture= new FactureAchat();





        $form= $this->createForm(FactureAchatType::class,$facture);
        $form->handleRequest($request);
        if ($form->isSubmitted()){


            $facture->setEtat("non_paye");
            $facture->setDateCreation(new \DateTime());
            $facture->setTotalPaye(0);
            $facture->setResteAPaye($facture->getTotalPaye());





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

        return $this->render("@Tresorerie/Facture/listeFactureAchat.html.twig",array ('factures'=>$factures));
    }
    public function consulterAction( )
    {
        $factures= $this->getDoctrine()-> getRepository(FactureAchat::class)-> findAll();

        return $this->render("@Tresorerie/Facture/consulterListeFactureAchat.html.twig",array ('factures'=>$factures));
    }

}
