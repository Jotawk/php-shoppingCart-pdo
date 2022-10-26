<?php

function connection() {
	try {
		$pdo = new \PDO(
			'mysql:dbname=shopping-cart;host=127.0.0.1',
			'root',
			'',
			[
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
				\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			]

			);
		return $pdo;
	} catch (Exception $e) {	
        die('Erreur : ' . $e->getMessage());
	}
}

function findAll() { 
	$requestProducts = connection()->prepare('SELECT * FROM store');
	$requestProducts->execute();
	$recipes = $requestProducts->fetchAll();
	for ($i = 0; $i < count($recipes); $i++) { 
		$id = $recipes[$i]["id"];
		echo "<h2><a href='./product.php?id={$id}'>".$recipes[$i]['name']."</a></h2>";
		if ($_SERVER['REQUEST_URI'] == '/index.php' || '/') { // vérifie cette condition uniquement quand on est sur l'index.php
		echo substr($recipes[$i]['description'], 0, 50);
		echo mb_strlen($recipes[$i]['description']) > 50 ? "...<br><br>" : "<br><br>";
		} else {
			echo $recipes[$i]['description'];
		}
		echo "<strong>".number_format($recipes[$i]['price'], 2, ',', ' ')." €</strong><br><br>";
		echo "<a href='./traitement.php?action=ajouterProduit&id=$id'>Ajouter au panier</a>";
	}
}

function findOneById($id) {
	$requestProduct = connection()->prepare("SELECT * FROM store WHERE id=:id");
	$requestProduct->execute(
		[":id" => $id]
	);
	$product = $requestProduct->fetch();
	echo "<a href='./index.php'>Retour</a><h2>".$product['name']."</h2>";
	echo $product['description']."<br><br>";
	echo "<strong>".number_format($product['price'], 2, ',', ' '). "€</strong>";
}

function insertProduct($name, $descr, $price) {
	$insertProduct = connection()->prepare("INSERT INTO store (name, description, price) VALUES (:name, :description, :price)");
	$insertProduct->execute(
		[
			":name" => $name,
			":description" => $descr,
			":price" => $price
		]
	);
}