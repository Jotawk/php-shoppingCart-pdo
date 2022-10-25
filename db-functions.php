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
		echo "<h2><a href='#'>".$recipes[$i]['name']."</a></h2>";
		echo substr($recipes[$i]['description'], 0, 50);
		if($_SERVER['REQUEST_URI'] == '/') { // vérifie cette condition uniquement sur l'index
		echo mb_strlen($recipes[$i]['description']) > 50 ? "...<br><br>" : "<br><br>";
		}
		echo "<strong>".number_format($recipes[$i]['price'], 2, ',', ' ')." €</strong><br><br>";
		echo "<a href='#'>Ajouter au panier</a>";
	}
}

function findOneById($id) {
	$requestProduct = connection()->prepare("SELECT * FROM store WHERE id=:id");
	$requestProduct->execute(
		[":id" => $id]
	);
	$product = $requestProduct->fetch();
	return $product;
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