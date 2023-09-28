<?php

namespace App\Controller\Admin;

use App\Entity\Note;
use App\Entity\User;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'user')]
    public function index(): Response
    {
        // return parent::index();
        return $this->render('admin/dashboard.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('NoteXXXpress');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Mon carnet');
        yield MenuItem::linkToCrud('Mes catégories', 'fas fa-clipboard-list', Category::class);
        yield MenuItem::linkToCrud('Mes notes', 'fas fa-note-sticky', Note::class);
        yield MenuItem::section('Profil');
        yield MenuItem::linkToCrud('Mon profil', 'fas fa-user', User::class);
        yield MenuItem::section('Retour');
        yield MenuItem::linkToRoute('Retour au site', 'fas fa-arrow-left', 'app_page');
    }
}
