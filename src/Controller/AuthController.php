<?php

namespace App\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/login', name: 'app_auth')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastusername = $authenticationUtils->getLastUsername();

        return $this->render('auth/index.html.twig', [
            'controller_name' => 'AuthController',
            'last_username' => $lastusername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout(): void
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }    
}
