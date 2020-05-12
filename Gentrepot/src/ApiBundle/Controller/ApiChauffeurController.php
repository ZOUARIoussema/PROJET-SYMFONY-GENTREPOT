<?php

namespace ApiBundle\Controller;

use logistiqueBundle\Entity\chauffeur;
use logistiqueBundle\Form\chauffeurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiChauffeurController extends Controller
{
    public function ajoutchaufAction(Request $request){

        $chauffeur= new chauffeur();
        $chauffeur->setCin($request->get('cin'));
        $chauffeur->setNom($request->get('nom'));
        $chauffeur->setPrenom($request->get('prenom'));
        $chauffeur->setAdresse($request->get('adresse'));
        $chauffeur->setEtat($request->get('etat'));

        /*  $chauffeur->setEtat('disponible');*/
          $chauffeur->setVoyage(0);
        $em= $this->getDoctrine()->getManager();
        $em-> persist($chauffeur);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($chauffeur);
        return new JsonResponse($formatted);


    }

    public function chauffeuraffAction(){
        $em= $this->getDoctrine()->getManager();
        $chauffeur = $em->getRepository("logistiqueBundle:chauffeur")->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($chauffeur);
        return new JsonResponse($formatted);
    }

}
