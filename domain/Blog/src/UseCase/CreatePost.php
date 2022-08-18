<?php

namespace Domain\Blog\UseCase;

use Domain\Blog\Entity\Post;

class CreatePost
{
    public function execute(array $postData) : ?Post {
        $post = new Post($postData['title'], $postData['content'], $postData['publishedAt']);

        return $post;
    }
}