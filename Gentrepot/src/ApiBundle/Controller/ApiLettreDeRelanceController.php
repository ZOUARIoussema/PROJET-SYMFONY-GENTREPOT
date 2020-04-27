<?php

namespace ApiBundle\Controller;

use Proxies\__CG__\VenteBundle\Entity\FactureVente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TresorerieBundle\Entity\LettreDeRelance;
use UserBundle\Entity\User;


class ApiLettreDeRelanceController extends Controller
{



    public function allAction()
    {
        $lettre = $this->getDoctrine()->getManager()
            ->getRepository(LettreDeRelance::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($lettre);
        return new JsonResponse($formatted);
    }

    public function allFactureAction()
    {
        $factures = $this->getDoctrine()->getManager()
            ->getRepository(\VenteBundle\Entity\FactureVente::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($factures);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $lettre = new LettreDeRelance();
        $lettre->setDateCreation(new \DateTime());


        $lettre->setFactureVente($this->getDoctrine()->getRepository(\VenteBundle\Entity\FactureVente::class)->find($request->get('idF')));



        $em->persist($lettre);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($lettre);
        return new JsonResponse($formatted);
    }












}
