<?php

function connexion() {
	try {
		$pdo = new \PDO(
			'mysql:dbname=shopping-cart;host=127.0.0.1',
			'root',
			'root',
			[
				\PDO::ATTR__ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
				\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			]
		
		);
	} catch (Exception $e) {	
        die('Erreur : ' . $e->getMessage());
	}
}

