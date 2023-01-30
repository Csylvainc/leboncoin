<?php

namespace Models;

use PDO;
use App\Db;

class CategoriesModel extends Db{
     // ////////////////////////////////////////// Méthodes de lectures ////////////////////////////////////////////

    // Trouver toutes les catégories
    public static function findAll(){
        $request = "SELECT * FROM categories";
        $response = self::getDb()->prepare($request);
        $response->execute();
       
       return $response->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Trouver une catégories par id
    public static function findById(array $id){
        $request = "SELECT * FROM categories WHERE idCat = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($id);

        return $response->fetch(PDO::FETCH_ASSOC);    
    }

    // Trouver une catégorie par nom
    public static function findByName(array $name){
        $request = "SELECT * FROM categories WHERE nameCat = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($name);

        return $response->fetch(PDO::FETCH_ASSOC);    
    }


    // /////////////////////////////////////// Méthodes d'écriture /////////////////////////////////////////////////////////

    // Créer un nouvel utilisateur
    public static function create(array $data){
        $request = "INSERT INTO categories (nameCat) VALUES (?)";
        $response = self::getDb()->prepare($request);
        $response->execute($data);

        return self::getDb()->lastInsertId();
    }

    // Modification d'un utilisateur
    public static function update(array $data, int $id){
        $request = "UPDATE categories SET nameCat = ? WHERE idCat = $id";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
    }

    // /////////////////////////////////////// Méthode de suppression /////////////////////////////////////////////////////////

    public static function delete(array $id){
        $request = "DELETE FROM categories WHERE idCat = ?";
        $response = self::getDb()->prepare($request);
        
        return $response->execute($id);
    }
}