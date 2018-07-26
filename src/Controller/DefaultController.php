<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ODM\MongoDB\DocumentManager;

class DefaultController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     */
    public function index(DocumentManager $dm) {
        $users = $dm->getRepository('App:User')->findAll();
        
        return $this->render('index.html.twig', ['users' => $users]);
    }

}