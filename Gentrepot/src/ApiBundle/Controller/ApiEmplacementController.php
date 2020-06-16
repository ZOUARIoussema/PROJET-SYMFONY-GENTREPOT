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


class ApiEmplacementController extends Controller
{
    public function allAction()
    {
        $emp = $this->getDoctrine()->getManager()
            ->getRepository(Emplacement::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($emp);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emp = new Emplacement();
        $emp->setAdresse($request->get('adresse'));
        $emp->setClasse($request->get('classe'));
        $emp->setCapaciteStockage($request->get('capaciteStockage'));
        $emp->setQuantiteStocker($request->get('quantiteStocker'));
        //$emp->setEntrepot($this->getDoctrine()->getRepository(Entrepot::class)->find($request->get('matriculeFiscal')));

        $em->persist($emp);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($emp);
        return new JsonResponse($formatted);

    }

    public function deleteAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $emp=$em ->getRepository(Emplacement::class)->find((int)$request->get('id'));

        $em->remove($emp);
        $em->flush();



    }

}