<?php

namespace VenteBundle\Controller;
use VenteBundle\Entity\CommandeVente;
use VenteBundle\Entity\LigneCommande;
use VenteBundle\Entity\Produit;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use VenteBundle\Form\CommandeVenteType;
use VenteBundle\Repository\ProduitRepository;

class CartController extends Controller
{




public function indexAction(SessionInterface $session )
{
    $panier = $session->get('panier', []);

    $panierWithData = [];


     foreach ($panier as $reference => $quantiteEnStock ){


         $panierWithData[]=[


             'produit' => $this->getDoctrine() ->getRepository(Produit::class)->find($reference),

             'quantiteEnStock'=>$quantiteEnStock
         ];
     }

  $total = 0;
     foreach ($panierWithData as $item){

         $totalItem= $item['produit']->getPrixVente() * $item['quantiteEnStock'];
         $total += $totalItem;
     }


     return $this->render('@Vente/Produit/index.html.twig',array("items" =>$panierWithData,

        'total' => $total
     ));

}



    public function addAction($reference ,SessionInterface  $session)
    {

        $panier = $session->get('panier', []);

        if(!empty($panier[$reference])){
            $panier[$reference]++;
        }else{
            $panier[$reference]=1;
        }
        $panier[$reference] = 1;
        $session->set('panier', $panier);

        return $this->redirectToRoute("index");
    }


    public function removeAction($reference ,SessionInterface $session){

$panier = $session->get ('panier', []);

if (!empty($panier[$reference])){
    unset($panier[$reference]);
}

$session->set('panier',$panier);

return $this->redirectToRoute("index");
    }


    public function createAction(SessionInterface $session){





        $commande=new CommandeVente();

        $commande->setDateC(new \DateTime());
        $commande->setEtat("en cour");


        $lignecommande= new LigneCommande();

        $lignecommande->setCommande($commande);



        $panier = $session->get('panier', []);

        $panierWithData = [];


        foreach ($panier as $reference => $quantiteEnStock ){


            $panierWithData[]=[


                'produit' => $this->getDoctrine() ->getRepository(Produit::class)->find($reference),

                'quantiteEnStock'=>$quantiteEnStock
            ];
        }

        $total = 0;
        foreach ($panierWithData as $item){

            $totalItem= $item['produit']->getPrixVente() * $item['quantiteEnStock'];
            $total += $totalItem;
        }




foreach ($panierWithData as $p){

    $lignecommande= new LigneCommande();
    $lignecommande->setQuantite($p);


}











        $form = $this->createForm(CommandeVenteType::class,$commande);


        return $this->render('@Vente/Produit/commande.html.twig',array("form" =>$form ->createView(), "tab"=>$panierWithData ,  'total' => $total));

    }
}
