<!doctype html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../res/img/icon.ico">

		<title>Vinelly - Home</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/common.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/carousel.css" rel="stylesheet">
	</head>
	<body>
		<!-- HEADER -->
		<?php
			include "session.php";
			include "header.php";
		?>
		<main role="main">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<?php if($_SESSION['logged'] != 'true') {?>
					<div class="carousel-item active">
						<img class="first-slide" src="../res/img/join_us.png" alt="First slide">
						<div class="container">
							<div class="carousel-caption text-left">
								<h1 style="font-size: 4rem; -webkit-text-stroke: 1px black;">Unisciti a noi</h1>
								<p><a class="btn btn-lg btn-primary" href="login.php" role="button">Effettua il login</a></p>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="carousel-item active">
						<img class="first-slide" src="../res/img/profile.png" alt="First slide">
						<div class="container">
							<div class="carousel-caption text-left">
								<h1 style="font-size: 4rem; -webkit-text-stroke: 1px black;">Profilo personale</h1>
								<p><a class="btn btn-lg btn-primary" href="login.php" role="button">Profilo</a></p>
							</div>
						</div>
					</div>
				<?php } ?>
					<div class="carousel-item">
						<img class="second-slide" src="../res/img/products.png" alt="Second slide">
						<div class="container">
							<div class="carousel-caption">
								<h1 style="font-size: 4rem; -webkit-text-stroke: 1px black;">Le nostre eccellenze</h1>
								<p><a class="btn btn-lg btn-primary" href="album.php" role="button">Scopri i prodotti</a></p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<img class="third-slide" src="../res/img/team.png" alt="Third slide">
						<div class="container">
							<div class="carousel-caption text-right">
								<h1 style="font-size: 4rem; -webkit-text-stroke: 1px black;">Professionalità, efficienza, competenza</h1>
								<p><a class="btn btn-lg btn-primary" href="about.php" role="button">Conosci chi siamo</a></p>
							</div>
						</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Precedente</span>
				</a>
				<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Prossimo</span>
				</a>
			</div>


			<!-- Marketing messaging and featurettes
			================================================== -->
			<!-- Wrap the rest of the page in another container to center all the content. -->

			<div class="container marketing">
				<!-- Three columns of text below the carousel -->
				<div class="row">
					<div class="col-lg-3">
						<a href="gallery.php?type=bianco">
							<img class="rounded-circle" src="../res/img/bianchi_small.png" alt="Generic placeholder image" width="140" height="140">
						</a>
						<h2>Bianchi</h2>
						<p>Il vino bianco viene prodotto con diverse tecniche che lavorano l'acino proveniente prevalentemente da vitigni di colore verde o giallo, in modo da ottenere il solo succo ed eliminare quindi le bucce.</p>
						<p><a class="btn btn-secondary bg-purple" href="gallery.php?type=bianco" role="button">Dettagli &raquo;</a></p>
					</div><!-- /.col-lg-3 -->
					<div class="col-lg-3">
						<a href="gallery.php?type=rosso">
						<img class="rounded-circle" src="../res/img/rossi_small.png" alt="Generic placeholder image" width="140" height="140">
						</a>
						<h2>Rossi</h2>
						<p>Il vino rosso si presenta all'aspetto di colore rosso in varie tonalità, e viene prodotto dal mosto fatto macerare sulle bucce, così da estrarre polifenoli e le sostanze coloranti presenti su di esse.</p>
						<p><a class="btn btn-secondary bg-purple" href="gallery.php?type=rosso" role="button">Dettagli &raquo;</a></p>
					</div><!-- /.col-lg-3 -->
					<div class="col-lg-3">
						<a href="gallery.php?type=rosato">
							<img class="rounded-circle" src="../res/img/rosè_small.png" alt="Generic placeholder image" width="140" height="140">
						</a>
						<h2>Rosati</h2>
						<p>Il vino rosato si produce utilizzando uve rosse lavorate in modo da ottenere succo a veloce contatto con le bucce, da 2 ore fino massimo 36 circa. In questo modo le bucce cedono solo parte del colore al mosto.</p>
						<p><a class="btn btn-secondary bg-purple" href="gallery.php?type=rosato" role="button">Dettagli &raquo;</a></p>
					</div><!-- /.col-lg-3 -->
					<div class="col-lg-3">
						<a href="gallery.php?type=spumante">
							<img class="rounded-circle" src="../res/img/frizzanti_small.png" alt="Generic placeholder image" width="140" height="140">
						</a>
						<h2>Spumanti</h2>
						<p>È un vino che presenta una moderata effervescenza dovuta alla presenza di anidride carbonica con una sovrappressione compresa, a temperatura ambiente, tra 1 e 2,5 bar.</p>
						<p><a class="btn btn-secondary bg-purple" href="gallery.php?type=spumante" role="button">Dettagli &raquo;</a></p>
					</div><!-- /.col-lg-3 -->
				</div><!-- /.row -->

				<!-- START THE FEATURETTES -->
				<hr class="featurette-divider">
				<div class="row featurette">
					<div class="col-md-7 mt-auto mb-auto">
						<h2 class="featurette-heading">Il lavoro rende i giorni prosperi, <span class="text-muted">il vino le domeniche felici.</span></h2>
						<p class="lead text-purple">Charles Pierre Baudelaire</p>
					</div>
					<div class="col-md-5">
						<img class="featurette-image img-fluid mx-auto" src="../res/img/grape.png" alt="Generic placeholder image">
					</div>
				</div>
				<hr class="featurette-divider">

				<!-- /END THE FEATURETTES -->

			</div><!-- /.container -->

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
