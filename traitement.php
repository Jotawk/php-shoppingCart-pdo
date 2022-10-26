<?php
session_start();
require_once 'db-functions.php';

if (isset($_GET["action"])) {

	$action = $_GET["action"];
	$id = (isset($_GET["id"])) ? $_GET["id"] : "";
	$price = (isset($_GET["price"])) ? $_GET["price"] : "";
	$name = (isset($_GET["name"])) ? $_GET["name"] : "";
	$qtt = 1;

	switch($action) {
		case "ajouterProduit":
			$product = [
				"name" => $name,
				"price" => $price,
				"qtt" => $qtt,
				"total" => $price * $qtt
			];

			$_SESSION['products'][] = $product;
			header("location:recap.php");
		break;

		case "viderPanier":
			unset($_SESSION["products"]);
			$_SESSION['message'] = "<div class='info-message p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800'>Le panier a été vidé !</div>";
			header("location:recap.php");
		break;
	
		case "supprimerProduit":
			$_SESSION['message'] = "<div class='info-message p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800'>
			Le produit ". $_SESSION["products"][$id]["name"]. " a été supprimé !</div>";
			unset($_SESSION["products"][$id]);
			header("location:recap.php");
		break;
	
		case "diminuerProduit":
			$_SESSION["products"][$id]["qtt"]--;
			$_SESSION["products"][$id]["total"] = $_SESSION["products"][$id]["price"] * $_SESSION["products"][$id]["qtt"];
			if($_SESSION["products"][$id]["qtt"] == 0) {
				unset($_SESSION["products"][$id]);
			}
			header("location:recap.php");
		break;
	
		case "augmenterProduit":
			$_SESSION["products"][$id]["qtt"]++;
			$_SESSION["products"][$id]["total"] = $_SESSION["products"][$id]["price"] * $_SESSION["products"][$id]["qtt"];
			header("location:recap.php");
		break;
	
	}
	
	
	
	
}


