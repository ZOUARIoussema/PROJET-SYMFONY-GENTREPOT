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

        $ptotal=0;
        $p=0;
        $pttc=0;
        if($f->isSubmitted()||$form->isSubmitted()) {
            $choix = $request->get('bt');
            if($choix == "Valider") {
                $em = $this->getDoctrine()->getManager();
                $lcoms = $this->getDoctrine()->getRepository(LigneCommandeDApprovisionnement::class)->findByCommande(NULL);

                foreach ($lcoms as $l) {
                    $ptotal = $ptotal + $l->getTotal();
                    $p = ($l->getTotal()*$l->getTva()) + $l->getTotal();
                    $pttc = $pttc + $p;
                }
                $ptotal = $ptotal + ($ptotal * $commande->getTauxRemise());
                $commande->setTotalC($ptotal);
                $commande->setTotalTVA($pttc);
                $commande->setEtat('non_facturé');
                $em->persist($commande);
                $em->flush();
                foreach ($lcoms as $l){
                    $entityManager = $this->getDoctrine()->getManager();
                    $l->setCommande($commande);
                    $entityManager->flush();
                }
                $entityManager = $this->getDoctrine()->getManager();
                return $this->redirectToRoute("stockage_listeCommandeDAprovisionnement");
            }
            elseif ($choix == "Add"){
                $lcommande->setTotal($lcommande->getPrix() * $lcommande->getQuantite());
                $em = $this->getDoctrine()->getManager();
                $em->persist($lcommande);
                $em->flush();

            }

        }

        return $this->render("@Stockage/CommandeDAprovisionnement/passerCommandeDApprovisionnement.html.twig", array('commande'=>$commande,'lcommande'=>$lcommande,'p'=>$p,'pttc'=>$pttc,'ptotal'=>$ptotal,"form" => $form->createView(), "f" => $f->createView()));

    }
    public function supprimerLigneCommandeDApprovisionnementTempAction(Request $request,$id){
        $session = $request->getSession();
        if(!$session->has('commande'))
        {
            $session->set('commande',array());
        }
        $Tabcom = $session->get('commande',[]);
        if(!empty($Tabcom[$id])){
            unset($Tabcom[$id]);
        }
        $session->set('commande',$Tabcom);
        return $this->redirectToRoute("stockage_passerCommandeDAprovisionnement");
    }

    public function listeCommandeDAprovisionnementAction(){
        $commandes = $this->getDoctrine()->getRepository(CommandeDAprovisionnement::class)->findAll();
        $lcommandes = $this->getDoctrine()->getRepository(LigneCommandeDApprovisionnement::class)->findAll();
        return $this->render('@Stockage/CommandeDAprovisionnement/listeCommandeDAprovisionnement.html.twig', array('Tabcoms' => $commandes,'Tablcoms' => $lcommandes));

    }
}
