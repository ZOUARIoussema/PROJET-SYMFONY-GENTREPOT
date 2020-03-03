<?php

namespace VenteBundle\Controller;

use Mgilet\NotificationBundle\Entity\Notification;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use VenteBundle\Entity\BonLivraison;
use VenteBundle\Entity\CommandeVente;
use VenteBundle\Entity\FactureVente;
use VenteBundle\Entity\LigneCommande;
use VenteBundle\Entity\Produit;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use VenteBundle\Form\BonLivraisonType;
use VenteBundle\Form\CommandeVenteType;
use VenteBundle\Form\FactureVenteType;
use VenteBundle\Form\LigneCommandeType;
use VenteBundle\Repository\ProduitRepository;

class CartController extends Controller
{


    public function indexAction(SessionInterface $session, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $panier = $session->get('panier', []);
        $user = $this->getUser();
        $username = $user->getUsername();


        $panierWithData = [];

        $items = $this->getDoctrine()->getRepository(LigneCommande::class)->findallCommandesByuSER($username);
        $i = 0;

        foreach ($panier as $reference => $quantiteEnStock) {


            $panierWithData[] = [


                'produit' => $this->getDoctrine()->getRepository(Produit::class)->find($reference),

                'quantiteEnStock' => $quantiteEnStock,
                'quantite' => isset($items[$i]['quantite']) ? $items[$i]['quantite'] : 0
            ];
            $i++;
        }


        foreach ($panierWithData as $key => $data) {
            $command = new LigneCommande();

            $command->setProduit($data['produit']);
            $command->setQuantite($data['quantiteEnStock']);
            $command->setUser($username);

            $exist = $this->getDoctrine()->getRepository(LigneCommande::class)->findBy(array('produit' => $data['produit']));
            if ($exist == null) {
                $em->persist($command);
                $em->flush();
            }


        }


        $total = 0;
        foreach ($panierWithData as $item) {

            $totalItem = $item['produit']->getPrixVente() * $item['quantite'];
            $total += $totalItem;
        }


        $repository = $this->getDoctrine()->getRepository(LigneCommande::class);


        $commande = new CommandeVente();
        //return $this->redirectToRoute("index");
        $form = $this->createForm(CommandeVenteType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $ligneCommande = $em->getRepository(LigneCommande::class)->findOneBy(array('produit' => $reference));
            if ($ligneCommande != null) {



                // $session->remove('panier');
                $em->remove($ligneCommande);
                $em->flush();
                $commande = new CommandeVente();

                $commande->setTotalC($total);
                $commande->setEtat("En attente");
                $commande->setDateC(new \DateTime());
                $commande->setLignecommandes($panierWithData);
                $commande->setUser($this->getUser()->getUsername());
                $em->persist($commande);
                $em->flush();
                $manager = $this->get('mgilet.notification');
                $notif = $manager->createNotification('Bienvenu');
                $notif->setMessage('Nouveau commande');

                $manager->addNotification(array($this->getUser()), $notif, true);

                // $session->remove('panier');
                $em->remove($ligneCommande);
                $em->flush();
                return $this->redirectToRoute('commandevalide');

            }


        }
        return $this->render('@Vente/Produit/index.html.twig', array("items" => $panierWithData,

            'total' => $total,
            "form" => $form->createView(),


        ));

    }
public  function commandeAction(){
    return ($this->render('@Vente/Produit/commandevalide.html.twig'));
}
    public function showAction(Request $request)
    {
        $user = $request->get('user',null);

        $list=$this->getDoctrine()->getManager()
            ->getRepository(CommandeVente::class)->findByUser($user);
        return ($this->render('@Vente/Produit/commandeClient.html.twig', array(
                "liste" => $list,
                "user" => $user
            )

        ));
    }
    public function valideAction(Request $request)
    {



        return ($this->render('@Vente/Produit/validation.html.twig'

        ));
    }

