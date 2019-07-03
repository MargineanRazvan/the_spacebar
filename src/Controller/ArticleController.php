<?php


namespace App\Controller;

use Psr\Log\LoggerInterface; // pt logger
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; // pt rute
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // pt a putea folosi twig
use Symfony\Component\HttpFoundation\Response;  // pt response
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * 
     * 'name' it uses for dynamic routes. In template you can put 'app_homepage' as href to show destination. E.g href=" {{ path('app_homepage') }} "
     */
    public function homepage() 
    {
        return $this->render('article/homepage.html.twig');
    }


    /** 
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug)
    {   

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        return $this->render("article/show.html.twig", [
            'title' => ucwords(str_replace("-", " ", $slug)),
            'slug' => $slug,
            'comments' => $comments,
        ]);
    }


    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHart($slug, LoggerInterface $logger)
    {
        $logger->info("Article is being harted");
        
        return new JsonResponse(['hearts' => rand(5, 100)]);
    }

}