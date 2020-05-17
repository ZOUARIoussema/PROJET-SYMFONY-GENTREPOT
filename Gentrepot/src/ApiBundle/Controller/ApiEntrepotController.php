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
        $ent = new Entrepot();
        $ent->setAdresse($request->get('adresse'));
        $ent->setAdresseMail($request->get('adresseMail'));
        $ent->setMatriculeFiscal($request->get('matriculeFiscal'));
        $ent->setNumeroTel($request->get('numeroTel'));
        $ent->setRaisonSocial($request->get('raisonSocial'));

        $em->persist($ent);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($ent);
        return new JsonResponse($formatted);

    }

}