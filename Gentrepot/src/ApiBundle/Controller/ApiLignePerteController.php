<?php


namespace ApiBundle\Controller;
use StockageBundle\Entity\Perte;
use StockageBundle\Form\PerteType;
use StockageBundle\Entity\LignePerte;
use StockageBundle\Form\LignePerteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiLignePerteController extends Controller
{
    public function allAction()
    {
        $lpert = $this->getDoctrine()->getManager()
            ->getRepository(LignePerte::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($lpert);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lpert = new LignePerte();
        $lpert->getQuantite($request->get('qte'));
        $lpert->getRaisonPerte($request->get('raison'));
        $lpert->setProduit($this->getDoctrine()->getRepository(\AchatBundle\Entity\ProduitAchat::class)->find($request->get('refPro')));
        $lpert->setPerte($this->getDoctrine()->getRepository(Perte::class)->find($request->get('idp')));

        $em->persist($lpert);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($lpert);
        return new JsonResponse($formatted);

    }

    public function deleteAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $lpert=$em ->getRepository(LignePerte::class)->find((int)$request->get('idlp'));

        $em->remove($lpert);
        $em->flush();



    }

}