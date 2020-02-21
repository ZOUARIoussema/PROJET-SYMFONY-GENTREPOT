<?php

namespace StockageBundle\Controller;

use StockageBundle\Entity\CommandeDAprovisionnement;
use StockageBundle\Entity\LigneCommandeDApprovisionnement;
use StockageBundle\Form\CommandeDAprovisionnementType;
use StockageBundle\Form\LigneCommandeDApprovisionnementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;




class CommandeDAprovisionnementController extends Controller
{
    public function passerCommandeDAprovisionnementAction(Request $request){
        $commande = new CommandeDAprovisionnement();
        $form = $this->createForm(CommandeDAprovisionnementType::class, $commande);
        $form->handleRequest($request);
        $lcommande = new LigneCommandeDApprovisionnement();
        $f = $this->createForm(LigneCommandeDApprovisionnementType::class, $lcommande);
        $f->handleRequest($request);

        /*if($form->isSubmitted()||$f->isSubmitted()){
            $choix = $request->get('bt');*/
            if($f->isSubmitted()) {
                    $em = $this->getDoctrine()->getManager();
                    $lcommande->setTotal($lcommande->getPrix() * $lcommande->getQuantite());
                    $em->persist($lcommande);
                    $em->flush();
               /* return $this->render("@Stockage/CommandeDAprovisionnement/passerCommandeDApprovisionnement.html.twig", array("form" => $form->createView(), "f" => $f->createView()));*/
                return $this->redirectToRoute("stockage_listeCommandeDAprovisionnement");
            }
            if($form->isSubmitted()) {
                  $em = $this->getDoctrine()->getManager();
                  $em->persist($commande);
                  $em->flush();
                return $this->redirectToRoute("stockage_listeCommandeDAprovisionnement");
              }

        return $this->render("@Stockage/CommandeDAprovisionnement/passerCommandeDApprovisionnement.html.twig", array("form" => $form->createView(), "f" => $f->createView()));

    }
}
