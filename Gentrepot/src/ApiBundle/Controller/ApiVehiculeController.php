<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use logistiqueBundle\Entity\vehicule;
class ApiVehiculeController extends Controller
{
    public function affichevehiculeAction(){
        $em= $this->getDoctrine()->getManager();
        $vehicule = $em->getRepository("logistiqueBundle:vehicule")->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);
    }

    public function ajoutvehiculeAction(Request $request){
        $vehicule= new vehicule();

        $vehicule->setEtat('disponible');
        $vehicule->setMatricule($request->get('matricule'));
        $vehicule->setCapacite($request->get('capacite'));
        $vehicule->setType($request->get('type'));
            $em= $this->getDoctrine()->getManager();
            $em-> persist($vehicule);
            $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($vehicule);
        return new JsonResponse($formatted);

        }



}
