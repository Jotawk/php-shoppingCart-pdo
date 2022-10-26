<?php
require_once 'db-functions.php';

$recipes = findAll();
foreach ($recipes as $product) {
    $id = $product["id"];
    $price = $product["price"];
    $name = $product["name"];
    echo "<h2><a href='./product.php?id={$id}'>".$product['name']."</a></h2>";
    if ($_SERVER['REQUEST_URI'] == '/index.php' || '/') { // vérifie cette condition uniquement quand on est sur l'index.php
    echo substr($product['description'], 0, 50);
    echo mb_strlen($product['description']) > 50 ? "...<br><br>" : "<br><br>";
    } else {
        echo $product['description'];
    }
    echo "<strong>".number_format($product['price'], 2, ',', ' ')." €</strong><br><br>";
    echo "<a href='./traitement.php?action=ajouterProduit&id=$id&name=$name&price=$price'>Ajouter au panier</a>";
} 
   