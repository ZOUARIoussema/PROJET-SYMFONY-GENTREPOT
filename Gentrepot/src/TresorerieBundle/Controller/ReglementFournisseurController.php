<?php

namespace TresorerieBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use TresorerieBundle\Entity\FactureAchat;
use TresorerieBundle\Entity\ReglementFournisseur;
use TresorerieBundle\Entity\ReglementFournisseurCheque;
use TresorerieBundle\Entity\ReglementFournisseurEspece;
use TresorerieBundle\Form\ReglementFournisseurChequeType;
use TresorerieBundle\Form\ReglementFournisseurEspeceType;

class ReglementFournisseurController extends Controller
{





    public function ajouterReglementAction(Request $request )
    {


        $reglement= new ReglementFournisseur();

        $form= $this->createForm(ReglementFournisseurChequeType::class,$reglement);

        $form->add('factureAchat',EntityType::class,['class'=>FactureAchat::class,'choice_label'=>'numeroF','multiple'=>false]);




        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);
            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherR");



        }
        return $this->render("@Tresorerie/ReglementF/ajouterReglement.html.twig",array("form"=> $form->createView()));


    }





    //par facture

    public function ajouterReglementChequeFAction(Request $request,$numeroF )
    {


        $reglement= new ReglementFournisseurCheque();



        $facture=$this->getDoctrine()->getRepository(FactureAchat::class)->find($numeroF);





        $reglement->setFacture($facture);

        $reglement->setDateCreation(new \DateTime());

        $form= $this->createForm(ReglementFournisseurChequeType::class,$reglement);




        $form->add('montant');
        $form->add('dateCheque');
        $form->add('numeroCheque');
        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);


            //modifier facture

            $facture->setTotalPaye($facture->getTotalPaye()+$reglement->getMontant());
            $facture->setResteAPaye($facture->getTotalTTC()-$facture->getTotalPaye());


            if($facture->getResteAPaye()==0){

                $facture->setEtat("payer");
            }else
            {
                $facture->setEtat("non_paye");
            }

            $ef->persist($facture);

            //



            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherR");
















        }
        return $this->render("@Tresorerie/ReglementF/ajouterReglementParFactureCheque.html.twig",array("form"=> $form->createView()));


    }





    public function ajouterReglementChequeAction(Request $request )
    {


        $reglement= new ReglementFournisseurCheque();

        $reglement->setDateCreation(new \DateTime());

        $form= $this->createForm(ReglementFournisseurChequeType::class,$reglement);


        $form->add('facture',EntityType::class,['class'=>FactureAchat::class,'choice_label'=>'numeroF','multiple'=>false]);


        $form->add('montant');
        $form->add('dateCheque');
        $form->add('numeroCheque');
        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);

            //modifier facture

            $facture=$this->getDoctrine()->getRepository(FactureAchat::class)->find($reglement->getFacture()->getNumeroF());


            $facture->setTotalPaye($facture->getTotalPaye()+$reglement->getMontant());
            $facture->setResteAPaye($facture->getTotalTTC()-$facture->getTotalPaye());


            if($facture->getResteAPaye()==0){

                $facture->setEtat("payer");
            }else
            {
                $facture->setEtat("non_paye");
            }


            $ef->persist($facture);

            //



            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherR");



        }
        return $this->render("@Tresorerie/ReglementF/ajouterReglementFCheque.html.twig",array("form"=> $form->createView()));


    }


    //par facture


    public function ajouterReglementEspeceFAction(Request $request,$numeroF )
    {


        $reglement= new ReglementFournisseurEspece();

        $reglement->setFacture($this->getDoctrine()->getRepository(FactureAchat::class)->find($numeroF));


        $reglement->setDateCreation(new \DateTime());

        $form= $this->createForm(ReglementFournisseurEspeceType::class,$reglement);





        $form->add('montant');



        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);


            //modifier facture

            $facture=$this->getDoctrine()->getRepository(FactureAchat::class)->find($reglement->getFacture()->getNumeroF());


            $facture->setTotalPaye($facture->getTotalPaye()+$reglement->getMontant());
            $facture->setResteAPaye($facture->getTotalTTC()-$facture->getTotalPaye());

            if($facture->getResteAPaye()==0){

                $facture->setEtat("payer");
            }else
            {
                $facture->setEtat("non_paye");
            }

            $ef->persist($facture);

            //


            $ef->flush();
            return $this->redirectToRoute("tresorerie_afficherR");



        }
        return $this->render("@Tresorerie/ReglementF/ajouterReglementParFactureE.html.twig",array("form"=> $form->createView()));


    }

    //


    public function ajouterReglementEspeceAction(Request $request )
    {


        $reglement= new ReglementFournisseurEspece();

        $reglement->setDateCreation(new \DateTime());

        $form= $this->createForm(ReglementFournisseurEspeceType::class,$reglement);


        $form->add('facture',EntityType::class,['class'=>FactureAchat::class,'choice_label'=>'numeroF','multiple'=>false]);


        $form->add('montant');



        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);



            //modifier facture

            $facture=$this->getDoctrine()->getRepository(FactureAchat::class)->find($reglement->getFacture()->getNumeroF());


            $facture->setTotalPaye($facture->getTotalPaye()+$reglement->getMontant());
            $facture->setResteAPaye($facture->getTotalTTC()-$facture->getTotalPaye());

            if($facture->getResteAPaye()==0){

                $facture->setEtat("payer");
            }else
            {
                $facture->setEtat("non_paye");
            }


            $ef->persist($facture);

            //

            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherR");

        }
        return $this->render("@Tresorerie/ReglementF/ajouterREspece.html.twig",array("form"=> $form->createView()));


    }





    public function afficherFactureAchatAction( )
    {
        $f= $this->getDoctrine()-> getRepository(FactureAchat::class)-> findAll();


        return $this->render("@Tresorerie/ReglementF/listeReglement.html.twig",array ('factures'=>$f));
    }



    public function afficherAction( )
    {
        $reglementE= $this->getDoctrine()-> getRepository(ReglementFournisseurEspece::class)-> findAll();

        $reglementC= $this->getDoctrine()-> getRepository(ReglementFournisseurCheque::class)-> findAll();

        return $this->render("@Tresorerie/ReglementF/listeReglement.html.twig",array ('reglemente'=>$reglementE,'reglementc'=>$reglementC));
    }





    public function deleteREAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $r= $em->getRepository(ReglementFournisseurEspece::class)->find($id);



        $em->remove($r);
        $em->flush();



        //modifier facture



        $facture=$r->getFacture();

        $facture->setTotalPaye($facture->getTotalPaye()-$r->getMontant());
        $facture->setResteAPaye($facture->getTotalTTC()-$facture->getTotalPaye());

        if($facture->getResteAPaye()==0){

            $facture->setEtat("payer");
        }else
        {
            $facture->setEtat("non_paye");
        }


        $em->persist($facture);

        //

        $em->flush();

        return $this->redirectToRoute("tresorerie_afficherR");
    }

    public function deleteRCAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $r= $em->getRepository(ReglementFournisseurCheque::class)->find($id);




        $em->remove($r);
        $em->flush();

        //modifier facture



        $facture=$r->getFacture();

        $facture->setTotalPaye($facture->getTotalPaye()-$r->getMontant());
        $facture->setResteAPaye($facture->getTotalTTC()-$facture->getTotalPaye());

        if($facture->getResteAPaye()==0){

            $facture->setEtat("payer");
        }else
        {
            $facture->setEtat("non_paye");
        }


        $em->persist($facture);

        //

        $em->flush();



        return $this->redirectToRoute("tresorerie_afficherR");
    }



    public function updateRCAction(Request $request, $id)
    {

        $em=$this->getDoctrine()->getManager();
        $r= $em->getRepository(ReglementFournisseurCheque::class)->find($id);




        $ancientMontant=$r->getMontant();


        $form= $this->createForm(ReglementFournisseurChequeType::class,$r);


        $form->add('facture',EntityType::class,['class'=>FactureAchat::class,'choice_label'=>'numeroF','multiple'=>false]);


        $form->add('montant');
        $form->add('dateCheque');
        $form->add('numeroCheque');
        $form->add('modifier',SubmitType::class);


        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){

            $ef= $this->getDoctrine()->getManager();

            $eF= $this->getDoctrine()->getManager();

            $ef->persist($r);


            //modifier facture



            $facture=$r->getFacture();


            $facture->setTotalPaye($facture->getTotalPaye()-$ancientMontant);



            $facture->setTotalPaye($facture->getTotalPaye()+$r->getMontant());
            $facture->setResteAPaye($facture->getTotalTTC()-$facture->getTotalPaye());

            if($facture->getResteAPaye()==0){

                $facture->setEtat("payer");
            }else
            {
                $facture->setEtat("non_paye");
            }


            $em->persist($facture);

            //

            $em->flush();



            return $this->redirectToRoute("tresorerie_afficherR");



        }


        return $this->render("@Tresorerie/ReglementF/modifierReglementFCheque.html.twig", array(
            'form'=>$form->createView()));
    }



    public function updateREAction(Request $request, $id)
    {

        $em=$this->getDoctrine()->getManager();
        $r= $em->getRepository(ReglementFournisseurEspece::class)->find($id);


        $ancientMontant=$r->getMontant();


        $form= $this->createForm(ReglementFournisseurEspeceType::class,$r);


        $form->add('facture',EntityType::class,['class'=>FactureAchat::class,'choice_label'=>'numeroF','multiple'=>false]);



        $form->add('montant');

        $form->add('modifier',SubmitType::class);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($r);



            //modifier facture



            $facture=$r->getFacture();


            $facture->setTotalPaye($facture->getTotalPaye()-$ancientMontant);



            $facture->setTotalPaye($facture->getTotalPaye()+$r->getMontant());
            $facture->setResteAPaye($facture->getTotalTTC()-$facture->getTotalPaye());

            if($facture->getResteAPaye()==0){

                $facture->setEtat("payer");
            }else
            {
                $facture->setEtat("non_paye");
            }


            $em->persist($facture);

            //

            $em->flush();






            return $this->redirectToRoute("tresorerie_afficherR");



        }


        return $this->render("@Tresorerie/ReglementF/modifierReglementFEspece.html.twig", array(
            'form'=>$form->createView()));
    }




}
