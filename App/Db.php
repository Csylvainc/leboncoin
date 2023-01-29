<?php

namespace App;

class Db{
    private static $db;

    static function getDb(){
        if(!self::$db){
            try {
                $config = file_get_contents('App\config.json');
                $config = json_decode($config);
                self::$db = new \PDO("mysql:host=" . $config->host . ";dbname=" . $config->dbname, $config->user, $config->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            } catch (\PDOException $e) {
               echo 'erreur : ' . $e->getMessage();
            }
        }
        return self::$db;
    }
}


// Pour tester l'accée au fichier json

// $config = file_get_contents('App\config.json');
// $config = json_decode($config);
// var_dump($config);
// echo $config->dbname;


// Pour test la connexion

// $test = new Db;
// var_dump($test);
// var_dump(get_class_methods($test));
// // echo $test::getDb();
// var_dump($test::getDb());


// Note pour moi attention au chemin du fichier json 
// Pour le test d'ici mettre juste config.json
