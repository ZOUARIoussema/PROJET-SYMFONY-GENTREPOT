<?php

namespace StockageBundle\Controller;

use StockageBundle\Entity\LigneCommandeDApprovisionnement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LigneCommandeDApprovisionnementController extends Controller
{
    public function modifierLigneCommandeDApprovisionnementAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $lcom = $em->getRepository(LigneCommandeDApprovisionnement::class)->find($id);


        if ($request->isMethod('POST')) {

            $lcom->setProduit($request->get('getId()'));
            $lcom->setProduit($request->get('getPrix()'));
            $lcom->setProduit($request->get('getQuantite()'));
            $lcom->setProduit($request->get('getProduit().getLibelle()'));
            $lcom->setProduit($request->get('getTotal()'));
            $lcom->setProduit($request->get('getTva()'));
            //fresh the data base
            $em->flush();

            return $this->redirectToRoute('stockage_listeCommandeDAprovisionnement');

        }
        return $this->render('@Stockage/LigneCommandeDApprovisionnement/modifierLignePerte.html.twig', array('lcom' => $lcom));
    }
    public function supprimerLigneCommandeDApprovisionnementAction($id){

        $ef= $this->getDoctrine()->getManager();
        $lcom = $this->getDoctrine()->getRepository(LigneCommandeDApprovisionnement::class)->find($id);
        $ef->remove($lcom);
        $ef->flush();
        return $this->redirectToRoute("stockage_listeCommandeDAprovisionnement");
    }
}
