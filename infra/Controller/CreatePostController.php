<?php

namespace App\Controller;

use DateTime;
use Domain\Blog\UseCase\CreatePost;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreatePostController
{
    protected CreatePost $useCase;

    public function __construct(CreatePost $useCase)
    {
        $this->useCase = $useCase;
    }

    public function handleRequest(Request $request) {
        if($request->isMethod('GET')) {
            // Montrer le formulaire
            ob_start();
            include __DIR__ . '/../templates/form.html.php';

            return new Response(ob_get_clean());
        }

        // Sinon traiter le formulaire en appelant le useCase
        // Montrer un titre h1 avec le titre de l'article
        $post = $this->useCase->execute([
            'title' => $request->request->get('title', ''),
            'content' => $request->request->get('content', ''),
            'publishedAt' => $request->request->has('published') ?
                new DateTime() : null
        ]);

        return new Response("<h1>{$post->title}</h1>");
    }
}