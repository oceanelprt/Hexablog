<?php

use function PHPUnit\Framework\assertTrue;

// lancer un test : vendor/bin/pest
// pour regarder les fichiers, et relancer les tests à chaque modification : vendor/bin/phpunit-watcher watch

// it = fonction permettant de créer un test
// "should work" est la description du test
it("should work", function(){
    assertTrue(true);
});