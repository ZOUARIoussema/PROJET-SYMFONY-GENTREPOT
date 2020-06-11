<?php

namespace ApiBundle\Controller;

use AchatBundle\Entity\Fournisseur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FournisseurController extends Controller
 {
    public function indexAction(Request $request)
    {
        $fournisseur = new Fournisseur();

        $fournisseur->setRaisonSociale($request->get('RaisonSociale'));
        $fournisseur->setNumeroTelephone($request->get('NumeroTelephone'));
        $fournisseur->setAdresse($request->get('Adresse'));
        $fournisseur->setAdresseMail($request->get('AdresseMail'));
        $fournisseur->setMatriculeFiscale($request->get('MatriculeFiscale'));
        $fournisseur->setCodePostale($request->get('CodePostale'));
        $em= $this->getDoctrine()->getManager();
        $em-> persist($fournisseur);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($fournisseur);
        return new JsonResponse($formatted);
        }

    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fournisseurs = $em->getRepository('AchatBundle:Fournisseur')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($fournisseurs);
        return new JsonResponse($formatted);

    }



}
