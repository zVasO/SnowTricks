<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\TrickException;
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
use Symfony\Component\Security\Core\Exception\AuthenticationException;

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
        return $this->renderForm('trick/create.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws TrickException
     * @throws Exception
     */
    #[Route('/trick/create/', name: 'trick_create2', methods: ['POST'])]
    public function createTrick(Request $request): Response
    {
        $trickForm = $request->request->all('create_trick_form');

        $additionalMedia = [
            'picture' => [],
            'video' => [],
        ];
        //we make a loop for all optionnal picture
        if (!empty($request->request->get('picture-count'))) {
            for ($i = 0 ; $i < $request->request->get('picture-count') ; $i++) {
                //todo verifier si c'est bien un string et url si ca existe
                $additionalMedia['picture'][] = $request->request->get('picture'.$i);
            }
        }

        //we make a loop for all optionnal picture
        if (!empty($request->request->get('video-count'))) {
            for ($i = 0 ; $i < $request->request->get('video-count') ; $i++) {
                //todo verifier si c'est bien un string et url si ca existe
                $additionalMedia['video'][] = $request->request->get('video'.$i);
            }
        }

        //we get the Category entity
        $categoryEntity = $this->categoryService->getCategoryEntityById($trickForm["category"]);

        //we get the current user
        /** @var $user User */
        $user = $this->getUser();
        if (empty($user)) throw new AuthenticationException("Veuillez vous connecter pour ajouter un trick !");

        //we create the trick
        $trickId = $this->trickService->createTrick($trickForm, $categoryEntity, $user, $additionalMedia);
        //we added the media
        return $this->redirectToRoute('trick_detail', array('id' => $trickId));
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

    /**
     * @throws Exception
     */
    #[Route('/trick/delete/{id}', name: 'trick_delete', methods: ['GET'])]
    public function deleteTrick(int $id): Response
    {
        $message = $this->trickService->deleteTrick($id);
        if ($message) $this->addFlash($message["message-type"], $message["message-content"]);
        if ($message) $this->addFlash($message["message-type"], $message["message-content"]);
        return $this->redirectToRoute('app_home');
    }

}
