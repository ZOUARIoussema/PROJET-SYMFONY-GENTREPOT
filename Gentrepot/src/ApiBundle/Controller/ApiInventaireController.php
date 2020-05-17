<?php


namespace ApiBundle\Controller;
use StockageBundle\Entity\Emplacement;
use StockageBundle\Entity\InventaireStock;
use StockageBundle\Form\InventaireStockType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiInventaireController extends Controller
{
    public function allAction()
    {
        $inv = $this->getDoctrine()->getManager()
            ->getRepository(InventaireStock::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($inv);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $inv = new InventaireStock();
        $inv->setDateCreation(new \DateTime());
        $empl = new Emplacement();
        $empl = $this->getDoctrine()->getRepository(Emplacement::class)->find($request->get('id'));
        $inv->setQuantiteTheorique($empl->getQuantiteStocker());
        $ecart = $inv->getQuantiteTheorique()-$request->get('qteinv');
        $inv->setEcart($ecart);
        $inv->setQuantiteInventaire($request->get('qteinv'));
        $inv->setProduit($this->getDoctrine()->getRepository(\AchatBundle\Entity\ProduitAchat::class)->find($request->get('reference')));
        $inv->setEmplacement($this->getDoctrine()->getRepository(Emplacement::class)->find($request->get('id')));

        $em->persist($inv);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($inv);
        return new JsonResponse($formatted);

    }

    public function deleteAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $emp=$em ->getRepository(Emplacement::class)->find((int)$request->get('id'));

        $em->remove($emp);
        $em->flush();



    }

}