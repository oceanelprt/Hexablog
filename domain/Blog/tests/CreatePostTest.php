<?php

use Domain\Blog\Entity\Post;
use Domain\Blog\Exception\InvalidPostDataException;
use Domain\Blog\Test\Adapters\InMemoryPostRepository;
use Domain\Blog\Test\Adapters\PDOPostRepository;
use Domain\Blog\UseCase\CreatePost;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;

it("should create a post", function(){
    // Simulation de base de données avec une source de données
    $repository = new PDOPostRepository();

    // Coder comme j'aimerai que mon code fonctionne
    $useCase = new CreatePost($repository);

    // Exécution du use case
    $post = $useCase->execute([
        'title' => 'Mon titre',
        'content' => 'Mon contenu',
        'publishedAt' => new DateTime('2020-01-01 14:30:00') // On a des dates déterministes pour qu'on puisse voir dans les résultats des tests que tout s'est bien passé
    ]);

    // Bonne pratique :
    // lors d'un assert, le premier paramètre est ce qu'on connait
    // le second est ce qu'on veut vérifier
    assertInstanceOf(Post::class, $post);
    assertEquals($post, $repository->findOne($post->uuid));
});

// Test d'erreur
it("should throw a InvalidPostDataException if bad data is provided", function($postData) {
    // Simulation de base de données avec une source de données
    $repository = new InMemoryPostRepository();

    // Coder comme j'aimerai que mon code fonctionne
    $useCase = new CreatePost($repository);

    // Exécution du use case
    $post = $useCase->execute($postData);

    // Bonne pratique :
    // lors d'un assert, le premier paramètre est ce qu'on connait
    // le second est ce qu'on veut vérifier
    assertInstanceOf(Post::class, $post);
    assertEquals($post, $repository->findOne($post->uuid));
})->with([ // with() permet de passer les paramètres à la fonction passée en deuxième paramètre de it()
    [['title' => 'Mon titre', 'publishedAt' => new DateTime('2020-01-01')]],
    [['publishedAt' => new DateTime('2020-01-01')]],
    [[]],
])->throws(InvalidPostDataException::class);