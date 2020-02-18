<?php

namespace TresorerieBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use TresorerieBundle\Entity\LettreDeRelance;
use TresorerieBundle\Form\LettreDeRelanceType;
use VenteBundle\Entity\FactureVente;

class LettreDeRelanceController extends Controller
{


    public function afficherFactureVenteAction( )
    {
        $f= $this->getDoctrine()-> getRepository(FactureVente::class)-> findAll();


        return $this->render("@Tresorerie/LettreDeRelance/listeFactureVente.html.twig",array ('factures'=>$f));
    }



    public function ajouterLettreAction(Request $request )
    {


        $lettre= new LettreDeRelance();

        $lettre->setDateCreation(new \DateTime());

        $form= $this->createForm(LettreDeRelanceType::class,$lettre);


        $form->add('factureVente',EntityType::class,['class'=>FactureVente::class,'choice_label'=>'id','multiple'=>false]);



        $form->add('Ajout',SubmitType::class);






        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($lettre);
            $ef->flush();

            return $this->redirectToRoute("lettreDerelance_afficherLettreDeRelance");



        }
        return $this->render("@Tresorerie/LettreDeRelance/ajouterLettreDeRelance.html.twig",array("form"=> $form->createView()));


    }






    //par facture

    public function ajouterLettreParFactureAction(Request $request,$id )
    {


        $lettre= new LettreDeRelance();


        $lettre->setFactureVente($this->getDoctrine()->getRepository(FactureVente::class)->find($id));

        $lettre->setDateCreation(new \DateTime());



        $em = $this->getDoctrine()->getManager();
        $em->persist($lettre);
        $em->flush();



        return $this->redirectToRoute("lettreDerelance_afficherLettreDeRelance");



    }


    public function afficherLettreDeRelanceAction( )
    {
        $l= $this->getDoctrine()-> getRepository(LettreDeRelance::class)-> findAll();


        return $this->render("@Tresorerie/LettreDeRelance/listeLettreDeRelance.html.twig",array ('lettres'=>$l));
    }



}
