<?php

namespace  Controllers;

use Models\CategoriesModel;
use Models\ProductsModel;

class ProductsController extends Controller{
    // Méthode pour afficher les dernier produits mit en ligne sur la vue accueil
    public function accueil($order = null){
        $productsModel = new ProductsModel;
        $products = $productsModel->findAll(limit: "LIMIT 2");
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
}