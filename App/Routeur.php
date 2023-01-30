<?php
namespace App;

use Controllers\Controller;
use Controllers\ProductsController;
use Models\CategoriesModel;

class Routeur{
    public function app(){
        // On test le routeur
        // echo "le routeur fonctionne";

        // Récupération de l'url
        $request = $_SERVER['REQUEST_URI'];
        // echo $request;
        // echo "<br>";
        // On supprime "leboncoin/public" de request
        $nb = strlen(SITEBASE);
        // echo $nb;
        $request = substr($request, $nb);
        // echo "<br>";
        // On test
        // echo $request;

        // On "casse" $request pour récupérer les paramètres GET éventuels
        // Première partie : route demandée par le client
        // seconde partie : $_GET
        $request = explode("?", $request);
        // On créer une chaine de caractère de la première partie
        $request = $request[0];
        // echo "<br>";
        // echo $request;


        // On définit les routes du projet
        switch ($request) {
            case '/':
                // echo "vous etes sur la page d'accueil";
                $accueil = new ProductsController;
                $accueil->accueil();
                break;
            case '/products':
                // echo "pages products";
                $allProducts = new ProductsController;
                if (isset($_GET['order']) && isset($_GET['idCategorie'])) {
                    $order = $_GET['order'];
                    $categorie = [$_GET['idCategorie']];
                    // Test toutes categorie
                    if ($categorie[0] == "null") {
                        $categorie = null;
                    }
                    $allProducts->allProducts($order, $categorie);
                }else{
                    $allProducts->allProducts();
                }
                break;
            case '/productDetail':
                echo "page produits détail";
                break;
            case '/productAjout':
                echo 'page ajout product';
                break;
            case '/panier':
                echo "page panier";
                break;
            case '/inscription':
                echo "page inscription";
                break;
            case '/connexion':
                echo "page de connexion";
                break;
            case '/deconnexion':
                echo "page de deconnexion";
                break;
            case '/profil':
                echo "page de profil";
                break;
            case '/about':
                echo "page à propos";
                break;
            default:
                echo "la page demandée n'existe pas";
                break;
        }

    }
}