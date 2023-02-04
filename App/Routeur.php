<?php
namespace App;

use Controllers\Controller;
use Controllers\ProductsController;
use Controllers\UsersController;
use Models\CategoriesModel;
use Models\ProductsModel;

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
                // echo "page produits détail";
                $oneProduct = new ProductsController;
                if (isset($_GET['id'])) {
                    $id =(int)$_GET['id'];
                    $oneProduct->detailProduct($id);
                }
                break;
            case '/productAjout':
                // echo 'page ajout product';
                if (isset($_SESSION['user']['id'])) {
                   $ajoutProduct = new ProductsController;
                   $ajoutProduct->ajouter();
                }else{
                    header('Location: /' . SITEBASE);
                }
                break;
            case '/productModif':
                // echo 'page modif produit';
                if (isset($_SESSION['user']['id'])) {
                    $ajoutProduct = new ProductsController;
                    $id = $_GET['id'];
                    $ajoutProduct->modifier($id);
                 }else{
                     header('Location: /' . SITEBASE);
                 }
                break;
            case '/productSupp':
                if (isset($_SESSION['user']['id'])) {
                    $ajoutProduct = new ProductsController;
                    $id = $_GET['id'];
                    $ajoutProduct->supprimer($id);
                 }else{
                     header('Location: /' . SITEBASE);
                 }
                break;
            case '/panier':
                echo "page panier";
                break;
            case '/inscription':
                // echo "page inscription";
                $inscription = new UsersController;
                $inscription->inscription();
                break;
            case '/connexion':
                // echo "page de connexion";
                $connexion = new UsersController;
                $connexion->connexion();
                break;
            case '/deconnexion':
                // echo "page de deconnexion";
                // Pour deconnecter un utilisateur il suffit de supprimer user de la session
                unset($_SESSION['user']);
                // On redirige vers la page d'accueil
                $_SESSION['messages'] = "A bientôt";
                header('Location: /' . SITEBASE);
                break;
            case '/profil':
                // echo "page de profil";
                if (isset($_SESSION['user'])) {
                    $profil = new UsersController;
                    $profil->profil();
                }else{
                    header('Location: connexion');
                }
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