<!doctype html>

<?php
	include "session.php";
	$query = "SELECT * FROM vini WHERE tipologia = '".$_GET['type']."'";
	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
	$i = 0;
?>

<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../res/img/icon.ico">

		<title>Vinelly - Scegli il tuo vino</title>

		<!-- Bootstrap core CSS -->
		<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />

		<!-- Custom styles for this template -->
		<link href="../css/gallery.css" rel="stylesheet">
	</head>
	<body>
		<!-- HEADER -->
		<?php
			include "header.php";
		?>

		<main role="main">

			<section class="jumbotron text-center">
				<div class="container">
					<h1 class="jumbotron-heading">“Il vino aggiunge un sorriso all’amicizia ed una scintilla all’amore.”</h1>
					<p class="lead text-purple">Edmondo De Amicis</p>
				</div>
			</section>

			<div class="album py-5 bg-light">
				<div class="container">
					<div class="row">
						<?php
							while($i < $count) {
								$row = mysqli_fetch_assoc($result);
								if($row['quantita'] > 0) {
						?>
								<div class="col-md-4">
									<div class="card mb-4 shadow-sm">
										<?php
											$percorsoImmagine = "../res/img/wine/".$_GET['type']."/".$row['img'];
											$linkDescrizione = "description.php?id=".$row['id'];
										?>
										<a href="<?php echo $linkDescrizione ?>">
											<img class="card-img-top" src="<?php echo $percorsoImmagine ?>" alt="Card image cap">
										</a>
										<div class="card-body">
											<div class="card-text">
												<b class="text-purple"><?php echo $row['cantina']." - ".$row['nome']?></b>
											</div>
											<div class="d-flex justify-content-between align-items-center">
												<p class="mt-1"><?php echo $row['prezzo'] ?> €</p>
												<a class="mt-1" href="<?php echo $linkDescrizione ?>">
													<p><button type="button" class="btn btn-sm btn-outline-secondary">Acquista</button></p>
												</a>
											</div>
										</div>
									</div>
								</div>
						<?php
								}
								$i++;
							}
						?>
					</div>
				</div>
			</div>
		</main>

		<!-- FOOTER -->
		<?php
				include "footer.php";
		?>

	<!-- Placed at the end of the document so the pages load faster -->
    <!-- Bootstrap core JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>
	</body>
</html>
