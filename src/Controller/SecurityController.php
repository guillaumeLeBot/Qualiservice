<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    { 
        if ($this->getUser()) {
            if ($this->isGranted('ROLE_LOREAL') && $this->isGranted('ROLE_USER')) {
                return $this->redirectToRoute('app_loreal');
            }
            if ($this->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('app_calendar');
            }
        }
        $referer = $request->headers->get('referer');
        
        $lastRoute = $referer ? $referer : ($this->isGranted('ROLE_LOREAL') ? $this->generateUrl('app_loreal') : $this->generateUrl('app_calendar'));
        
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'lastRoute' => $lastRoute,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    
}
