<?php

namespace StockageBundle\Controller;


use StockageBundle\Entity\InventaireStock;

use StockageBundle\Form\InventaireStockType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InventaireStockController extends Controller
{
    public function faireInventaireStockAction(Request $request){
        $inv = new InventaireStock();
        $form = $this->createForm(InventaireStockType::class, $inv);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $inv->setQuantiteTheorique($inv->getEmplacement()->getQuantiteStocker());
            $inv->setEcart($inv->getQuantiteTheorique() - $inv->getQuantiteInventaire());
            $em->persist($inv);
            $em->flush();
            return $this->redirectToRoute("stockage_listeInventaireStock");
        }

        return $this->render("@Stockage/InventaireStock/faireInventaireStock.html.twig", array("form" => $form->createView()));

    }
    public function listeInventaireStockAction(){
        $invs = $this->getDoctrine()->getRepository(InventaireStock::class)->findAll();
        return $this->render('@Stockage/InventaireStock/listeInventaireStock.html.twig', array('Tabinvs' => $invs));

    }
}
