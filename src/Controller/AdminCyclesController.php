<?php

namespace App\Controller;

use App\Entity\Cycles;
use App\Form\CyclesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminCyclesController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/cycles', name: 'admin_cycles')]
    public function index(): Response
    {
        $cycles = $this->entityManager->getRepository(Cycles::class)->findAll();



        return $this->render(
            'admin/cycles/index.html.twig',

            [
                'cycles' => $cycles
            ]
        );
    }

    #[Route('/admin/cycles/new', name: 'admin_cycle_new')]
    public function create(HttpFoundationRequest $request, EntityManagerInterface $entityManager): Response
    {
        $cycle = new Cycles();

        $form = $this->createForm(CyclesType::class, $cycle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cycle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Le cyle <strong>{$cycle->getName()}</strong> a été bien ajouté !"
            );

            return $this->redirectToRoute('admin_cycles');
        }

        return $this->render(
            'admin/cycles/new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/admin/cycles/{id}/edit', name: 'admin_cycle_edit')]
    public function edit(HttpFoundationRequest $request, EntityManagerInterface $entityManager, Cycles $cycle): Response
    {
        $form = $this->createForm(CyclesType::class, $cycle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cycle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Le cycle a été bien modifié !"
            );

            return $this->redirectToRoute('admin_cycles');
        }

        return $this->render(
            'admin/cycles/new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/admin/cycles/{id}/delete', name: 'admin_cycle_delete')]
    public function delete(EntityManagerInterface $entityManager, Cycles $cycle): Response
    {

        $entityManager->remove($cycle);
        $entityManager->flush();
        $this->addFlash(
            'success',
            "Le cycle <strong>{$cycle->getName()}</strong> a été bien supprimer !"
        );

        return $this->redirectToRoute('admin_cycles');
    }
}
