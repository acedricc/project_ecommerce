<?php

namespace App\Controller;

use App\Entity\CommandesDetails;
use App\Form\CommandesDetailsType;
use App\Repository\CommandesDetailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commandes/details')]
class CommandesDetailsController extends AbstractController
{
    #[Route('/', name: 'app_commandes_details_index', methods: ['GET'])]
    public function index(CommandesDetailsRepository $commandesDetailsRepository): Response
    {
        return $this->render('commandes_details/index.html.twig', [
            'commandes_details' => $commandesDetailsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commandes_details_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommandesDetailsRepository $commandesDetailsRepository): Response
    {
        $commandesDetail = new CommandesDetails();
        $form = $this->createForm(CommandesDetailsType::class, $commandesDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandesDetailsRepository->add($commandesDetail, true);

            return $this->redirectToRoute('app_commandes_details_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commandes_details/new.html.twig', [
            'commandes_detail' => $commandesDetail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commandes_details_show', methods: ['GET'])]
    public function show(CommandesDetails $commandesDetail): Response
    {
        return $this->render('commandes_details/show.html.twig', [
            'commandes_detail' => $commandesDetail,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commandes_details_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommandesDetails $commandesDetail, CommandesDetailsRepository $commandesDetailsRepository): Response
    {
        $form = $this->createForm(CommandesDetailsType::class, $commandesDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandesDetailsRepository->add($commandesDetail, true);

            return $this->redirectToRoute('app_commandes_details_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commandes_details/edit.html.twig', [
            'commandes_detail' => $commandesDetail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commandes_details_delete', methods: ['POST'])]
    public function delete(Request $request, CommandesDetails $commandesDetail, CommandesDetailsRepository $commandesDetailsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandesDetail->getId(), $request->request->get('_token'))) {
            $commandesDetailsRepository->remove($commandesDetail, true);
        }

        return $this->redirectToRoute('app_commandes_details_index', [], Response::HTTP_SEE_OTHER);
    }
}
