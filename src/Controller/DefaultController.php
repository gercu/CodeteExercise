<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     */
    public function index(DocumentManager $dm) {
        $users = $dm->getRepository('App:User')->findAll();
        
        return $this->render('index.html.twig', ['users' => $users]);
    }

}