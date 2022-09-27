<!doctype html>
<html lang="it">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../res/img/logo.ico">

	<title>Vinelly - Profilo utente</title>

	<!-- Bootstrap core CSS -->
	<link href="../css/common.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="../css/carousel.css" rel="stylesheet">
</head>

<body style="background-color: #f5f5f5">
	<!-- HEADER -->
	<?php
	include "header.php";
	include "session.php";
	if ($_SESSION['logged'] != 'true') {
		header("location: index.php");
	}
	$queryUser = "SELECT * FROM clienti WHERE username = '" . $_SESSION['user'] . "'";
	$resultUser = mysqli_query($db, $queryUser);
	$user = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);

	$queryIndirizzo = "SELECT * FROM indirizzi WHERE id = '" . $user['id_indirizzo'] . "'";
	$resultIndirizzo = mysqli_query($db, $queryIndirizzo);
	$address = mysqli_fetch_array($resultIndirizzo, MYSQLI_ASSOC);

	$queryCarte = "SELECT carte.codice AS codiceCarta FROM carte, cliente_carta WHERE cliente_carta.id_carta = carte.id AND cliente_carta.id_cliente = " . $user['id'];
	$resultCarte = mysqli_query($db, $queryCarte);

	$queryOrdini = "SELECT data_acquisto, fatture.id AS id_fattura, costo_totale FROM ordini JOIN fatture ON ordini.id = fatture.id_ordine WHERE id_cliente = " . $user['id'];
	$resultOrdini = mysqli_query($db, $queryOrdini);
	?>
	<main role="main">
		<div class="container marketing mt-5 pt-5">
			<div class="row">
				<div class="col-lg-4 text-center">
					<h2 class="mb-3 text-purple" style="font-weight: 550">Dati Personali</h2>
					<?php if ($_GET['editData'] != 'true') { ?>
						<input type="text" id="inputName" name="name" class="form-control mb-1 bg-white" placeholder="<?= $user['nome'] ?>" required autofocus disabled>
						<input type="text" id="inputSurname" name="surname" class="form-control mb-1 bg-white" placeholder="<?= $user['cognome'] ?>" required autofocus disabled>
						<input type="email" id="inputEmail" name="email" class="form-control mb-1 bg-white" placeholder="<?= $user['email'] ?>" required autofocus disabled>
						<input type="text" id="inputUsername" name="username" class="form-control mb-1 bg-white" placeholder="<?= $user['username'] ?>" required autofocus disabled>
						<input type="text" id="inputDate" name="date" class="form-control mb-1 bg-white" placeholder="<?= $user['data_nascita'] ?>" required autofocus disabled>
						<input type="text" id="inputNumber" name="number" class="form-control mb-1 bg-white" placeholder="<?= $user['numero_di_telefono'] ?>" required autofocus disabled>
						<input type="text" id="inputAddress" name="address" class="form-control mb-1 bg-white" placeholder="<?= $address['via'] ?>" required autofocus disabled>
						<input type="text" id="inputState" name="state" class="form-control mb-1 bg-white" placeholder="<?= $address['stato'] ?>" autofocus disabled>
						<input type="text" id="inputCity" name="city" class="form-control mb-1 bg-white" placeholder="<?= $address['citta'] ?>" required autofocus disabled>
						<input type="text" id="inputCAP" name="CAP" class="form-control mb-1 bg-white" placeholder="<?= $address['cap'] ?>" required autofocus disabled>
						<a href="profile.php?editData=true"><button type="button" class="btn btn-sm btn-outline-secondary">Modifica</button></a>
					<?php } else { ?>
						<form class="form-signin mt-0" method="post" action="update_profile.php">
							<input type="text" id="inputName" name="name" class="form-control mb-1 bg-white" value="<?= $user['nome'] ?>" required autofocus>
							<input type="text" id="inputSurname" name="surname" class="form-control mb-1 bg-white" value="<?= $user['cognome'] ?>" required autofocus>
							<?php if ($_GET['err'] == 'mail') { ?> <h6 class="mb-3 font-weight-normal text-red">Email già presente</h6> <?php } ?>
							<input type="email" id="inputEmail" name="email" class="form-control mb-1 bg-white" value="<?= $user['email'] ?>" required autofocus>
							<?php if ($_GET['err'] == 'usr') { ?> <h6 class="mb-3 font-weight-normal text-red">Username già presente</h6> <?php } ?>
							<input type="text" id="inputUsername" name="username" class="form-control mb-1 bg-white" value="<?= $user['username'] ?>" required autofocus>
							<input type="date" id="inputDate" name="date" class="form-control mb-1 bg-white" value="<?= $user['data_nascita'] ?>" required autofocus>
							<input type="text" id="inputNumber" name="number" class="form-control mb-1 bg-white" value="<?= $user['numero_di_telefono'] ?>" required autofocus>
							<input type="text" id="inputAddress" name="address" class="form-control mb-1 bg-white" value="<?= $address['via'] ?>" required autofocus>
							<input type="text" id="inputState" name="state" class="form-control mb-1 bg-white" value="<?= $address['stato'] ?>" novalidate>
							<input type="text" id="inputCity" name="city" class="form-control mb-1 bg-white" value="<?= $address['citta'] ?>" required autofocus>
							<input type="text" id="inputCAP" name="CAP" class="form-control mb-1 bg-white" value="<?= $address['cap'] ?>" required autofocus>
							<button type="submit" class="btn btn-sm btn-outline-secondary" name="submit">Salva</button>
						</form>
					<?php } ?>
					<?php if ($_GET['change'] != 'psw') { ?>
						<a href="profile.php?change=psw">
							<p><button type="submit" class="btn btn-sm btn-outline-secondary">Cambia password</button></p>
						</a>
					<?php } else { ?>
						<form method="POST" action="change_password.php">
							<?php if ($_GET['err'] == 'oldPs') { ?> <h6 class="mb-3 font-weight-normal text-red">La vecchia password non corrisponde</h6> <?php } ?>
							<input type="password" id="inputPassword" name="psw" class="form-control mb-1 bg-white" placeholder="Vecchia password" required autofocus>
							<?php if ($_GET['err'] == 'incorrect') { ?> <h6 class="mb-3 font-weight-normal text-red">Le due password non coincidono</h6> <?php } ?>
							<input type="password" id="inputNewPassword" name="newPsw" class="form-control mb-1 bg-white" placeholder="Nuova password" required autofocus>
							<input type="password" id="inputNewPassword2" name="newPsw2" class="form-control mb-1 bg-white" placeholder="Ripeti password" required autofocus>
							<button type="submit" class="btn btn-sm btn-outline-secondary" name="submit3">Salva</button>
						</form>
					<?php } ?>
				</div><!-- /.col-lg-4 -->
				<div class="col-lg-4 text-center">
					<h2 class="mb-3 text-purple" style="font-weight: 550">Carte registrate</h2>
					<label for="inputCard" class="sr-only">Card</label>
					<?php if (mysqli_num_rows($resultCarte) != 0) {
						$count = mysqli_num_rows($resultCarte);
						$i = 0;
						while ($i < $count) {
							$card = mysqli_fetch_array($resultCarte, MYSQLI_ASSOC);
					?>
							<form method="POST" action="remove_card.php">
								<div class="input-group">
									<?php if ($card['codiceCarta'] == NULL) { ?>
										<input type="text" id="inputCard" class="form-control bg-white text-center" value="Paypal" required autofocus disabled>
									<?php } else { ?>
										<input type="text" id="inputCard" class="form-control bg-white text-center" value="<?= $card['codiceCarta'] ?>" required autofocus disabled>
									<?php } ?>
									<input type="hidden" name="cardNumber" value="<?= $card['codiceCarta'] ?>">
									<div class="input-group-prepend">
										<button type="submit" name="submit_card" class="btn btn-outline-success my-2 my-sm-0 ml-1n bg-white">
											<i class="fa fa-lg fa-trash text-red"></i>
										</button>
									</div>
								</div>
							</form>
						<?php
							$i++;
						}
					} else { ?>
						<h5 class="mb-3 font-weight-normal text-dark">Nessuna carta registrata</h5>
					<?php } ?>
				</div><!-- /.col-lg-4 -->
				<div class="col-lg-4 text-center">
					<h2 class="mb-3 text-purple text-center" style="font-weight: 550">I miei ordini</h2>
					<ul class="list-group mr-4 ml-4">
						<?php
						if (mysqli_num_rows($resultOrdini) > 0) {
							while ($ordine = mysqli_fetch_array($resultOrdini, MYSQLI_ASSOC)) { ?>
								<li class="list-group-item d-flex justify-content-between" style="line-height: 1.25;">
									<div class="mr-5 div-shop">
										<h6 class="my-0"><?= $ordine['data_acquisto'] ?></h6>
										<small class="text-muted"><?= $ordine['costo_totale'] ?>€</small>
									</div>
									<a class="mt-2" href="/<?= "../site/pages/generate_invoice.php?id_fattura=" . $ordine['id_fattura'] ?>" target="_blank"><i class="fa fa-lg fa-download text-blue"><button class="btn btn-outline-success"></button></i></a>
								</li>
							<?php
							}
						} else { ?>
							<h5 class="mb-3 font-weight-normal text-dark">Nessun ordine effettuato</h5>
						<?php } ?>
					</ul>
				</div><!-- /.col-lg-4 -->
			</div><!-- /.row -->
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