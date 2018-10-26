<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    /**
    * @Route("/", name="app_homepage")
    */
    public function index()
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('index.html.twig');

    }
}