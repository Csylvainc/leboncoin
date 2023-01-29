<?php

namespace Models;

use PDO;
use App\Db;

class UsersModel extends Db{
    // ////////////////////////////////////////// Méthodes de lectures ////////////////////////////////////////////

    // Trouver tous les utlisateurs
    public static function findAll(){
        $request = "SELECT * FROM users";
        $response = self::getDb()->prepare($request);
        $response->execute();
       
       return $response->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Trouver un utilisateur par id
    public static function findById(array $id){
        $request = "SELECT * FROM users WHERE id = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($id);

        return $response->fetch(PDO::FETCH_ASSOC);    
    }

    // Trouver un utilisateur par login
    public static function findByLogin(array $login){
        $request = "SELECT * FROM users WHERE login = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($login);

        return $response->fetch(PDO::FETCH_ASSOC);    
    }


    // /////////////////////////////////////// Méthodes d'écriture /////////////////////////////////////////////////////////

    // Créer un nouvel utilisateur
    public static function create(array $data){
        $request = "INSERT INTO users (login, password, firstName) VALUES (?, ?, ?)";
        $response = self::getDb()->prepare($request);
        $response->execute($data);

        return self::getDb()->lastInsertId();
    }

    // Modification d'un utilisateur
    public static function update(array $data, int $id){
        $request = "UPDATE users SET login = ?, password = ?, firstName = ? WHERE id = $id";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
    }

    // /////////////////////////////////////// Méthode de suppression /////////////////////////////////////////////////////////

}