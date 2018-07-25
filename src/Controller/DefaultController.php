<?php

namespace App\Controller;

use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ODM\MongoDB\DocumentManager;

class DefaultController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     */
    public function index(DocumentManager $dm) {
        $users = $dm->getRepository('App:User')->findAll();
        
        return $this->render('index.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/mongoTest", methods={"GET"}, name="mongotest")
     */
    public function mongoTest(DocumentManager $dm) {
        $user = new User();
        $user->setEmail("hello@medium.com");
        $user->setUsername("Patt");
        $user->setPassword("123456");

        $dm->persist($user);
        $dm->flush();
        return new JsonResponse(['Status' => 'OK']);
    }

}