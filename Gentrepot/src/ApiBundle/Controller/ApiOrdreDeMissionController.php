<?php

namespace ApiBundle\Controller;

use logistiqueBundle\Entity\ordremission;
use logistiqueBundle\Form\ordremissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiOrdreDeMissionController extends Controller
{
    public function afficheordreAction(){
        $em= $this->getDoctrine()->getManager();
        $ordrem = $em->getRepository("logistiqueBundle:ordremission")->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($ordrem);
        return new JsonResponse($formatted);
    }

    public function ajoutordreMAction(Request $request){
        $ordre= new ordremission();
        $ordre->setId($request->get('id'));
        $ordre->setIdChauffeur($request->get('cin'));
        $ordre->setIdAidechauff($request->get('cin'));
        $ordre->setIdVehicule($request->get('matricule'));
        $ordre->setBondelivraisons($request->get('bondelivraison'));
        $ordre->getIdVehicule()->setEtat('non disponible');
        $ordre->getIdChauffeur()->setEtat('non disponible');
        $nb=$ordre->getIdChauffeur()->getVoyage();
        $ordre->getIdChauffeur()->setVoyage($nb+1);
            $em= $this->getDoctrine()->getManager();
            $em-> persist($ordre);
            $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($ordre);
        return new JsonResponse($formatted);
        }
    /*public function recMAction(Request $request){
        $em= $this->getDoctrine()->getManager();
       // $ordrem = $em->getRepository("logistiqueBundle:ordremission")->findAll();
        $ordrem = $em->getRepository("logistiqueBundle:ordremission")->findByEtat('disponible');
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($ordrem);
        return new JsonResponse($formatted);
    }*/
}
