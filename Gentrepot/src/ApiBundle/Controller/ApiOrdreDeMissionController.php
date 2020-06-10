<?php

namespace ApiBundle\Controller;

use logistiqueBundle\Entity\ordremission;
use logistiqueBundle\Form\ordremissionType;
use Proxies\__CG__\logistiqueBundle\Entity\chauffeur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\DateTime;

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
        $ordre->setIdChauffeur($this->getDoctrine()->getRepository(\logistiqueBundle\Entity\chauffeur::class)->find($request->get('chauffeur')));
        $ordre->setIdAidechauff($this->getDoctrine()->getRepository(\logistiqueBundle\Entity\aidechauffeur::class)->find($request->get('Aidechauffeur')));
        $ordre->setIdVehicule($this->getDoctrine()->getRepository(\logistiqueBundle\Entity\vehicule::class)->find($request->get('vehicule')));
        $ordre->setBondelivraisons($request->get('bondelivraison'));

        $ordre->setDatecreation(new \DateTime());



        $ordre->setDatesortie( new \DateTime($request->get('dateSortie')));
        $ordre->setDateretour(new \DateTime($request->get('dateRetour')));


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

    public function  deleteMAction($id){
        $em=$this->getDoctrine()->getManager();
        $M = $em->getRepository("logistiqueBundle:ordremission")->find($id);
        $em->remove($M);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($M);
        return new JsonResponse($formatted);
    }
    public function afficheAction(){
        $em= $this->getDoctrine()->getManager();
        $ordre = $em->getRepository("VenteBundle:BonLivraison")->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($ordre);
        return new JsonResponse($formatted);
    }
}
