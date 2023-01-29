<?php

use Models\ProductsModel;

require_once('autoload.php');

// Test findAll categorie
$test = ProductsModel::findAll("price ASC");
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