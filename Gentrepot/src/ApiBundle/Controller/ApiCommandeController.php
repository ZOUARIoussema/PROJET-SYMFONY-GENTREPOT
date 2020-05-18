<?php

namespace ApiBundle\Controller;

use AchatBundle\Entity\ProduitAchat;
use logistiqueBundle\Entity\aidechauffeur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use VenteBundle\Entity\BonLivraison;
use VenteBundle\Entity\CommandeVente;
use VenteBundle\Entity\LigneCommande;
use VenteBundle\Form\BonLivraisonType;

class ApiCommandeController extends Controller
{

    public function ajoutercomAction(Request $request)
    {

        $com = new CommandeVente();
        $com->setEtat($request->get('etat'));
        $com->setId($request->get('id'));
        $com->setTotalC($request->get('TotalC'));
        $com->setDateC($request->get('DateC'));
        $com->setTauxRemise($request->get('TauxRemise'));
        $com->setLignecommandes($request->get('Lignecommandes'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($com);
        $em->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($com);
        return new JsonResponse($formatted);
    }


    public function ajouterLigneAction(Request $request)
    {


        $p = $this->getDoctrine()->getManager()->getRepository(ProduitAchat::class)->find($request->get('Produit'));

        $c = $this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->find($request->get('Commande'));


        $com = new LigneCommande();


        $com->setProduit($p);
        $com->setQuantite($request->get('Quantite'));

        $com->setTotal($request->get('Total'));
        $com->setCommande($c);
        $com->setPrix($request->get('Prix'));
        $com->setTva($request->get('Tva'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($com);
        $em->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($com);
        return new JsonResponse($formatted);
    }
    public function ajouterBonlivraisonAction(Request $request)
    {


        $bon = new BonLivraison();


      //  $commande = $this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->find($id);

       // $bon->setBonLivraison($commande);
        $bon->setEtat("non Facturé");
            //$bon->setDateCreation(new \DateTime());
              $bon->setAdresseLivraison($request->get('AdresseLivraison'));
                $bon->setNom($request->get('Nom'));
                 $bon->setPrenom($request->get('Prenom'));
          $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($bon);
        return new JsonResponse($formatted);

    }


    public function showAction()
    {
        $list = $this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->findCommande();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($list);
        return new JsonResponse($formatted);
    }

    public function maxCommandeAction(Request $request)
    {


        $c = $this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->findByMax();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($c);
        return new JsonResponse($formatted);
    }


}