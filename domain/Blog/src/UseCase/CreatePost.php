<?php

namespace Domain\Blog\UseCase;

use Domain\Blog\Entity\Post;
use Domain\Blog\Port\PostRepositoryInterface;

class CreatePost
{
    // Aucune importance de ce qu'est le repository, si ce dernier possède bien les méthodes inclues dans l'interface PostRepositoryInterface
    protected PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->postRepository = $repository;
    }

    public function execute(array $postData) : ?Post {
        $post = new Post($postData['title'], $postData['content'], $postData['publishedAt']);

        $this->postRepository->save($post);

        return $post;
    }
}