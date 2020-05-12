<?php


namespace ApiBundle\Controller;


use StockageBundle\Entity\Perte;
use StockageBundle\Form\PerteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiPerteController extends Controller
{
    public function allAction()
    {
        $pert = $this->getDoctrine()->getManager()
            ->getRepository(Perte::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($pert);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pert = new Perte();
        $pert->setDateCreation(new \DateTime());

        $em->persist($pert);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($pert);
        return new JsonResponse($formatted);

    }

    public function deleteAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $pert=$em ->getRepository(Perte::class)->find((int)$request->get('idp'));

        $em->remove($pert);
        $em->flush();



    }

}