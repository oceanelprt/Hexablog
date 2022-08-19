<?php

namespace Domain\Blog\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Blog\Entity\Post;
use Domain\Blog\Exception\InvalidPostDataException;
use Domain\Blog\Port\PostRepositoryInterface;
use function Assert\lazy;

class CreatePost
{
    // Aucune importance de ce qu'est le repository, si ce dernier possède bien les méthodes inclues dans l'interface PostRepositoryInterface
    protected PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->postRepository = $repository;
    }

    public function execute(array $postData) : ?Post {
        // Lors de l'envoi de données, il se peut que des entrées soient vides dans $postData
        $post = new Post(
            $postData['title'] ?? '',
            $postData['content'] ?? '',
            $postData['publishedAt'] ?? null
        );

        // Validation de données
        try {
            $this->validate($post);

            $this->postRepository->save($post);

            return $post;
        } catch(LazyAssertionException $e) {
            // Lancer une exception métier
            throw new InvalidPostDataException($e->getMessage());
        }
    }

    // Validation de données
    protected function validate(Post $post) {
        // lazy() est une fonction proposée par beberlei/assert pour la validation de données.
        // Elle permet de faire passer toutes les assertions d'un seul coup et de lister l'ensemble des erreurs et non pas seulement la première
        // S'assurer que le titre du poste n'est pas vide et qu'il a au moins 3 caractères
        lazy()->that($post->title)->notBlank()->minLength(3)
            // et que le contenu n'est pas vide et qu'il fait au moins 10 caractères
            ->that($post->content)->notBlank()->minLength(10)
            // et que la date de publication soit nulle ou de type DateTimeInterface
            ->that($post->publishedAt)->nullOr()->isInstanceOf(DateTimeInterface::class)
            // lancer la vérification. verifyNow() lance une LazyAssertionException en cas d'erreur.
            ->verifyNow();
    }
}