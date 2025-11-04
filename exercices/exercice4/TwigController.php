<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TwigController extends AbstractController
{
    // définition du menu de navigation
    const MENU = [
        'Accueil'=>"/",
        'Articles'=>"/articles",
        'Contact'=>"/contact",
        'A propos'=>"/about"
    ];

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        // création de données fictives
        $title = 'Bienvenue sur mon site';
        $description = 'Ceci est une description de mon site web.';

        // rendu du template Twig avec les données
        return $this->render('twig/index.html.twig', [
            'title' => $title,
            'description' => $description,
            'menus' => self::MENU,
        ]);
    }

    #[Route('/articles', name: 'articles')]
    public function articles(): Response
    {
        // création de données fictives
        $articles = [
            ['id'=> 1, 'title' => 'Premier article', 'content' => 'Contenu du premier article.'],
            ['id'=> 2,'title' => 'Deuxième article', 'content' => 'Contenu du deuxième article.'],
            ['id'=> 3,'title' => 'Troisième article', 'content' => 'Contenu du troisième article.'],
        ];
        // rendu du template Twig avec les données
        return $this->render('twig/articles.html.twig', [
            'title' => 'Nos Articles',
            'description' => 'Découvrez tous nos articles ici.',
            'menus' => self::MENU,
            'articles' => $articles,
        ]);
    }

    // détail d'un article
    #[Route('/article/{id}', name: 'article_detail', requirements: ['id' => '\d+'])]
    public function articleDetail(int $id): Response
    {
        // création de données fictives pour un article
        $article = [
            'id' => $id,
            'title' => 'Article #' . $id,
            'content' => 'Contenu détaillé de l\'article #' . $id . '.',
        ];
        // rendu du template Twig avec les données
        return $this->render('twig/article_detail.html.twig', [
            'title' => $article['title'],
            'content' => $article['content'],
            'menus' => self::MENU,
            'description' => 'Contenu de l\'article.',
        ]);
    }
}