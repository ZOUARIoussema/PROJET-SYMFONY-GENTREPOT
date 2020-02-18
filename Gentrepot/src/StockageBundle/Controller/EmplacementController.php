<?php

namespace StockageBundle\Controller;

use StockageBundle\Entity\Emplacement;
use StockageBundle\Form\EmplacementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class EmplacementController extends Controller
{

    public function ajouterEmplacementAction(Request $request )
    {

        $emplacement= new Emplacement();

        $form= $this->createForm(EmplacementType::class,$emplacement);
        $form->handleRequest($request);
        if ($form->isSubmitted()){





            $ef= $this->getDoctrine()->getManager();
            $ef->persist($emplacement);
            $ef->flush();
            // return $this->redirectToRoute("stockage_listEmplacement");

        }
        return $this->render("@Stockage/Emplacement/ajouterEmplacement.html.twig",array("form"=> $form->createView()));

    }
}
