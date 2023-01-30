<?php

use Models\CategoriesModel;
use Models\ProductsModel;
use Models\UsersModel;

require_once('autoload.php');

// Test findAll categorie
$test = ProductsModel::findAll(null, " LIMIT 3");
var_dump($test);

// Test findById 
// Attend un tableau
$id = [3];
$test2 = ProductsModel::findById($id);
var_dump($test2);


// Test findBy catégorie
// Attend un tableau
$cat = [2];
$test3 = ProductsModel::findByCat($cat);
var_dump($test3);


// Test création d'un nouveau produit
// $newProdVal = [2,1,'3008',26000.20,'3008.jpg','super 3008 rouge'];
// $testNew = ProductsModel::create($newProdVal);

// Test Update d'un produit
// $update = [2,1,'3008', 24500, '3008.jpg', 'super 3008rouge'];
// $testUpdate = ProductsModel::update($update,5);


// Test suppression d'un proudit
// $id = [5];
// $testDelete = ProductsModel::delete($id);

// test user update Admin hashage du password
$pass = password_hash("1234", PASSWORD_DEFAULT);
// $upAdmin = ['admin@admin.fr',$pass, "administrateur"];
// $up = UsersModel::update($upAdmin,1);

// test new user
// $newUserData = ['sylvain@gmail.com',$pass,"sylvain"];
// $newUser = UsersModel::create($newUserData);


// Test categories

// $newCatData = ["Jardin"];
// $newCat = CategoriesModel::create($newCatData);
