<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
    * @Route("/", name="app_homepage")
    */
    public function index(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $post->setUser($this->getUser());
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($post);
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Post Created'
                );
                return $this->redirectToRoute('app_homepage');
            } else {
                $this->addFlash(
                    'danger',
                    'Has to be 5 to 255 characters long!'
                );
            }
        }

        $limit = 5;
        $page = $request->query->get('page', 1);
        
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAllWithPaginator($limit, $page);

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
            'maxPages' => ceil($posts->count() / $limit),
            'thisPage' => $page,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/delete-post", name="app_post_delete")
     */
    public function deletePost(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $postId = $request->query->get('post', false);

        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($postId);

        // ToDo - Check if user has permissions
        $hasPermission = true;

        if (!$post && $hasPermission) {
            $this->addFlash(
                'danger',
                'You don\'t have permission to do that!'
            );
            return $this->redirectToRoute('app_homepage');
        }

        $post->setActive(0);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Post deleted!'
        );

        return $this->redirectToRoute('app_homepage');
    }
}