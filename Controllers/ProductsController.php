<?php

namespace  Controllers;

use Models\CategoriesModel;
use Models\ProductsModel;

class ProductsController extends Controller{
    // Méthode pour afficher les dernier produits mit en ligne sur la vue accueil
    public function accueil(){
        $productsModel = new ProductsModel;
        $products = $productsModel->findAll("id DESC","LIMIT 2");
        // On appel la méthode render()
        $this->render('products/accueil', [
            'title' => 'Bienvenue sur mon coin',
            'products' => $products
        ]);
    }

    // Méthode pour afficher tous les produits sur la vue products
    public function allProducts($order = null, $categorie = null){
        $producstModel = new ProductsModel;
        if ($categorie === null) {
            $products = $producstModel->findAll($order);
        }else{
            $products = $producstModel->findByCat($categorie, $order);
        }

        // Récupération des catégories
        $categoriesModel = new CategoriesModel;
        $categories = $categoriesModel->findAll();

        $this->render('products/allProducts', [
            'title' => 'Tous les produits de mon bon coin',
            'products' => $products,
            'categories' => $categories
        ]);
    }

    // Méthode pour afficher un seul produit
    public function detailProduct($id){
        $id = [$id];
        $productsModel = new ProductsModel;
        $product = $productsModel->findById($id);

        $this->render('products/detailProduct', [
            'title' => 'Détail du produit',
            'product' => $product
        ]);
    }


    // Méthode pour ajouter un produit

    public function ajouter(){
        // récupération de la liste des catégories
        $categories = CategoriesModel::findAll();

        // Traitement du form a faire apres la vue ajout.php
        // On fait les controles
        $msg = '';
        if (!empty($_POST['name']) &&
        !empty($_POST['categorie']) &&
        !empty($_POST['price']) &&
        !empty($_POST['description']) &&
        !empty($_FILES['photo'])
        ) {
            // Si tous les champs sont rempli on vérifie la photo
            var_dump($_POST);
            if(($_FILES['photo']['size'] < 3000000) &&
            ($_FILES['photo']['type'] == 'image/jpeg') ||
            ($_FILES['photo']['type'] == 'image/png')){
                // OK on peut enregistrer
                // Avant d'enregitrer on doit renomer la photo
                $photoName = uniqid() . $_FILES['photo']['name'];
                // on copie la photo sur le serveur
                copy($_FILES['photo']['tmp_name'], "../public/images/products/" . $photoName);
                
                // Sécuriser les données saisies par l'utilisateur
                $name = htmlspecialchars($_POST['name']);
                $categorie = (int)$_POST['categorie'];
                $user = $_SESSION['user']['id'];
                $price = (int)$_POST['price'];
                $description = htmlspecialchars($_POST['description']);
                // On execute la requte d'enregistrement en BDD
                $newProduct = ProductsModel::create([$categorie,$user,$name,$price,$photoName,$description]);
                header('Location: /' . SITEBASE);
            }else{
                $msg = "la photo choisie est trop lourde";
            }
        }else{
            $msg = "merci de remplir tous les champs";
        }

        $this->render('products/ajout', [
            'title' => 'Ajouter un nouveau produit',
            'message' => $msg,
            'categories' => $categories
        ]);
    }


    // Méthode demodification de produit
    public function modifier(int $id){
        // récupération de la liste des catégories
        $categories = CategoriesModel::findAll();
        // On recupère le produit
        $product = ProductsModel::findById([$id]);
        // On vérifi que le userId soit le même que celui de l'utilisateur connceté ou que l'utilisateur soit admin
        if(($_SESSION['user']['role'] == 1) || ($product['idUser'] == $_SESSION['user']['id'])){
            // Traitement du formulaire
            $msg = "";
            if (!empty($_POST['name']) &&
                !empty($_POST['categorie']) &&
                !empty($_POST['price']) &&
                !empty($_POST['description'])
            ){
                // Controle sur la photo si elle est modifiée
                if(!empty($_FILES['photo']['name'])){
                    if(($_FILES['photo']['size'] < 3000000) &&
                    ($_FILES['photo']['type'] == 'image/jpeg') ||
                    ($_FILES['photo']['type'] == 'image/png')){
                        
                        // Avant d'enregitrer on doit renomer la photo
                        $photoName = uniqid() . $_FILES['photo']['name'];
                        // on copie la photo sur le serveur
                        copy($_FILES['photo']['tmp_name'], "../public/images/products/" . $photoName);
                    }else{
                        $msg = "la photo choisie est trop lourde";
                        exit();
                    }
                }
                // On sécurise les saisies
                $name = htmlspecialchars($_POST['name']);
                $categorie = (int)$_POST['categorie'];
                $user = $_SESSION['user']['id'];
                $price = (int)$_POST['price'];
                $description = htmlspecialchars($_POST['description']);
                // On crée le tableau a envoyer à la requete
                if (isset($photoName)) {
                    $data = [$categorie,$user,$name,$price,$photoName,$description];
                }else{
                    $data = [$categorie,$user,$name,$price,$product['image'],$description];
                }
                // On execute la requete update
                $updateProduct = ProductsModel::update($data, $id);
                header('Location: profil');

            }elseif(!empty($_POST)){
                $msg = 'merci de remplir tous les champs';
            } 

        }else{
            // Pas connecte ou mauvais user
            header('Location: /' .SITEBASE);
        }

        $this->render('products/modifier', [
            'title' => 'Modifier le produit',
            'product' => $product,
            'categories' => $categories,
            'message' => $msg
        ]);

    }

    // Méthode de suppression de produit
    public function supprimer($id){
        ProductsModel::delete([$id]);
        header('Location: profil');
        $_SESSION['messages'] = 'produit supprimé';
    }
} 