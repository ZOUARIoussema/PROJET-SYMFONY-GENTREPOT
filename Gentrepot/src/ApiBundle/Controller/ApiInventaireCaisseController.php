<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TresorerieBundle\Entity\InventaireCaisse;



class ApiInventaireCaisseController extends Controller
{



    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository(InventaireCaisse::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $inventaire = new InventaireCaisse();
        $inventaire->setSoldeCheque($request->get('soldeCheque'));
        $inventaire->setSoldeEspece($request->get('soldeEspece'));
        $inventaire->setSoldeTheorique($request->get('soldeTheorique'));
        $inventaire->setDateCreation($request->get('dateC'));
        $inventaire->setSoldeCalculer($request->get('soldecalculer'));
        $inventaire->setEcart($request->get('ecart'));


        $em->persist($inventaire);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($inventaire);
        return new JsonResponse($formatted);
    }












}
