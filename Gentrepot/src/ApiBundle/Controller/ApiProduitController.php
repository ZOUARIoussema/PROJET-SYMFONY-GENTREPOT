<?php

namespace ApiBundle\Controller;

use AchatBundle\Entity\ProduitAchat;
use AchatBundle\Entity\SousCategorieAchat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use VenteBundle\Entity\Produit;

class ApiProduitController extends Controller
{


    public function afficheAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository(ProduitAchat::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function deleteProductAction($id){
        $produit = $this->getDoctrine()->getRepository(ProduitAchat::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        return new Response("Done");


    }

    public function editProductAction(Request $request){
        $produit = $this->getDoctrine()->getRepository(ProduitAchat::class)->find($request->get('ref'));
        $sousCat = $this->getDoctrine()->getRepository(SousCategorieAchat::class)->findOneBy(array('name'=>$request->get('sousCat')));
        $produit->setReference($request->get('ref'));
        $produit->setLibelle($request->get('lib'));
        $produit->setQuantiteEnStock($request->get('quantiteEnStock'));
        $produit->setClasse($request->get('classe'));
        $produit->setQuantiteStockSecurite($request->get('quantiteStockSecurite'));
        $produit->setDernierPrixAchat($request->get('dernierPrixAchat'));
        $produit->setTVA($request->get('TVA'));
        $produit->setDimension($request->get('dimension'));
        $produit->setDescription($request->get('description'));
        $produit->setTypeDeConditionnement($request->get('typeDeConditionnement'));
        $produit->setPrixVente($request->get('prixVente'));
        $produit->setSousCategorie($sousCat);
        $produit->setImage($request->get('image'));
        $produit->setImage1($request->get('image'));
        $produit->setImage2($request->get('image'));
        $produit->setImage3($request->get('image'));
        $produit->setImage4($request->get('image'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        return new Response("Done");
    }


    public function AddProductAction(Request $request){
        $produit = new ProduitAchat();
        $sousCat = $this->getDoctrine()->getRepository(SousCategorieAchat::class)->findOneBy(array('name'=>$request->get('sousCat')));
        $produit->setReference($request->get('ref'));
        $produit->setLibelle($request->get('lib'));
        $produit->setQuantiteEnStock($request->get('quantiteEnStock'));
        $produit->setClasse($request->get('classe'));
        $produit->setQuantiteStockSecurite($request->get('quantiteStockSecurite'));
        $produit->setDernierPrixAchat($request->get('dernierPrixAchat'));
        $produit->setTVA($request->get('TVA'));
        $produit->setDimension($request->get('dimension'));
        $produit->setDescription($request->get('description'));
        $produit->setTypeDeConditionnement($request->get('typeDeConditionnement'));
        $produit->setPrixVente($request->get('prixVente'));
        $produit->setSousCategorie($sousCat);
        $produit->setImage($request->get('image'));
        $produit->setImage1($request->get('image'));
        $produit->setImage2($request->get('image'));
        $produit->setImage3($request->get('image'));
        $produit->setImage4($request->get('image'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        return new Response("Done");
    }

    public function ListProductAction(){
        $produits = $this->getDoctrine()->getRepository(ProduitAchat::class)->findAll();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
// Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $formatted = $serializer->normalize(['produit' => $produits]);
        return new JsonResponse($formatted);
    }
}
