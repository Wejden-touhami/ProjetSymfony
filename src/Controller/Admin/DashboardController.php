<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Entity\Regle;
use App\Entity\Annonce;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Menu\MenuInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use App\Controller\Admin\CandidatCrudController;
use App\Controller\Admin\AdminCrudController;
use App\Controller\Admin\RecruteurCrudController;
use App\Controller\Admin\AnnonceCrudController;






class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        //return parent::index();
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(AnnonceCrudController::class)->generateUrl());

        

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //return $this->render('some/path/my-dashboard.html.twig');

        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjetSymfony') 
            ->setTranslationDomain('Recrute.com')
            ->disableUrlSignatures();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Condidat', 'fab fa-500px', User:: class)->setController(CondidatCrudController::class);
        yield MenuItem::linkToCrud('Recruteur', 'fab fa-500px', User:: class)->setController(RecruteurCrudController::class);
        yield MenuItem::linkToCrud('Admin', 'fab fa-500px', User:: class)->setController(AdminCrudController::class);
        yield MenuItem::linkToCrud('Regle', 'fab fa-500px', Regle:: class);
        yield MenuItem::linkToLogout('Logout', 'fa fa-exit');

    }
    
}
