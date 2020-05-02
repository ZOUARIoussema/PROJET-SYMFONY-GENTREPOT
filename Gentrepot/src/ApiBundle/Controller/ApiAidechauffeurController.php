<?php

namespace ApiBundle\Controller;

use logistiqueBundle\Entity\aidechauffeur;
use logistiqueBundle\Form\aideChauffeurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
class ApiAidechauffeurController extends Controller

{


    public function affaideAction(){
        $em= $this->getDoctrine()->getManager();
        $Achauf = $em->getRepository("logistiqueBundle:aidechauffeur")->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Achauf);
        return new JsonResponse($formatted);

    }
    public function ajoutAchaufAction(Request $request){

        $Achauffeur= new aidechauffeur();
        $Achauffeur->setCin($request->get('cin'));
        $Achauffeur->setNom($request->get('nom'));
        $Achauffeur->setPrenom($request->get('prenom'));
        $Achauffeur->setAdresse($request->get('adresse'));

        $em= $this->getDoctrine()->getManager();
        $em-> persist($Achauffeur);
            $em->flush();



        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Achauffeur);
        return new JsonResponse($formatted);
    }
}
