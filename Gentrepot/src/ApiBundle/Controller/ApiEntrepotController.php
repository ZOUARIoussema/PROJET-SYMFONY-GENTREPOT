<?php


namespace ApiBundle\Controller;

use StockageBundle\Entity\Emplacement;
use StockageBundle\Entity\Entrepot;
use StockageBundle\Form\EmplacementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiEntrepotController extends Controller
{
    public function allAction()
    {
        $com = $this->getDoctrine()->getManager()
            ->getRepository(Entrepot::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($com);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = new Entrepot();
        $commande->setAdresse($request->get('adresse'));
        $commande->setAdresseMail($request->get('adresseMail'));
        $commande->setMatriculeFiscal($request->get('matriculeFiscale'));
        $commande->setNumeroTel($request->get('numeroTel'));
        $commande->setRaisonSocial($request->get('raisonSociale'));

        $em->persist($commande);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($commande);
        return new JsonResponse($formatted);

    }

}