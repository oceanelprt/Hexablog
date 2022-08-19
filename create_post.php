<?php

use App\Controller\CreatePostController;
use Domain\Blog\Test\Adapters\PDOPostRepository;
use Domain\Blog\UseCase\CreatePost;
use Symfony\Component\HttpFoundation\Request;

// Mise en place de l'application, exemple d'implémentation en PHP
// Ainsi, quelque chose "enrobe" notre cas d'utilisation

// Aller chercher l'autoloader
require __DIR__ . '/vendor/autoload.php';

// Création de la requête
$request = Request::createFromGlobals();

// !!! A ne pas faire !!!
// Au conteneur d'injections de dépendances de Symfo de le faire
$pdoRepository = new PDOPostRepository();

// Création du useCase
$useCase = new CreatePost($pdoRepository);

// Création du controller
$controller = new CreatePostController($useCase);

// Appel
$response = $controller->handleRequest($request);

// Renvoi de la réponse reçue par le controller au navigateur
$response->send();