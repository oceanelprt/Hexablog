<?php

use Domain\Blog\Entity\Post;
use Domain\Blog\UseCase\CreatePost;

use function PHPUnit\Framework\assertInstanceOf;

it("should create a post", function(){
   // Coder comme j'aimerai que mon code fonctionne
    $useCase = new CreatePost;

    $post = $useCase->execute([
        'title' => 'Mon titre',
        'content' => 'Mon contenu',
        'publishedAt' => new DateTime()
    ]);

    assertInstanceOf(Post::class, $post);
});