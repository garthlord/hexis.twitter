<?php

namespace App\Controller;

use App\Entity\Post;
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

        $limit = 1;
        $page = $request->query->get('page', 1);
        
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAllWithPaginator($limit, $page);

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
            'maxPages' => ceil($posts->count() / $limit),
            'thisPage' => $page,
        ]);

    }
}