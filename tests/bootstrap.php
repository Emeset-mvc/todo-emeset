<?php

// Carrega l'autoload de Composer (Emeset, el teu projecte, etc.)
require __DIR__ . '/../vendor/autoload.php';

// Marquem explícitament que estem en mode test
putenv('PHPUNIT_RUNNING=1');

// Zona horària per evitar avisos
date_default_timezone_set('Europe/Madrid');