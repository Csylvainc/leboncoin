<?php

namespace Controllers;

class PanierController extends Controller{

    // Méthode d'affichage du panier
    public function afficher(){
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
            $panier = $_SESSION['panier'];
            $this->render('panier', [
                'title' => 'Contenu de votre panier',
                'panier' => $panier
            ]);
        }else{
            $this->render('panier', [
                'title' => 'Votre panier est vide'
            ]);
        }
    }
    // Méhtode d'ajout au panier
    public function ajouter($id,$name,$price,$photo){
        // Si le panier n'existe pas on le crée
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
        // On crée un tableau $panier
        $panier = $_SESSION['panier'];
        // On crée un tableau associatif dans $panier
        $panier[] = ['id' => $id, 'name' => $name, 'price' => $price, 'photo' => $photo];
        // On ajoute la ligne dans la session
        $_SESSION['panier'] = $panier;

        // On redirige vers les produits
        $_SESSION['messages'] = "produit ajouté au panier";
        header('Location: /' . SITEBASE);
    }


    // Méthode de suppression d'un produit
    
    public function supprimer($id){
        unset($_SESSION['panier'][$id]);
        $panier = $_SESSION['panier'];

        header('Location: panier?opp=affiche');
    
    }



    
}