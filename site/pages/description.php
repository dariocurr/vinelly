<!doctype html>

<?php
	include "session.php";
	$query = "SELECT * FROM vini WHERE id = ".$_GET['id'];
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
	$percorsoImmagine = "../res/img/wine/".$row['tipologia']."/".$row['img'];
	$i = 1;
	if(isset($_POST['submit'])) {
		if($_SESSION['logged'] == 'true') {
			$quantita = $_POST['quantita'];

			$query = "SELECT id FROM clienti WHERE username = '".$_SESSION['user']."'";
			$result = mysqli_query($db, $query);
			$user = mysqli_fetch_assoc($result);
			$userID = $user['id'];

			$queryCarrello = "SELECT id FROM carrello WHERE id_cliente = ".$userID;
			$resultCarrello = mysqli_query($db, $queryCarrello);
			$carrello = mysqli_fetch_assoc($resultCarrello);
			$carrelloID = $carrello['id'];
			
			//parte utile se il vino era già presente nel carrello
			$queryDelete = "DELETE FROM carrello_vini WHERE id_carrello = ".$carrelloID." AND id_vino = ".$_GET['id'];
			mysqli_query($db, $queryDelete);
			
			$queryInsert = "INSERT INTO carrello_vini (id_carrello, id_vino, quantita) VALUES (".$carrelloID.",".$_GET['id'].",".$quantita.")";
			mysqli_query($db, $queryInsert);
			header("location: cart.php");
		} else {
			header("location: login.php?id=".$_GET['id']);
		}

	}
?>

<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../res/img/logo.ico">

    <title>Vinelly - Descrizione vino</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/common.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/carousel.css" rel="stylesheet">
  </head>
  <body>

	<!-- HEADER -->
		<?php
			include "header.php";
		?>

    <main role="main">

      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

        <!-- START THE FEATURETTES -->


        <div class="row featurette" style="margin-top: 10rem">
          <div class="col-md-7">
            <h2 class="text-purple"><b><?php echo $row['cantina']?></b></h2>
			<h4 class="text-dark"><?php echo $row['nome']?></h4>
            <p class="lead"><?php echo $row['descrizione']?></p>
			<div class="row ml-3">
				<i class="fa fa-lg fa-globe mt-2 mr-2"></i>
				<p class="lead "><?php echo $row['regione']?></p>
			</div>
			<div style="position: relative; right: 0.2rem" class="row ml-3">
				<i class="fa fa-lg fa-glass mt-2 mr-2"></i>
				<p class="lead "><p class="lead"><?php echo $row['gradi']?>%</p>
			</div>
			<div class="row ml-3">
				<i style="position: relative; left: 0.1rem" class="fa fa-lg fa-euro mt-2 mr-2"></i>
				<p class="lead ml-1"><?php echo $row['prezzo']?></p>
			</div>
			<form class="text-center mt-4 mb-4" method="post" action="">
				<button type="submit" name="submit" class="btn btn-sm btn-primary mr-5 featurette-heading-small">Acquista</button>
				<select name="quantita" class="custom-select move-to-left-1 mb-1 mt-1" style="width: 12%; height: 3rem" size="1">
					<?php
						while($i <= $row['quantita']) {
							echo "<option>$i</option>";
							$i++;
						}
					?>
				</select>
				<?php if($_GET['add'] == 1) { ?>
					<h6 style="position: relative; right: 1rem" class="text-purple text-center mt-3">Aggiunto al carrello</h6>
				<?php } ?>
			</form>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="<?php echo $percorsoImmagine ?>" alt="Generic placeholder image">
          </div>
		  <div class="row-description move-description">
		  </div>
        </div>


        <!-- /END THE FEATURETTES -->



      </div><!-- /.container -->


      <!-- FOOTER -->
		<?php
				include "footer.php";
		?>
    </main>

    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Bootstrap core JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>
  </body>
</html>
