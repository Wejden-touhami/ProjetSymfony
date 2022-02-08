<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AuthenticationSuccessListener implements AuthenticationSuccessHandlerInterface
{
    public function __construct(EntityManagerInterface $entityManager, RouterInterface $route)
    {
        $this->entityManager = $entityManager;
        $this->route = $route;
    }

    
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $request = $event->getRequest();
        $this->onAuthenticationSuccess($request, $token);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
      dd("xxxxxxxxxxxxxxx");
      $user = $token->getUser();

      if (!$user instanceof User) {
        return;
      }

      $user->setDateLogin(new \DateTime());

      $this->entityManager->persist($user);
      $this->entityManager->flush();

      return new RedirectResponse(
        $request->getSession()->get('_security.main.target_path') ??
        $this->r->generate('index')
      );
    }
}
