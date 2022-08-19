<?php

use Domain\Blog\Entity\Post;
use Domain\Blog\Test\Adapters\InMemoryPostRepository;
use Domain\Blog\UseCase\CreatePost;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;

it("should create a post", function(){
    // Simulation de base de données avec une source de données
    $repository = new InMemoryPostRepository();

    // Coder comme j'aimerai que mon code fonctionne
    $useCase = new CreatePost($repository);

    // Exécution du use case
    $post = $useCase->execute([
        'title' => 'Mon titre',
        'content' => 'Mon contenu',
        'publishedAt' => new DateTime()
    ]);

    // Bonne pratique :
    // lors d'un assert, le premier paramètre est ce qu'on connait
    // le second est ce qu'on veut vérifier
    assertInstanceOf(Post::class, $post);
    assertEquals($post, $repository->findOne($post->uuid));
});