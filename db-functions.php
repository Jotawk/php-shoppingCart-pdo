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
	$requestProducts = connection()->prepare('SELECT name FROM store');
	$requestProducts->execute();
	$recipes = $requestProducts->fetchAll();
	for ($i = 0; $i < count($recipes); $i++) { 
		echo $recipes[$i]['name'];
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