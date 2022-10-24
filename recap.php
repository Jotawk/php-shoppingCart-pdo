<?php
session_start();
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Récapitulatif des produits</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<?php
	require 'menu.php';
	require 'functions.php';
	echo showMessage();
	
	if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
		echo "<p class='mt-8'>Aucun produit en session...</p>";
	} else {
		echo
			"<div class='grid place-items-center h-screen'>",
				"<div>",
				"<table class='table-auto border-spacing-3 border border-slate-400 text-center'>",
					"<thead>",
						"<tr>",
							"<th class='border-slate-300'>#</th>",
							"<th class='border border-slate-300 bg-slate-300 p-4'>Nom</th>",
							"<th class='border border-slate-300 bg-slate-300 p-3'>Prix</th>",
							"<th class='border border-slate-300 bg-slate-300 p-3'>Quantité</th>",
							"<th class='border border-slate-300 bg-slate-300 p-3'>Total</th>",
							"<th class='border border-slate-300 bg-slate-600 p-3 text-white'>Modifier</th>",
							"<th class='border border-slate-300 bg-slate-600 p-3 text-white'>Supprimer</th>",
						"</tr>",
					"</thead>",
					"<tbody>",
				"</div>";

			$totalGeneral = 0;
			$qttTotal = 0;

			foreach ($_SESSION['products'] as $index => $product) {
				echo
					"<tr>",
						"<td class='border-slate-300 p-4'>".$index."</td>",
						"<td class='border border-slate-300'>".$product['name']."</td>",	
						"<td class='border border-slate-300'>". number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>",	
						"<td class='border border-slate-300'>".$product['qtt']."</td>",	
						"<td class='border border-slate-300'>". number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
						"<td class='border border-slate-300'><a href='traitement.php?action=augmenterProduit&id=$index'><i class='cursor-pointer fa-solid fa-plus text-sm'></i></a>&nbsp;&nbsp;<a href='traitement.php?action=diminuerProduit&id=$index'><i class='cursor-pointer fa-solid fa-minus text-sm'></i></a></td>",
						"<td class='border border-slate-300'><a href='traitement.php?action=supprimerProduit&id=$index'><i class='cursor-pointer fa-solid fa-xmark text-red-600'></i></a></td>",
					"</tr>";	

				$totalGeneral += $product['total'];
				$qttTotal += $product['qtt'];
				$_SESSION['qttTotal'] = $qttTotal;
				}
				echo
					"<tr>",
						"<td colspan=4 class='border border-slate-300 bg-slate-500 p-4 font-bold'>Total général : </td>",
						"<td><strong class='border-slate-300 p-3'>". number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</td>",
					"</tr>",
					"</tbody>",
				"</table>";
			"</div>";

			if($_SESSION['qttTotal'] === 1) {
				echo "<p class='mt-4'>{$_SESSION['qttTotal']} produit présent en session</p>";
			} else if ($_SESSION['qttTotal']) { 
				echo "<p class='mt-4'>{$_SESSION['qttTotal']} produits présents en session</p>";  
			} 
		}
		?>

		<div class="flex flex-col">
			<div class="mt-4">
			<a href="./index.php" class="text-white bg-slate-900 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="fa-solid fa-left-long"></i>&ensp; Retourner à l'index</a>
			</div>
			
			<div class="mt-5">
			<a class="cursor-pointer p-2.5 text-sm text-white font-medium bg-red-500 rounded-lg dark:bg-red-400" href="traitement.php?action=viderPanier">
				<lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="loop" style="width:24px;height:auto"></lord-icon>
			Vider le panier</a>
			</div>
		</div>

	<script src="./script.js"></script>
</body>

</html>