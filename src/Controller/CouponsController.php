<?php

namespace App\Controller;

use App\Entity\Coupons;
use App\Form\CouponsType;
use App\Repository\CouponsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/coupons')]
class CouponsController extends AbstractController
{
    #[Route('/', name: 'app_coupons_index', methods: ['GET'])]
    public function index(CouponsRepository $couponsRepository): Response
    {
        return $this->render('coupons/index.html.twig', [
            'coupons' => $couponsRepository->findAll(),
            ''
        ]);
    }

    #[Route('/new', name: 'app_coupons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CouponsRepository $couponsRepository): Response
    {
        $coupon = new Coupons();
        $form = $this->createForm(CouponsType::class, $coupon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $couponsRepository->add($coupon, true);

            return $this->redirectToRoute('app_coupons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coupons/new.html.twig', [
            'coupon' => $coupon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coupons_show', methods: ['GET'])]
    public function show(Coupons $coupon): Response
    {
        return $this->render('coupons/show.html.twig', [
            'coupon' => $coupon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coupons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coupons $coupon, CouponsRepository $couponsRepository): Response
    {
        $form = $this->createForm(CouponsType::class, $coupon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $couponsRepository->add($coupon, true);

            return $this->redirectToRoute('app_coupons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coupons/edit.html.twig', [
            'coupon' => $coupon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coupons_delete', methods: ['POST'])]
    public function delete(Request $request, Coupons $coupon, CouponsRepository $couponsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coupon->getId(), $request->request->get('_token'))) {
            $couponsRepository->remove($coupon, true);
        }

        return $this->redirectToRoute('app_coupons_index', [], Response::HTTP_SEE_OTHER);
    }
}
