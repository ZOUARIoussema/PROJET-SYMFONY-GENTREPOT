<?php

namespace ApiBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TresorerieBundle\Entity\LettreDeRelance;
use UserBundle\Entity\User;


class ApiUserController extends Controller
{



    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository(User::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setUsername($request->get('username'));
        $user->setUsernameCanonical($user->getUsername());
        $user->setEmail($request->get('email'));
        $user->setEmailCanonical($user->getEmail());
        $user->setPassword($request->get('password'));



            $user->setRoles(array('Client' => 'ROLE_CLIEN'));


        $em->persist($user);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }



    public function modifierAction(Request $request){


        $em = $this->getDoctrine()->getManager();

        $user=$em ->getRepository(User::class)->find((int)$request->get('id'));

        $user->setPassword($request->get('paswd'));

        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);


    }

























}
