<?php

namespace App\Controller;

use App\Entity\Ustav;
use App\Form\UstavType;
use App\Repository\UstavRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ustav')]
class UstavController extends AbstractController
{
    #[Route('/', name: 'app_ustav_index', methods: ['GET'])]
    public function index(UstavRepository $ustavRepository, Security $security): Response
    {

        return $this->render('ustav/index.html.twig', [
            'ustav' => $ustavRepository->findLast()
        ]);
    }

    #[Route('/new', name: 'app_ustav_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UstavRepository $ustavRepository): Response
    {
        $ustav = new Ustav();
        $form = $this->createForm(UstavType::class, $ustav);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ustav->setCreatedAt(new \DateTimeImmutable('now'));
            $ustav->setUpdatedAt(new \DateTimeImmutable('now'));

            $ustavRepository->save($ustav, true);

            return $this->redirectToRoute('app_ustav_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ustav/new.html.twig', [
            'ustav' => $ustav,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ustav_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ustav $ustav, UstavRepository $ustavRepository): Response
    {
        $form = $this->createForm(UstavType::class, $ustav);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ustav->setUpdatedAt(new \DateTimeImmutable('now'));

            $ustavRepository->save($ustav, true);

            return $this->redirectToRoute('app_ustav_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ustav/edit.html.twig', [
            'ustav' => $ustav,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ustav_delete', methods: ['POST'])]
    public function delete(Request $request, Ustav $ustav, UstavRepository $ustavRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ustav->getId(), $request->request->get('_token'))) {
            $ustavRepository->remove($ustav, true);
        }

        return $this->redirectToRoute('app_ustav_index', [], Response::HTTP_SEE_OTHER);
    }
}
