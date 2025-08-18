<?php

namespace App\Controller\Admin;

use App\Form\Admin\DelegateSearchType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/delegate', name: 'admin_delegate_')]
final class DelegateController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/list', name: 'list')]
    public function list(Request $request, UserRepository $userRepository): Response
    {
        $form = $this->createForm(DelegateSearchType::class);
        $form->handleRequest($request);

        $criteria = [];
        if ($form->isSubmitted()) {
            $criteria = $form->getData();
        }

        $criteria['role'] = 'ROLE_DELEGATE';
        $criteria['isActive'] = true;

        $page = $request->query->getInt('page', 1);

        return $this->render('admin/delegate/list.html.twig', [
            'delegates' => $userRepository->search($criteria, $page),
            'form' => $form->createView(),
        ]);
    }
}
