<?php
session_start();

$action = $_GET["action"];
$id = (isset($_GET["id"])) ? $_GET["id"] : "";


switch($action) {
	case "ajouterProduit":
		if (isset($_POST['submit'])) {
			$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
			$price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
		
			if ($name && $price && $qtt) {
		
				$product = [
					"name" => $name,
					"price" => $price,
					"qtt" => $qtt,
					"total" => $price * $qtt
				];
		
				$_SESSION['products'][] = $product;
				$_SESSION['success'] = true;
		
			} else {
				$_SESSION['success'] = null;
				$_SESSION['error'] = true;
			}
			header("location:index.php");	
		}
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




