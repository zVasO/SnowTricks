<?php

namespace App\Controller;

use App\Form\CreateTrickFormType;
use App\Service\CategoryService;
use App\Service\MediaService;
use App\Service\ParameterVerificationService;
use App\Service\TrickService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    public function __construct(private TrickService $trickService, private CategoryService $categoryService, private MediaService $mediaService)
    {
    }

    /**
     * @return Response
     */
    #[Route('/trick/create/', name: 'trick_create', methods: ['GET'])]
    public function createPageTrick(): Response
    {
        $form = $this->createForm(CreateTrickFormType::class);
        return $this->render('trick/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @return Response
     */
    #[Route('/trick/create/', name: 'trick_create2', methods: ['POST'])]
    public function createTrick(Request $request): Response
    {
        dd($request);
    }

    /**
     * @throws Exception
     */
    #[Route('/trick/{id}/', name: 'trick_detail')]
    public function showTrick(int $id): Response
    {
        $trick = $this->trickService->getTrickById($id);
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
            'trick' => $trick
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/trick/edit/{id}', name: 'trick_edit_post', methods: ['POST'])]
    public function updateTrick(Request $request, int $id): Response
    {
        //We make sure all fields are filled
        ParameterVerificationService::verifyTrickEditArray($request->request->all());
        ParameterVerificationService::verifyMedia($request->request->all());

        //We get the category
        $categoryEntity = $this->categoryService->getCategoryEntityById($request->request->get('category'));
        //We udpate the selected media
        $this->mediaService->updateMediaEntity($request->request->get("media-id"), $request->request->get("url-media"));
        //we update our trick
        $this->trickService->updateTrickById($id, $request->request->get('trick-description'), $categoryEntity);

        return $this->editTrick($id);
    }

    /**
     * @throws Exception
     */
    #[Route('/trick/edit/{id}', name: 'trick_edit', methods: ['GET'])]
    public function editTrick(int $id): Response
    {
        $trick = $this->trickService->getTrickById($id);
        $categories = $this->categoryService->getAllTricks();
        return $this->render('trick/edit.html.twig', [
            'controller_name' => 'TrickController',
            'trick' => $trick,
            'categories' => $categories
        ]);
    }
}
