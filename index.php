<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Exercice superglobales</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

	<?php 
	
	if (isset($_SESSION['success'])) {
		$product = $_SESSION["products"];
		$lastProduct = $product[array_key_last($product)]["name"];
		
		echo "
			<div class='info-message p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800'>
			<p>Votre produit " . $lastProduct . " a été ajouté avec succès</p>
			</div>";


	} else if (isset($_SESSION['error'])) {
		echo "
			<div class='info-message p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800'>
			<p>Il semblerait qu'il y ait une erreur. Merci de remplir correctement le formulaire</p>
			</div>";
	} 

	?>
	
	<form action="traitement.php?action=ajouterProduit" method="post">
		<div class="grid place-items-center h-screen">
			<div class="border-solid border-2 border-slate-900 rounded-lg p-8">	
			<h1 class="text-4xl mb-8">Ajouter un produit :</h1>
				<p>
					<label>
						Nom du produit :
						<input type="text" name="name" class="border-2 border-slate-900 p-1 mb-6">
					</label>
				</p>
				<p>
					<label>
						Prix du produit :
						<input type="number" step="1" name="price" class="border-2 border-slate-900 p-1 mb-6">
					</label>
				</p>	
				<p>
					<label>
						Quantité désirée :
						<input type="number" name="qtt" value="1" min="0" class="border-2 border-slate-900 p-1 mb-6">
					</label>
				</p>

				<p class='mt-1'>Il y a 
				<?php if(isset($_SESSION["products"])) {
						echo count($_SESSION["products"]) . " produits dans le panier</p>";	
					} else {
						echo " 0 produit";
					}
				?>
				<div class='cursor-pointer text-white bg-blue-700 hover:bg-emerald-800 font-medium rounded-lg text-sm py-2.5 text-center dark:bg-blue-500 dark:hover:emerald-700 dark:focus:ring-blue-800 mt-5 w-48 pl-0'>
					<i class="fa-solid fa-basket-shopping"></i><span>&ensp;</span><input class='cursor-pointer' type="submit" name="submit" value="Ajouter le produit" >
				</div>
		
				<div class="mt-6">
				<a href="./recap.php" class="text-white bg-slate-900 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="fa-solid fa-arrow-right"></i><span>&ensp;</span>Afficher le récapitulatif</a>
				</div>
			</div>
		</div>
	</form>
	
	<script src="./script.js"></script>
</body>

</html>