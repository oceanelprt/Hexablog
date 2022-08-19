# Hexablog
Projet de blog avec création d'articles pour découvrir l'architecture hexagonale et les tests.
Le domaine est fonctionnel et prêt à fonctionner avec n'importe quelle source de données, ne dépend d'aucun framework, d'aucune implémentation.
Si on veut par exemple qu'une API REST qui appelle le domaine, c'est possible. Si on veut créer un controller Symfony, c'est possible aussi.

Création du projet avec les dépendances de base utilisées :
`composer require pestphp/pest spatie/phpunit-watcher symfony/var-dumper --dev`

Générer le fichier de configuration pour les tests unitaires : 
`vendor/bin/pest --generate-config`

Lancer les tests :
`vendor/bin/pest`

Pour relancer les tests à chaque modification :
`vendor/bin/phpunit-watcher watch`

Dépendances :
- Beberlei/assert : Permet de faire des validations de données

Mémo :
- Le dossier domain, ou la couche Domain, contient tout le code métier (ici, la publication de poste).
- Le dossier infra représente la couche User interface, on y créé la structure que l'on veut. Peut être du Symfony, le dossier src de Symfony, ... Elle pioche dans la couche domain. Fais le lien entre l'utilisateur et l'application.
- Pour lancer un serveur localhost sur le port 3000 (par exemple) : `php -S localhost:3000`

Pour résumer : 
Imaginons que le dossier domain est un hexagone, et le dossier infra c'est tout ce qui est autour de l'hexagone : notion de dedans-dehors. 
