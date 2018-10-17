<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\User;


class SecurityController extends AbstractController {

    /**
     * @Route("/login", methods={"GET", "POST"}, name="security_login")
     * @param AuthenticationUtils $helper
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginPageAction(AuthenticationUtils $helper) {     
        
        
       return $this->render('security/login.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }
    
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction(): void
    {
        throw new \Exception('This should never be reached!');
    }

    /**
     * @Route("/register", methods={"POST"}, name="security_register")
     * @param Request $request
     * @param DocumentManager $dm
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function registerAction(Request $request, DocumentManager $dm)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $email = $request->get('email');
        
        $user = new User($username, $password, $email);
        
        $dm->persist($user);
        $dm->flush();
        
        return $this->redirectToRoute('security_login');
    }
}