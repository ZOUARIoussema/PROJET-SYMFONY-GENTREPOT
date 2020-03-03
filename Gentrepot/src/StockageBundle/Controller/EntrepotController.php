<?php

namespace StockageBundle\Controller;

use StockageBundle\Entity\Entrepot;
use StockageBundle\Form\EntrepotType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class EntrepotController extends Controller
{


    public function ajouterEntrepotAction(Request $request )
    {
        $entrepot= new Entrepot();

        $form= $this->createForm(EntrepotType::class,$entrepot);
        $form->handleRequest($request);
        if ($form->isSubmitted()){

            $ef= $this->getDoctrine()->getManager();
            $ef->persist($entrepot);
            $ef->flush();
            return $this->redirectToRoute("stockage_listEntrepot");

        }
        return $this->render("@Stockage/Entrepot/ajouterEntrepot.html.twig",array("form"=> $form->createView()));


    }
    public function afficherEntrepotAction()
    {
        $entrepots= $this->getDoctrine()-> getRepository(Entrepot::class)-> findAll();

        return $this->render("@Stockage/Entrepot/listeEntrepot.html.twig",array ('entrepots'=>$entrepots));
    }
    public function supprimerEntrepotAction($matriculeFiscal)
    {
        $em=$this->getDoctrine()->getManager();
        $entrepot= $em->getRepository(Entrepot::class)->find($matriculeFiscal);
        //var_dump($entrepot);
        $em->remove($entrepot);
        $em->flush();
        return $this->redirectToRoute('stockage_listEntrepot');
    }
    public function modifierEntrepotAction(Request $request, $matriculeFiscal)
    {
        $em=$this->getDoctrine()->getManager();
        $entrepot = $em->getRepository(Entrepot::class)->find($matriculeFiscal);


        //third step:
        // check is the from is sent
        if ($request->isMethod('POST')) {
            //update our object given the sent data in the request
            $entrepot ->setMatriculeFiscal($request->get('matriculeFiscal'));
            $entrepot ->setAdresse($request->get('adresse'));
            $entrepot ->setRaisonSocial($request->get('raisonSocial'));
            $entrepot ->setAdresseMail($request->get('adresseMail'));
            $entrepot ->setNumeroTel($request->get('numeroTel'));
            //fresh the data base
            $em->flush();
            //Redirect to the read
            return $this->redirectToRoute('stockage_afficherEntrepot');
        }
        //second step:
        // send the view to the user
        return $this->render('@Stockage/Entrepot/modifierEntrepot.html.twig', array('entrepot' => $entrepot));
    }
}
