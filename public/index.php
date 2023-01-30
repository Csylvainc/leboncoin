<?php

use App\Routeur;

// On definit une constante pour avoir le dossier racine du projet
define('ROOT', dirname(__DIR__));

// On définit une constante pour "leboncoin/public"
define("SITEBASE", "leboncoin/public/");

// On importe l'autoloader
require_once(ROOT . DIRECTORY_SEPARATOR . 'autoload.php');

// On instancie le Routeur
$routeur = new Routeur;

// On appelle la méthode principale du routeur
$routeur->app();