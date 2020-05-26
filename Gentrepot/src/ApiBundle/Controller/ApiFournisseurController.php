<?php

namespace ApiBundle\Controller;

use AchatBundle\Entity\BonEntree;
use AchatBundle\Entity\BonRetour;
use AchatBundle\Entity\Fournisseur;
use Doctrine\Common\Collections\ArrayCollection;
use StockageBundle\Entity\CommandeDAprovisionnement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TresorerieBundle\Entity\LettreDeRelance;
use UserBundle\Entity\User;


class ApiFournisseurController extends Controller
{
    public function deletefournisseurAction($id){
        $produit = $this->getDoctrine()->getRepository(Fournisseur::class)->find($id);
        $souscat = $this->getDoctrine()->getRepository(CommandeDAprovisionnement::class)->findBy(array("fournisseur"=>$produit));
        $em = $this->getDoctrine()->getManager();
        foreach ($souscat as $s){
            $b = $this->getDoctrine()->getRepository(BonEntree::class)->findOneBy(array('numeroC_commandeAp'=>$s));
            $c = $this->getDoctrine()->getRepository(BonRetour::class)->findOneBy(array('numeroC_commandeAp'=>$s));
            $em->remove($b);
            $em->remove($c);
            $em->remove($s);
            $em->flush();
        }

        $em->remove($produit);
        $em->flush();
        return new Response("Done");


    }

    public function editFournisseurAction(Request $request){
        $fournisseur = $this->getDoctrine()->getRepository(Fournisseur::class)->find($request->get('id'));
        $fournisseur->setRaisonSociale($request->get('raisonSociale'));
        $fournisseur->setNumeroTelephone($request->get('numeroTelephone'));
        $fournisseur->setAdresse($request->get('adresse'));
        $fournisseur->setAdresseMail($request->get('adresseMail'));
        $fournisseur->setMatriculeFiscale($request->get('matriculeFiscale'));
        $fournisseur->setCodePostale($request->get('codePostale'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($fournisseur);
        $em->flush();
        return new Response("Done");

    }

    public function AddFournisseurAction(Request $request){
        $fournisseur = new Fournisseur();
        $fournisseur->setRaisonSociale($request->get('raisonSociale'));
        $fournisseur->setNumeroTelephone($request->get('numeroTelephone'));
        $fournisseur->setAdresse($request->get('adresse'));
        $fournisseur->setAdresseMail($request->get('adresseMail'));
        $fournisseur->setMatriculeFiscale($request->get('matriculeFiscale'));
        $fournisseur->setCodePostale($request->get('codePostale'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($fournisseur);
        $em->flush();
        return new Response("Done");
    }

    public function listFounisseurAction(){
        $fournisseur = $this->getDoctrine()->getRepository(Fournisseur::class)->findAll();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
// Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $formatted = $serializer->normalize(['fournisseur' => $fournisseur]);
        return new JsonResponse($formatted);
    }


















}
