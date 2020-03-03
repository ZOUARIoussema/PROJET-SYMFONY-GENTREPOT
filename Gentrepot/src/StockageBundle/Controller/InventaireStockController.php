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
    public function exportInventaireStockAction(){
        $em = $this->getDoctrine()->getManager();
        $inventaireStock = $em->getRepository(InventaireStock::class)->findAll();
        $writer = $this->container->get('egyg33k.csv.writer');
        $csv = $writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Numero', 'Produit', 'Emplacement', 'Date', 'Qte Inventaire', 'Ecart', 'Qte Theorique']);
        foreach ($inventaireStock as $inv){
            $csv->insertOne([$inv->getId(), $inv->getProduit()->getLibelle(), $inv->getEmplacement()->getAdresse(), $inv->getDateCreation()->format('d/m/Y'), $inv->getQuantiteInventaire(), $inv->getEcart(), $inv->getQuantiteTheorique()]);
        }
        $csv->output('inventaireStock.csv');
        exit;
    }
}
