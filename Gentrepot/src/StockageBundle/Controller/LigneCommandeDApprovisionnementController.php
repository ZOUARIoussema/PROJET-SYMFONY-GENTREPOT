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
        $lcommande = $em->getRepository(LigneCommandeDApprovisionnement::class)->find($id);


        if ($request->isMethod('POST')) {

            $lcommande->setProduit($request->get('getId()'));
            $lcommande->setProduit($request->get('getPrix()'));
            $lcommande->setProduit($request->get('getQuantite()'));
            $lcommande->setProduit($request->get('getProduit().getLibelle()'));
            $lcommande->setProduit($request->get('getTotal()'));
            $lcommande->setProduit($request->get('getTva()'));
            //fresh the data base
            $em->flush();

            return $this->redirectToRoute('stockage_listeCommandeDAprovisionnement');

        }
        return $this->render('@Stockage/LigneCommandeDApprovisionnement/modifierLigneCommandeDApprovisionnement.html.twig', array('lcommande' => $lcommande));
    }
    public function supprimerLigneCommandeDApprovisionnementAction($id){

        $ef= $this->getDoctrine()->getManager();
        $lcom = $this->getDoctrine()->getRepository(LigneCommandeDApprovisionnement::class)->find($id);
        $ef->remove($lcom);
        $ef->flush();
        return $this->redirectToRoute("stockage_listeCommandeDAprovisionnement");
    }
}
