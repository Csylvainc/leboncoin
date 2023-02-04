<?php

namespace Models;

use PDO;
use App\Db;


class ProductsModel extends Db{

    // ////////////////////////////////////////// Méthodes de lectures ////////////////////////////////////////////

    // Trouver tous les produits
    public static function findAll(string $order = null, string $limit = null){
        if($order === null){
            $request = "SELECT * FROM products INNER JOIN categories ON  products.idCategorie = categories.idCat " . $limit;
        }else{
            $request = "SELECT * FROM products INNER JOIN categories ON  products.idCategorie = categories.idCat ORDER BY " . $order . " "  . $limit;
        }
       $response = self::getDb()->prepare($request);
       $response->execute();
       
       return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    // Trouver un produit par son id
    public static function findById($id){
        $request = "SELECT * FROM products WHERE id = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($id);

        return $response->fetch(PDO::FETCH_ASSOC);    
    }

    // Trouver les produits d'un utilisateur
    public static function findByUser($idUser){
        $request = "SELECT * FROM products INNER JOIN categories ON  products.idCategorie = categories.idCat WHERE idUser = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($idUser);

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    // Trouver un ou plusieurs produits par catégorie
    public static function findByCat($categorie, $order = null){
        if($order === null){
            $request = "SELECT * FROM products INNER JOIN categories ON  products.idCategorie = categories.idCat WHERE idCategorie = ?";
        }else{
            $request = "SELECT * FROM products INNER JOIN categories ON  products.idCategorie = categories.idCat Where idCategorie = ? ORDER BY " . $order;
        }
       $response = self::getDb()->prepare($request);
       $response->execute($categorie);
       
       return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    // /////////////////////////////////////// Méthodes d'écriture ////////////////////////////////////////////////////////

    // Création d'un produit
    public static function create(array $data){
        // $data est un tableau qui contient les valeurs à insérer en BDD

        // $request = "INSERT INTO products (idCategorie, idUser, name, price, image, description) VALUES (:idCategorie, :idUser, :name, :price, :image, :description)";
        $request = "INSERT INTO products (idCategorie, idUser, name, price, image, description) VALUES (?,?,?,?,?,?)";
        $response = self::getDb()->prepare($request);
        $response->execute($data);

        return self::getDb()->lastInsertId();
    }

    // Modification d'un produit
    public static function update(array $data, int $id){
        $request = "UPDATE products SET idCategorie = ?, idUser = ?, name = ?, price = ?, image = ?, description = ? WHERE id = $id";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
    }



    // /////////////////////////////////// Méthode de suppression ///////////////////////////////////////////////

    public static function delete(array $id){
        $request = "DELETE FROM products WHERE id = ?";
        $response = self::getDb()->prepare($request);
        
        return $response->execute($id);
    }
}

