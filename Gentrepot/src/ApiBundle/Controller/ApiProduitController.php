<?php

namespace ApiBundle\Controller;

use AchatBundle\Entity\ProduitAchat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use VenteBundle\Entity\Produit;

class ApiProduitController extends Controller
{


    public function afficheAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository(ProduitAchat::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
}
