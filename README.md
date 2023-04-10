# Projet_Conex

composer install

symfony server:start -d
symfony open:local

Pour installer si il ne reconnais pas les use importés
symfony composer require symfony/serializer-pack

A installer :
composer require --dev symfony/profiler-pack

Pour importer swagger :
composer require zircote/swagger-php

http://127.0.0.1:8000/swagger/
lien vers l'interface swagger

Pour mettre a jour les modification openAPI
./vendor/bin/openapi --format json --output ./public/swagger/swagger.json ./swagger/swagger.php src

http://127.0.0.1:8000/test/api
lien vers la page de test

Vous trouverez aussi dans ce répertoire le rapport final de projet tutoré ainsi que le calculateur développé au premier semestre
