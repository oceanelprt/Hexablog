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
- Le dossier userInterface représente la couche User interface, on y créé la structure que l'on veut. Peut être du Symfony, le dossier src de Symfony, ... Elle pioche dans la couche domain. Fais le lien entre l'utilisateur et l'application.
- La couche infastructure va brancher l'application à des services bien particuliers : base de données, Redis, envoi de SMS...
- Pour lancer un serveur localhost sur le port 3000 (par exemple) : `php -S localhost:3000`

Pour résumer : 
Imaginons que le dossier domain est un hexagone, et le dossier infra c'est tout ce qui est autour de l'hexagone : notion de dedans-dehors.
Le domain pioche dans l'infrastructure grâce à des interfaces. On ne va pas intégrer une classe qui se trouve dans l'infrastructure (comme l'EntityManager) dans le domain, car si on veut mettre le domain sur un autre projet, ce serait impossible.

- UserInterface : 
  - pilote le domain
  - contient les contrôleurs (créé une Requête qui passera par le Use Case qui renvoie une réponse. Les contrôleurs appellent des Use Case)
  - contient les présenteurs (fournit la passerelle pour la réponse à l'utilisateur, présente la donnée à l'utilisateur)

- Infrastructure :
  - contient les services (base de données, mailer...) qui sont pilotés par le domain

- Domain : 
  - utilise les interfaces
  - pilote l'infrastructure
  - contient les ports (ex : adapteur = EntityManager de Doctrine, port = interface côté domaine branché en alias, comme ça le domain ne dépend pas de Doctrine mais d'un port. Les ports interagissent avec l'Infrastructure)
  - contient les Use Case (cas d'utilisations = les fonctionnalités, utilisent les ports). Génère une Response renvoyée au présenteur
  - contient le Model (entités)
  - contient les Gateway (sert à l'accès aux données, à la manière d'un Repository. Une gateway = un port)
