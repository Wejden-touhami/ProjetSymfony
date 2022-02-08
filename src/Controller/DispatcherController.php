<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DispatcherController extends AbstractController
{
    /**
     * @Route("/dispatch", name="app_dispatch")
     */
    public function index(): Response
    {
      if ($this->isGranted('ROLE_ADMIN')) {
        return $this->redirectToRoute('admin');
      }
        
      if ($this->isGranted('ROLE_RECRUTEUR')) {
        return $this->redirectToRoute('annonce_index');
      } 
       
      return $this->redirectToRoute('home_page');
    }
}
