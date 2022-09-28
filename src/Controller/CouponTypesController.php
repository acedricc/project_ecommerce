<?php

namespace App\Controller;

use App\Entity\CouponTypes;
use App\Form\CouponTypesType;
use App\Repository\CouponTypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/coupon/types')]
class CouponTypesController extends AbstractController
{
    #[Route('/', name: 'app_coupon_types_index', methods: ['GET'])]
    public function index(CouponTypesRepository $couponTypesRepository): Response
    {
        return $this->render('coupon_types/index.html.twig', [
            'coupon_types' => $couponTypesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coupon_types_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CouponTypesRepository $couponTypesRepository): Response
    {
        $couponType = new CouponTypes();
        $form = $this->createForm(CouponTypesType::class, $couponType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $couponTypesRepository->add($couponType, true);

            return $this->redirectToRoute('app_coupon_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coupon_types/new.html.twig', [
            'coupon_type' => $couponType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coupon_types_show', methods: ['GET'])]
    public function show(CouponTypes $couponType): Response
    {
        return $this->render('coupon_types/show.html.twig', [
            'coupon_type' => $couponType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coupon_types_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CouponTypes $couponType, CouponTypesRepository $couponTypesRepository): Response
    {
        $form = $this->createForm(CouponTypesType::class, $couponType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $couponTypesRepository->add($couponType, true);

            return $this->redirectToRoute('app_coupon_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coupon_types/edit.html.twig', [
            'coupon_type' => $couponType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coupon_types_delete', methods: ['POST'])]
    public function delete(Request $request, CouponTypes $couponType, CouponTypesRepository $couponTypesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$couponType->getId(), $request->request->get('_token'))) {
            $couponTypesRepository->remove($couponType, true);
        }

        return $this->redirectToRoute('app_coupon_types_index', [], Response::HTTP_SEE_OTHER);
    }
}
