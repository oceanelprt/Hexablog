# Hexablog
Projet de blog avec création d'articles pour découvrir l'architecture hexagonale et les tests.

Création du projet :
`composer require pestphp/pest spatie/phpunit-watcher symfony/var-dumper --dev`

Générer le fichier de configuration pour les tests unitaires : 
`vendor/bin/pest --generate-config`

Lancer les tests :
`vendor/bin/pest`

Pour relancer les tests à chaque modification :
`vendor/bin/phpunit-watcher watch`
