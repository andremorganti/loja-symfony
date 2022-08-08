<?php

namespace App\Controller;

use App\Entity\Cnae;
use App\Form\CnaeType;
use App\Repository\CnaeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cnae')]
class CnaeController extends AbstractController
{
    #[Route('/', name: 'app_cnae_index', methods: ['GET'])]
    public function index(CnaeRepository $cnaeRepository): Response
    {
        return $this->render('cnae/index.html.twig', [
            'cnaes' => $cnaeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cnae_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CnaeRepository $cnaeRepository): Response
    {
        $cnae = new Cnae();
        $form = $this->createForm(CnaeType::class, $cnae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cnaeRepository->add($cnae, true);

            return $this->redirectToRoute('app_cnae_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cnae/new.html.twig', [
            'cnae' => $cnae,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cnae_show', methods: ['GET'])]
    public function show(Cnae $cnae): Response
    {
        return $this->render('cnae/show.html.twig', [
            'cnae' => $cnae,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cnae_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cnae $cnae, CnaeRepository $cnaeRepository): Response
    {
        $form = $this->createForm(CnaeType::class, $cnae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cnaeRepository->add($cnae, true);

            return $this->redirectToRoute('app_cnae_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cnae/edit.html.twig', [
            'cnae' => $cnae,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cnae_delete', methods: ['POST'])]
    public function delete(Request $request, Cnae $cnae, CnaeRepository $cnaeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cnae->getId(), $request->request->get('_token'))) {
            $cnaeRepository->remove($cnae, true);
        }

        return $this->redirectToRoute('app_cnae_index', [], Response::HTTP_SEE_OTHER);
    }
}
