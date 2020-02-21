<?php

namespace VenteBundle\Controller;
use http\Client\Response;
use VenteBundle\Entity\BonLivraison;
use VenteBundle\Entity\CommandeVente;
use VenteBundle\Entity\LigneCommande;
use VenteBundle\Entity\Produit;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use VenteBundle\Form\BonLivraisonType;
use VenteBundle\Form\CommandeVenteType;
use VenteBundle\Form\LigneCommandeType;
use VenteBundle\Repository\ProduitRepository;

class CartController extends Controller
{




    public function indexAction(SessionInterface $session, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
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
        $user = $this->getUser();
        $username = $user->getUsername();

        foreach ($panierWithData as $key => $data){
            $command = new LigneCommande();
            $command->setProduit($data['produit']);
            $command->setQuantite($data['quantiteEnStock']);
            $command->setUser($username);
            $exist = $this->getDoctrine()->getRepository(LigneCommande::class)->findBy(array('produit' =>$data['produit'] ));
            if($exist==null){
                $em->persist($command);
                $em->flush();
            }


        }
        $repository = $this->getDoctrine()->getRepository(LigneCommande::class);
        $commande = $repository->find(3);



        //return $this->redirectToRoute("index");







        return $this->render('@Vente/Produit/index.html.twig',array("items" =>$panierWithData,

            'total' => $total,


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
        $em= $this->getDoctrine()->getManager();

        $panier = $session->get ('panier', []);

        if (!empty($panier[$reference])){
            unset($panier[$reference]);
        }

        $command = $em->getRepository(LigneCommande::class)->findOneBy(array('produit'=>$reference));
        if($command!=null) {
            $em->remove($command);
            $em->flush();
        }


        $session->set('panier',$panier);

        return $this->redirectToRoute("index");
    }


    public function createAction(SessionInterface $session,Request $request){

        $em = $this->getDoctrine()->getManager();

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
            $ligneCommande = $em->getRepository(LigneCommande::class)->findOneBy(array('produit'=>$reference));
            if($ligneCommande!=null){
                $em->remove($ligneCommande);
                $em->flush();

            }

        }






        $commande = new CommandeVente();

        $commande->setTotalC($total);
        $commande->setEtat("En cour");
        $commande->setDateC(new \DateTime());
        $commande->setLignecommandes($panierWithData);
        $commande->setUser($this->getUser()->getUsername());
        $em->persist($commande);
        $em->flush();


        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');

        $manager->addNotification(array($this->getUser()), $notif, true);



        $bon= new BonLivraison();
        $form = $this->createForm(BonLivraisonType::class,$bon);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($bon);
            $em->flush();
            $bon->setDateCreation(new \DateTime());
            $bon->getBonLivraison();
            return $this->redirectToRoute('commande');
        }
        // return new Response("ssddsf");
        return $this->render('@Vente/Produit/commande.html.twig',array("form" =>$form ->createView(), "tab"=>$panierWithData ,  'total' => $total));

    }









    public function updatAction(Request $request, $reference)
    {

        $em=$this->getDoctrine()->getManager();
        $commande= $this->getDoctrine()->getRepository(LigneCommande::class)->findOneBy(array('produit'=>$reference));

        $form= $this->createForm(LigneCommandeType::class,$commande);

        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            $data = $form->getData();
            $quantity = $request->request->get('_qunatity');

            $commande->setQuantite($quantity);

            $em->persist($commande);
            $em->flush();
            return new \Symfony\Component\HttpFoundation\Response("sqqsd");
            //return $this->redirectToRoute("index");



        }
        return new \Symfony\Component\HttpFoundation\Response("sdsdqqsd");

        //return $this->redirectToRoute("index");



    }

    public  function BonLivraisonAction(Request $request)
    {
        $bon= new BonLivraison();
        $form = $this->createForm(BonLivraisonType::class,$bon);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($bon);
            $em->flush();
            //  return $this->redirectToRoute('');
        }

        return ($this->render('@Vente/Default/ajoutC.html.twig',array("form"=> $form->createView())));
    }


}