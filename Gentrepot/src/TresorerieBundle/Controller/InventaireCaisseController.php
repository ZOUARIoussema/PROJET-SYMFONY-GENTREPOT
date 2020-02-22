<?php

namespace TresorerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use TresorerieBundle\Entity\InventaireCaisse;
use TresorerieBundle\Entity\RecouvrementClientCheque;
use TresorerieBundle\Entity\RecouvrementClientEspece;
use TresorerieBundle\Form\InventaireCaisseType;

class InventaireCaisseController extends Controller
{


    public function afficherAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inventaireCaisses = $em->getRepository('TresorerieBundle:InventaireCaisse')->findAll();


        $totalT=$this->getDoctrine()->getRepository(InventaireCaisse::class)->calculerTotalSoldeT();

        $totalC=$this->getDoctrine()->getRepository(InventaireCaisse::class)->calculerTotalSoldeCheque();


        $totalEspece=$this->getDoctrine()->getRepository(InventaireCaisse::class)->calculerTotalSoldesoldeEspece();


        $totalE=$this->getDoctrine()->getRepository(InventaireCaisse::class)->calculerTotalecart();

        $totalcalculer=$this->getDoctrine()->getRepository(InventaireCaisse::class)->calculerTotalcalculer();





        return $this->render("@Tresorerie/Inventaire/listeInventaire.html.twig", array(
            'inventaireCaisses' => $inventaireCaisses,'tt'=>$totalT,'tc'=>$totalC,'tespece'=>$totalEspece,'tecart'=>$totalE,
            "tcalculer"=>$totalcalculer
        ));
    }






    public function ajouterInventaireAction(Request $request)
    {


        $cheque=$this->getDoctrine()->getRepository(RecouvrementClientCheque::class)->calculerTotalRecouvrementCheque();

        $espece=$this->getDoctrine()->getRepository(RecouvrementClientEspece::class)->calculerTotalRecouvrementEspece();






        $inventaireCaisse = new InventaireCaisse();



        $inventaireCaisse->setSoldeTheorique($espece+$cheque);

        $inventaireCaisse->setSoldeCheque($cheque);
        $inventaireCaisse->setSoldeEspece($espece);

        $inventaireCaisse->setDateCreation(new \DateTime());

        $form = $this->createForm(InventaireCaisseType::class, $inventaireCaisse);

        $form->add('Ajout',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inventaireCaisse);
            $em->flush();

            return $this->redirectToRoute("inventairecaisse_afficher");
        }

        return $this->render("@Tresorerie/Inventaire/ajouterInventaire.html.twig",array("form"=> $form->createView(),
            "inv"=> $inventaireCaisse));

    }


    public function updateInventaireAction(Request $request, $id)
    {

        $em=$this->getDoctrine()->getManager();
        $i= $em->getRepository(InventaireCaisse::class)->find($id);




        $form= $this->createForm(InventaireCaisseType::class,$i);




        $form->add('Modifier',SubmitType::class);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($i);
            $ef->flush();

            return $this->redirectToRoute("inventairecaisse_afficher");



        }


        return $this->render("@Tresorerie/Inventaire/modifierInventaire.html.twig", array(
            'form'=>$form->createView(),"inv"=> $i));
    }



    public function deleteInventaireAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $i= $em->getRepository(InventaireCaisse::class)->find($id);

        $em->remove($i);
        $em->flush();
        return $this->redirectToRoute("inventairecaisse_afficher");




    }
}
