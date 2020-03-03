<?php

namespace StockageBundle\Controller;

use StockageBundle\Entity\LignePerte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LignePerteController extends Controller
{
    public function modifierLignePerteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $lperte = $em->getRepository(LignePerte::class)->find($id);


        if ($request->isMethod('POST')) {

            $lperte->setProduit($request->get('getRaisonPerte'));
            $lperte->setProduit($request->get('getQuantite()'));
            $lperte->setProduit($request->get('getProduit().getLibelle()'));
            $lperte->setProduit($request->get('getPerte().getId()'));
            //fresh the data base
            $em->flush();

            return $this->redirectToRoute('stockage_listePerte');

        }
        return $this->render('@Stockage/LignePerte/modifierLignePerte.html.twig', array('lperte' => $lperte));
    }
    public function supprimerLignePerteAction($id){

        $ef= $this->getDoctrine()->getManager();
        $lperte = $this->getDoctrine()->getRepository(LignePerte::class)->find($id);
        $ef->remove($lperte);
        $ef->flush();
        return $this->redirectToRoute("stockage_listePerte");
    }
}
