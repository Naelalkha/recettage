		<!DOCTYPE html>
		<html lang="fr">
		<head>

			<title>Outil recettage</title>
			<link rel="stylesheet" href="css/style.css">
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

			<!-- Optional theme -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		
			<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>




		</head>
<body>
		<?php include ("db.php"); ?>
	<form method="post" action="ajout_film.php">
					<input type="text" name="titre" required>Titre</input>
             <input type="textarea" name="synopsis">Synopsis</input>
             	<h4>Réalisateur:</h4>
 	<?php $response = $db -> query("SELECT id, nom, prenom FROM realisateurs"); ?>
 	<select class="form-control" name="realisateur" >
 		<?php 
 			while ($data = $response ->fetch()) { ?>
				<option value=" <?php echo $data["id"]; ?> ">
					<?php echo $data["nom"]." ".$data["prenom"]; ?>
				</option>
 			<?php 	
 			}
 		 ?>
 	</select> <?php $response -> closeCursor(); ?> <br>
 	<input type="submit" value="Envoyer">
						<?php 
						

 if (isset($_POST["titre"]) && isset($_POST["synopsis"])) {
 	$titre = htmlspecialchars($_POST["titre"]);
 	$synopsis = htmlspecialchars($_POST["synopsis"]);
 	$realisateur = htmlspecialchars($_POST["realisateur"]);


 	$response = $db -> prepare("INSERT INTO films (titre,synopsis, date_ajout, id_realisateur) VALUES (:titre, :synopsis, NOW(), :id_realisateur) ");
 	$response -> execute(
 			array(
 				'titre' => $titre,
 				'synopsis' => $synopsis,
 				'id_realisateur' => $realisateur
 				)
 		);

 	$response -> closeCursor();
 }

	?>
</body>
							</html>