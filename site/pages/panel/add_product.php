<!doctype html>

<?php
	include "session.php";
	if(isset($_POST['submit'])) {
		$cantina = mysqli_real_escape_string($db, $_POST['cantina']);
		$nome = mysqli_real_escape_string($db, $_POST['nome']);
		$query1 = "SELECT * FROM vini WHERE cantina = '$cantina' AND nome = '$nome'";
		$result1 = mysqli_query($db, $query1);
		$count = mysqli_num_rows($result1);
		$quantita = mysqli_real_escape_string($db, $_POST['quantita']);
		if($count == 0) {
			$regione = mysqli_real_escape_string($db, $_POST['regione']);
			$gradi = mysqli_real_escape_string($db, $_POST['gradi']);
			$tipologia = mysqli_real_escape_string($db, $_POST['tipologia']);
			$prezzo = mysqli_real_escape_string($db, $_POST['prezzo']);
			$descrizione = mysqli_real_escape_string($db, $_POST['descrizione']);
			if(!empty($regione) && !empty($gradi) && !empty($tipologia) && !empty($prezzo) && !empty($descrizione)) {
				if(isset($_FILES['immagine']) && strlen($_FILES['immagine']['name']) > 1) {
					$nomeImmagine = $_FILES['immagine']['name'];
					list($width, $height) = getimagesize($_FILES['immagine']['tmp_name']);
					$estensioneImmagine = $_FILES['immagine']['type'];
					if($width == 500 && $height == 500 && $estensioneImmagine == 'image/jpeg') {
						$percorsoImmagine = "../../res/img/wine/".$tipologia."/".$nomeImmagine;
						if(move_uploaded_file($_FILES['immagine']['tmp_name'], $percorsoImmagine)) {
							$query2 = "INSERT INTO vini (cantina, nome, regione, gradi, tipologia, prezzo, descrizione, quantita, img) 
										VALUES ('$cantina', '$nome', '$regione', $gradi, '$tipologia', $prezzo, '$descrizione', $quantita, '$nomeImmagine')";
							$result2 =	mysqli_query($db, $query2);
							if($result2) {
								header("location: add_product.php?upload=1");
							} else {
								header("location: add_product.php?error=5");
							}
						} else {
							header("location: add_product.php?error=4");
						}
					} else {
						header("location: add_product.php?error=3");
					}	
				} else {
					header("location: add_product.php?error=2");
				}
			} else {
				header("location: add_product.php?error=1");
			}
		} else {
			$row = mysqli_fetch_array($result1,MYSQLI_ASSOC);
			$nuovaQuantita = $row['quantita'] + $quantita;
			$id = $row['id'];
			$query2 = "UPDATE vini SET quantita = $nuovaQuantita WHERE id = $id";
			mysqli_query($db, $query2);
			header("location: add_product.php?add=".$quantita);
		}	
	}
?>

<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../res/img/logo.ico">

    <title>Pannello amministratore - Aggiungi prodotto</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/common.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/panel.css" rel="stylesheet">
  </head>

  <body>

	<?php
		include "panel_header.php";
	?>

    <div class="container-fluid">
      <div class="row">
        <?php
			include "panel_sidebar.php";
		?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		  <form class="form-signin text-center" method="post" action="" enctype="multipart/form-data">
			<h1 class="h3 mb-4 font-weight-normal">Aggiungi un prodotto</h1>
			<input type="text" id="inputCantina" name="cantina" class="form-control-dark" placeholder="Cantina" required autofocus>
			<input type="text" id="inputName" name="nome" class="form-control-dark" placeholder="Nome" required autofocus>
			<input type="text" id="inputRegione" name="regione" class="form-control-dark" placeholder="Regione" autofocus>
			<input type="text" id="inputGrado" name="gradi" class="form-control-dark" placeholder="Gradi (ex. 7.30)" autofocus>
			<select class="form-control-dark"  name="tipologia" size="1">
				<option value="bianco">Bianco</option>
				<option value="rosso">Rosso</option>
				<option value="rosato">Rosato</option>
				<option value="spumante">Spumante</option>
			</select>
			<input type="text" id="inputPrezzo" name="prezzo" class="form-control-dark" placeholder="Prezzo (ex. 5.50)" autofocus>
			<input type="text" id="inputDescrizione" name="descrizione" class="form-control-dark" placeholder="Descrizione" autofocus>
			<input type="text" id="inputQuantità" name="quantita" class="form-control-dark" placeholder="Quantità (ex. 10)" required autofocus>
			<input type="file" id="inputImg" name="immagine" class="form-control-dark mb-0" accept="image/jpg"  style="height:30%;" autofocus>
			<?php
				if($_GET['error'] == 1) {
					$messaggio = "Tutti i campi devono essere riempiti";
				} else if($_GET['error'] == 2) {
					$messaggio = "Deve essere caricata un immagine";
				} else if($_GET['error'] == 3) {
					$messaggio = "L'immagine deve essere un file jpg 500x500";
				} else if($_GET['error'] == 4) {
					$messaggio = "Upload immagine non riuscito";
				} else if($_GET['error'] == 5) {
					$messaggio = "Inserimento non riuscito non riuscito";
				} else if($_GET['add'] > 0) {
					$messaggio = "Aggiunti ".$_GET['add']." prodotti";
				} else if($_GET['upload'] == 1) {
					$messaggio = "Inserimento di un nuovo prodotto riuscito";
				} else {
					$messaggio = "solo immagini jpg 500x500";
				}
					
			?>		
			<small class="font-weight-normal text-red mt-0"><?php echo $messaggio ?></small>
			<button class="btn btn-lg btn-primary btn-block mt-4" name="submit" type="submit">Inserisci prodotto</button>
		</form>
		<p class=" text-center mt-5">Nota: per aggiungere quantità ad un prodotto già esistente, è sufficiente inserire cantina, nome e quantità da aggiungere</p>
        </main>
      </div>
    </div>

  </body>
</html>
