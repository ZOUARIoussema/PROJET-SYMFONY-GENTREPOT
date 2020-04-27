<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TresorerieBundle\Entity\InventaireCaisse;
use TresorerieBundle\Entity\RecouvrementClientCheque;
use TresorerieBundle\Entity\RecouvrementClientEspece;


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



        $cheque=$this->getDoctrine()->getRepository(RecouvrementClientCheque::class)->calculerTotalRecouvrementCheque();

        if($cheque==null){
            $cheque=0;
        }

        $espece=$this->getDoctrine()->getRepository(RecouvrementClientEspece::class)->calculerTotalRecouvrementEspece();

        if($espece==null){
            $espece=0;
        }


        $inventaire = new InventaireCaisse();

        $inventaire->setSoldeCheque($cheque);
        $inventaire->setSoldeEspece($espece);
        $inventaire->setSoldeTheorique($cheque+$espece);
        $inventaire->setDateCreation(new \DateTime());
        $inventaire->setSoldeCalculer($request->get('soldecalculer'));
        $inventaire->setEcart(($cheque+$espece)-$request->get('soldecalculer'));


        $em->persist($inventaire);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($inventaire);
        return new JsonResponse($formatted);
    }



    public function recupererAction()
    {

        $cheque=$this->getDoctrine()->getRepository(RecouvrementClientCheque::class)->calculerTotalRecouvrementCheque();

        if($cheque==null){
            $cheque=0;
        }

        $espece=$this->getDoctrine()->getRepository(RecouvrementClientEspece::class)->calculerTotalRecouvrementEspece();

        if($espece==null){
            $espece=0;
        }

        $inventaire = new InventaireCaisse();
        $inventaire->setSoldeEspece($espece);
        $inventaire->setSoldeCheque($cheque);


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($inventaire);
        return new JsonResponse($formatted);


    }










}
