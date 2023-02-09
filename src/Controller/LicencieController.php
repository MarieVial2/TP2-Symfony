<?php

namespace App\Controller;

use App\Entity\Licencie;
use App\Form\LicencieType;
use App\Repository\LicencieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/licencie')]
class LicencieController extends AbstractController
{
    #[Route('/', name: 'app_licencie_index', methods: ['GET'])]
    public function index(LicencieRepository $licencieRepository): Response
    {
        return $this->render('licencie/index.html.twig', [
            'licencies' => $licencieRepository->findAll(),
        ]);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'app_licencie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LicencieRepository $licencieRepository, SluggerInterface $slugger): Response
    {
        $licencie = new Licencie();
        $form = $this->createForm(LicencieType::class, $licencie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $licencieRepository->save($licencie, true);
            $image = $form->get('photoLicencie')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                // Move the file to the directory where images are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    dd($e);
                }
            }
            $licencie->setPhotoLicencie($newFilename);
            $licencieRepository->save($licencie, true);

            return $this->redirectToRoute('app_licencie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('licencie/new.html.twig', [
            'licencie' => $licencie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_licencie_show', methods: ['GET'])]
    public function show(Licencie $licencie): Response
    {
        return $this->render('licencie/show.html.twig', [
            'licencie' => $licencie,
        ]);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/edit', name: 'app_licencie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Licencie $licencie, LicencieRepository $licencieRepository, SluggerInterface $slugger): Response
    {

        $licencie->setPhotoLicencie(
            new File($this->getParameter('images_directory') . '/' . $licencie->getPhotoLicencie())
        );
        $form = $this->createForm(LicencieType::class, $licencie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $image = $form->get('photoLicencie')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                // Move the file to the directory where images are stored
                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    dd($e);
                }
                $licencie->setPhotoLicencie(
                    $newFilename
                );
            }
            $licencieRepository->save($licencie, true);

            return $this->redirectToRoute('app_licencie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('licencie/edit.html.twig', [
            'licencie' => $licencie,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/{id}', name: 'app_licencie_delete', methods: ['POST'])]
    public function delete(Request $request, Licencie $licencie, LicencieRepository $licencieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $licencie->getId(), $request->request->get('_token'))) {
            $licencieRepository->remove($licencie, true);
        }

        return $this->redirectToRoute('app_licencie_index', [], Response::HTTP_SEE_OTHER);
    }
}