    public function ajouterBonlivraisonAction(Request $request,$id )
    {


        $bon = new BonLivraison();


        $commande = $this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->find($id);

        $bon->setBonLivraison($commande);


        $form = $this->createForm(BonLivraisonType::class, $bon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $bon->setDateCreation(new \DateTime());
            $bon->setEtat('en cours');
            $commande->setEtat('en cours');

            $em = $this->getDoctrine()->getManager();
            $em->persist($bon);
            $em->flush();

            return $this->redirectToRoute('valide');
        }

        return $this->render("@Vente/Produit/ajoutbon.html.twig", array("form" => $form->createView()));


    }
    public function ajoutfactureAction(Request $request,$id )
    {

        $facture = new FactureVente();


        $bon=$this->getDoctrine()->getManager()->getRepository(BonLivraison::class)->find($id);
        $commande=$this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->find($bon->getBonLivraison());
        $facture->setBonLivraison($bon);
        $form = $this->createForm(FactureVenteType::class, $facture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $facture->setEtat('non payé');
            $facture->setResteAPaye($facture->getTotalTTC());
            $facture->setDateCreation(new \DateTime());
            $facture->setTotalPaye(0);

            $bon->setEtat('valider');
            $commande->setEtat('valider');



            $em = $this->getDoctrine()->getManager();

            $em->persist($facture);
            $em->flush();
            return $this->redirectToRoute('factureaffiche');


        }
        return ($this->render('@Vente/Produit/facture.html.twig', array("produit" => $commande->getLignecommandes(),"form"=> $form->createView()
        ,'total'=>$commande->getTotalC())));
    }
    public function afficheFactureAction(Request $request)
    {

        $list=$this->getDoctrine()->getManager()
            ->getRepository(FactureVente::class)->findAll();
        return ($this->render('@Vente/Produit/factureaffiche.html.twig', array(
                "liste" => $list,

            )

        ));
    }
    public function PDFfactureAction($id,Request $request)
    {
        $snappy = $this->get('knp_snappy.pdf');
        $em=$this->getDoctrine()->getManager();
        $html = $em->getRepository("VenteBundle:FactureVente")->findBy(array('id'=>$id));


        $html = $this->renderView('@Vente/Default/pdf.html.twig', array(
            'liste' => $html

        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }


    public function affichebonAction( )
    {


        $list=$this->getDoctrine()->getManager()
            ->getRepository(BonLivraison::class)->findAll();
$facture=$this->getDoctrine()->getManager()
    ->getRepository(FactureVente::class)->findByNombre();

        $bon=$this->getDoctrine()->getManager()
            ->getRepository(BonLivraison::class)->findByNombre();
        return ($this->render('@Vente/Produit/bon.html.twig', array(
                "liste" => $list,
                "facture"=>$facture,
                "bon"=>$bon,

            )

        ));
    }

            public function addAction($reference, SessionInterface $session)
    {

        $panier = $session->get('panier', []);

        if (!empty($panier[$reference])) {
            $panier[$reference]++;
        } else {
            $panier[$reference] = 1;
        }
        $panier[$reference] = 1;
        $session->set('panier', $panier);

        return $this->redirectToRoute("index");
    }


    public function removeAction($reference, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();

        $panier = $session->get('panier', []);

        if (!empty($panier[$reference])) {
            unset($panier[$reference]);
        }

        $command = $em->getRepository(LigneCommande::class)->findOneBy(array('produit' => $reference));
        if ($command != null) {
            $em->remove($command);
            $em->flush();
        }


        $session->set('panier', $panier);

        return $this->redirectToRoute("index");
    }


    public function createAction(SessionInterface $session, Request $request)
    {
        $user = $this->getUser();
        $username = $user->getUsername();

        $em = $this->getDoctrine()->getManager();

        $panier = $session->get('panier', []);

        $panierWithData = [];


        foreach ($panier as $reference => $quantiteEnStock) {

            $items = $this->getDoctrine()->getRepository(LigneCommande::class)->findallCommandesByuSER($username);
            $i = 0;
            $panierWithData[] = [

                'produit' => $this->getDoctrine()->getRepository(Produit::class)->find($reference),

                'quantiteEnStock' => $quantiteEnStock,
                'quantite' => isset($items[$i]['quantite']) ? $items[$i]['quantite'] : 0

            ];
            $i++;
        }

        $total = 0;
        foreach ($panierWithData as $item) {

            $totalItem = $item['produit']->getPrixVente() * $item['quantiteEnStock'];
            $total += $totalItem;


        }


        $bon = new BonLivraison();
        $form = $this->createForm(BonLivraisonType::class, $bon);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted()) {
            $ligneCommande = $em->getRepository(LigneCommande::class)->findOneBy(array('produit' => $reference));
          /*  if ($ligneCommande != null) {

                $commande = new CommandeVente();

                $commande->setTotalC($total);
                $commande->setEtat("En cour");
                $commande->setDateC(new \DateTime());
                $commande->setLignecommandes($panierWithData);
                $commande->setUser($this->getUser()->getUsername());
                $em->persist($commande);
                $em->flush();
                $manager = $this->get('mgilet.notification');
                $notif = $manager->createNotification('Bienvenu');
                $notif->setMessage('Nouveau commande');

                $manager->addNotification(array($this->getUser()), $notif, true);

                // $session->remove('panier');
                $em->remove($ligneCommande);
                $em->flush();
            }*/

            $data = $form->getData();
            $em->persist($bon);
            $em->flush();
            $bon->setDateCreation(new \DateTime());
            $bon->setDatesortie(($data->getDateSortie()));
            $bon->getBonLivraison();


            // return new Response("ssddsf");


        }
        return $this->render('@Vente/Produit/commande.html.twig', array("form" => $form->createView(), "tab" => $panierWithData, 'total' => $total));
    }

    public function updatAction(Request $request, $reference)
    {

        $em = $this->getDoctrine()->getManager();
        $commande = $this->getDoctrine()->getRepository(LigneCommande::class)->findOneBy(array('produit' => $reference));

        $form = $this->createForm(LigneCommandeType::class, $commande);

        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            $data = $form->getData();
            $quantity = $request->request->get('_qunatity');

            $commande->setQuantite($quantity);

            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute("index");


        }

        //return $this->redirectToRoute("index");


    }

    public function BonLivraisonAction(Request $request)
    {
        $bon = new BonLivraison();
        $form = $this->createForm(BonLivraisonType::class, $bon);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($bon);
            $em->flush();
            //  return $this->redirectToRoute('');
        }

        return ($this->render('@Vente/Default/ajoutC.html.twig', array("form" => $form->createView())));
    }

    public function markAllAsSeenAction($notifiable)
    {
        $manager = $this->get('mgilet.notification');
        $manager->markAllAsSeen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            true
        );

        return ($this->render('Vente/index.html.twig', array("notifiable" => $notifiable)));
    }


}