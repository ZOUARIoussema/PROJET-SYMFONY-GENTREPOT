<?php

namespace TresorerieBundle\Controller;

use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use TresorerieBundle\Entity\RecouvrementClientCheque;
use TresorerieBundle\Entity\RecouvrementClientEspece;
use TresorerieBundle\Form\RecouvrementClientChequeType;
use TresorerieBundle\Form\RecouvrementClientEspeceType;
use VenteBundle\Entity\FactureVente;

class RecouvrementClientController extends Controller
{




    //par facture

    public function ajouterRcouvrementChequeFAction(Request $request,$id )
    {


        $reglement= new RecouvrementClientCheque();


        $reglement->setFacture($this->getDoctrine()->getRepository(FactureVente::class)->find($id));

        $reglement->setDateCreation(new \DateTime());

        $form= $this->createForm(RecouvrementClientChequeType::class,$reglement);




        $form->add('montant');
        $form->add('dateCheque');
        $form->add('numeroCheque');


        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);
            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherRecouvrement");






        }
        return $this->render("@Tresorerie/RecouvrementClient/ajouterRecouvrementParFactureCheque.html.twig",array("form"=> $form->createView()));


    }





    public function ajouterRcouvrementChequeAction(Request $request )
    {


        $reglement= new RecouvrementClientCheque();

        $reglement->setDateCreation(new \DateTime());

        $form= $this->createForm(RecouvrementClientChequeType::class,$reglement);


        $form->add('facture',EntityType::class,['class'=>FactureVente::class,'choice_label'=>'id','multiple'=>false]);


        $form->add('montant');
        $form->add('dateCheque');
        $form->add('numeroCheque');
        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);
            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherRecouvrement");



        }
        return $this->render("@Tresorerie/RecouvrementClient/ajouterRecouvrementCheque.html.twig",array("form"=> $form->createView()));


    }



    //par facture
    public function ajouterRecouvrementEspeceFAction(Request $request,$id )
    {


        $reglement= new RecouvrementClientEspece();

        $reglement->setDateCreation(new \DateTime());

        $reglement->setFacture($this->getDoctrine()->getRepository(FactureVente::class)->find($id));


        $form= $this->createForm(RecouvrementClientEspeceType::class,$reglement);




        $form->add('montant');



        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);
            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherRecouvrement");

        }
        return $this->render("@Tresorerie/RecouvrementClient/ajouterRecouvrementParFactureEspece.html.twig",array("form"=> $form->createView()));


    }


    public function ajouterRecouvrementEspeceAction(Request $request )
    {


        $reglement= new RecouvrementClientEspece();

        $reglement->setDateCreation(new \DateTime());

        $form= $this->createForm(RecouvrementClientEspeceType::class,$reglement);


        $form->add('facture',EntityType::class,['class'=>FactureVente::class,'choice_label'=>'id','multiple'=>false]);


        $form->add('montant');



        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($reglement);
            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherRecouvrement");

        }
        return $this->render("@Tresorerie/RecouvrementClient/ajouterRecouvrementEspece.html.twig",array("form"=> $form->createView()));


    }






    public function afficherFactureVenteAction( )
    {
        $f= $this->getDoctrine()-> getRepository(FactureVente::class)-> findAll();


        return $this->render("@Tresorerie/RecouvrementClient/listeFactureVente.html.twig",array ('factures'=>$f));
    }


    public function afficherAction( )
    {
        $recouvrementE= $this->getDoctrine()-> getRepository(RecouvrementClientEspece::class)-> findAll();

        $recouvrementC= $this->getDoctrine()-> getRepository(RecouvrementClientCheque::class)-> findAll();

        return $this->render("@Tresorerie/RecouvrementClient/listeRecouvrementClient.html.twig",array ('roucouvrementE'=>$recouvrementE,'recouvrementC'=>$recouvrementC));
    }

    public function deleteRecouvrementEspeceAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $r= $em->getRepository(RecouvrementClientEspece::class)->find($id);

        $em->remove($r);
        $em->flush();
        return $this->redirectToRoute("tresorerie_afficherRecouvrement");
    }
    public function deleteRecouvrementChequeAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $r= $em->getRepository(RecouvrementClientCheque::class)->find($id);

        $em->remove($r);
        $em->flush();
        return $this->redirectToRoute("tresorerie_afficherRecouvrement");
    }




    public function updateRCAction(Request $request, $id)
    {

        $em=$this->getDoctrine()->getManager();
        $r= $em->getRepository(RecouvrementClientCheque::class)->find($id);




        $form= $this->createForm(RecouvrementClientChequeType::class,$r);


        $form->add('facture',EntityType::class,['class'=>FactureVente::class,'choice_label'=>'id','multiple'=>false]);


        $form->add('montant');
        $form->add('dateCheque');
        $form->add('numeroCheque');
        $form->add('modifier',SubmitType::class);


        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($r);
            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherRecouvrement");



        }


        return $this->render("@Tresorerie/RecouvrementClient/modifierRecouvrementCheque.html.twig", array(
            'form'=>$form->createView()));
    }



    public function updateRecouvrementEAction(Request $request, $id)
    {

        $em=$this->getDoctrine()->getManager();
        $r= $em->getRepository(RecouvrementClientEspece::class)->find($id);




        $form= $this->createForm(RecouvrementClientEspeceType::class,$r);


        $form->add('facture',EntityType::class,['class'=>FactureVente::class,'choice_label'=>'id','multiple'=>false]);


        $form->add('montant');

        $form->add('modifier',SubmitType::class);


        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($r);
            $ef->flush();

            return $this->redirectToRoute("tresorerie_afficherRecouvrement");



        }


        return $this->render("@Tresorerie/RecouvrementClient/modifierRecouvrementEspece.html.twig", array(
            'form'=>$form->createView()));
    }


}
