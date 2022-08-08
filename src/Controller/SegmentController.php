<?php

namespace App\Controller;

use App\Entity\Segment;
use App\Form\SegmentType;
use App\Repository\SegmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/segment')]
class SegmentController extends AbstractController
{
    #[Route('/', name: 'app_segment_index', methods: ['GET'])]
    public function index(SegmentRepository $segmentRepository): Response
    {
        return $this->render('segment/index.html.twig', [
            'segments' => $segmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_segment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SegmentRepository $segmentRepository): Response
    {
        $segment = new Segment();
        $form = $this->createForm(SegmentType::class, $segment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $segmentRepository->add($segment, true);

            return $this->redirectToRoute('app_segment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('segment/new.html.twig', [
            'segment' => $segment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_segment_show', methods: ['GET'])]
    public function show(Segment $segment): Response
    {
        return $this->render('segment/show.html.twig', [
            'segment' => $segment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_segment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Segment $segment, SegmentRepository $segmentRepository): Response
    {
        $form = $this->createForm(SegmentType::class, $segment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $segmentRepository->add($segment, true);

            return $this->redirectToRoute('app_segment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('segment/edit.html.twig', [
            'segment' => $segment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_segment_delete', methods: ['POST'])]
    public function delete(Request $request, Segment $segment, SegmentRepository $segmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$segment->getId(), $request->request->get('_token'))) {
            $segmentRepository->remove($segment, true);
        }

        return $this->redirectToRoute('app_segment_index', [], Response::HTTP_SEE_OTHER);
    }
}
