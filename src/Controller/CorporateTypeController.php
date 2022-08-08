<?php

namespace App\Controller;

use App\Entity\CorporateType;
use App\Form\CorporateTypeType;
use App\Repository\CorporateTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/corporate/type')]
class CorporateTypeController extends AbstractController
{
    #[Route('/', name: 'app_corporate_type_index', methods: ['GET'])]
    public function index(CorporateTypeRepository $corporateTypeRepository): Response
    {
        return $this->render('corporate_type/index.html.twig', [
            'corporate_types' => $corporateTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_corporate_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CorporateTypeRepository $corporateTypeRepository): Response
    {
        $corporateType = new CorporateType();
        $form = $this->createForm(CorporateTypeType::class, $corporateType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $corporateTypeRepository->add($corporateType, true);

            return $this->redirectToRoute('app_corporate_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('corporate_type/new.html.twig', [
            'corporate_type' => $corporateType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_corporate_type_show', methods: ['GET'])]
    public function show(CorporateType $corporateType): Response
    {
        return $this->render('corporate_type/show.html.twig', [
            'corporate_type' => $corporateType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_corporate_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CorporateType $corporateType, CorporateTypeRepository $corporateTypeRepository): Response
    {
        $form = $this->createForm(CorporateTypeType::class, $corporateType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $corporateTypeRepository->add($corporateType, true);

            return $this->redirectToRoute('app_corporate_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('corporate_type/edit.html.twig', [
            'corporate_type' => $corporateType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_corporate_type_delete', methods: ['POST'])]
    public function delete(Request $request, CorporateType $corporateType, CorporateTypeRepository $corporateTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$corporateType->getId(), $request->request->get('_token'))) {
            $corporateTypeRepository->remove($corporateType, true);
        }

        return $this->redirectToRoute('app_corporate_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
