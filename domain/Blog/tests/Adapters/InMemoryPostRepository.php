<?php

namespace Domain\Blog\Test\Adapters;

use Domain\Blog\Entity\Post;

class InMemoryPostRepository
{
    // Simulation d'une base de données
    public array $posts = [];

    public function save(Post $post) : Post
    {
        $this->posts[$post->uuid] = $post;

        return $post;
    }

    public function findOne(string $uuid): ?Post {
        return $this->posts[$uuid] ?? null;
    }
}