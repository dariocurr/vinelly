<!doctype html>

<?php
	include "session.php";
	$queryUser = "SELECT * FROM clienti WHERE username = '".$_SESSION['user']."'";
	$resultUser = mysqli_query($db, $queryUser);
	$user = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);
	$userID = $user['id'];

	$queryCarrello = "SELECT * FROM carrello WHERE id_cliente = ".$userID;
	$resultCarrello = mysqli_query($db, $queryCarrello);
	$carrello = mysqli_fetch_array($resultCarrello, MYSQLI_ASSOC);
	$carrelloID = $carrello['id'];

	if($_GET['remove'] != 0) {
		$queryRimozione = "DELETE FROM carrello_vini WHERE id_carrello = ".$carrelloID." AND id_vino = ".$_GET['remove'];
		mysqli_query($db, $queryRimozione);
		header("location: cart.php");
	}

	if($_GET['removeCoupon'] != 0) {
		$queryRimozione = "UPDATE carrello SET id_coupon = NULL WHERE id = ".$carrelloID;
		mysqli_query($db, $queryRimozione);
		header("location: cart.php");
	}
?>

<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../res/img/logo.ico">

    <title>Vinelly - Checkout</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/common.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/cart.css" rel="stylesheet">
  </head>

  <body class="bg-light">
	<!-- HEADER -->
		<?php
			include "header.php";
			if($_SESSION['logged'] != 'true'){
				header("location: index.php");
			}

			$queryIndirizzi = "SELECT * FROM indirizzi JOIN clienti ON indirizzi.id = clienti.id_indirizzo  WHERE username = '".$_SESSION['user']."'";
			$resultIndirizzi = mysqli_query($db, $queryIndirizzi);
			$indirizzo = mysqli_fetch_array($resultIndirizzi, MYSQLI_ASSOC);

			$queryCarta = "SELECT * FROM clienti JOIN (cliente_carta JOIN carte ON carte.id = cliente_carta.id_carta) ON clienti.id = cliente_carta.id_cliente  WHERE username = '".$_SESSION['user']."'";
			$resultCarta = mysqli_query($db, $queryCarta);
			$carta = mysqli_fetch_array($resultCarta, MYSQLI_ASSOC);
			$countCarte = mysqli_num_rows($resultCarta);

			$queryProdotti = "SELECT vini.id AS vinoID, vini.cantina AS cantina, vini.nome AS nome, vini.prezzo AS prezzo, vini.quantita AS quantitaVino,
								carrello_vini.quantita AS quantitaSelezionata FROM carrello_vini, vini WHERE vini.id = carrello_vini.id_vino AND carrello_vini.id_carrello = ".$carrelloID;
			$resultProdotti = mysqli_query($db, $queryProdotti);
			$countProdotti = mysqli_num_rows($resultProdotti);
			$i = 0;

			$queryCorrieri = "SELECT * FROM corrieri";
			$resultCorrieri = mysqli_query($db, $queryCorrieri);
			$countCorrieri = mysqli_num_rows($resultCorrieri);
			$k = 0;

			$queryCoupon = "SELECT * FROM coupon WHERE id = ".$carrello['id_coupon'];
			$resultCoupon = mysqli_query($db, $queryCoupon);
			$coupon = mysqli_fetch_array($resultCoupon, MYSQLI_ASSOC);

			$queryCorriere = "SELECT costo FROM corrieri WHERE id = ".$carrello['id_corriere'];
			$resultCorriere = mysqli_query($db, $queryCorriere);
			$corriere = mysqli_fetch_array($resultCorriere, MYSQLI_ASSOC);
			$corriereSelezionato = 0;
			$totale = 0;
		?>
    <div class="container">
      <div class="py-5 mt-5 text-center">
        <h2 class="text-purple mb-0">Il tuo carrello</h2>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
			<form method="post" action="update_cart.php">
			  <h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="text-muted">Ciò che hai scelto</span>
				<button type="submit" name="refresh" class="btn bg-transparent fa fa-refresh text-purple"></button>
				<span class="badge badge-secondary badge-pill bg-purple"><?php echo $countProdotti ?></span>
			  </h4>
			  <ul class="list-group mb-3">
				<?php while($i < $countProdotti) {
						$prodotto = mysqli_fetch_array($resultProdotti, MYSQLI_ASSOC);
						$totale += $prodotto['prezzo'] * $prodotto['quantitaSelezionata'];
				?>
					<li class="list-group-item d-flex justify-content-between lh-condensed">
					  <div class="mr-0 div-shop">
						<h6 class="my-0"><?php echo $prodotto['nome']?></h6>
						<small class="text-muted">
							<?php
								$stringa = number_format($prodotto['prezzo'], 2)."€";
								if($prodotto['quantitaSelezionata'] > 1) {
									$stringa .= " x ".$prodotto['quantitaSelezionata']." = ".number_format($prodotto['prezzo'] * $prodotto['quantitaSelezionata'], 2)."€";
								}
								echo $stringa;
							?>
						</small>
					  </div>
						<input type="hidden" name="vinoID<?php echo $i?>" value="<?php echo $prodotto['vinoID']?>">
						<select name="vino<?php echo $i?>" class="custom-select move-button" style="width: 37%" size="1">
							<?php
								$j = 1;
								while($j <= $prodotto['quantitaVino']) {
									if($j == $prodotto['quantitaSelezionata']) {
										echo "<option selected>$j</option>";
									} else {
										echo "<option>$j</option>";
									}
									$j++;
								}
							?>
						</select>
						<a class="ml-3 mt-2 move-button" href="<?php echo "cart.php?remove=".$prodotto['vinoID']?>">
							<i class="fa fa-remove remove-product"><button class="btn btn-outline-success"></button></i>
						</a>
					</li>
				<?php
						$i++;
					}
				?>
				<?php if($countProdotti != 0) { ?>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<select name="corriere" class="custom-select pl-0 pr-0" size="1">
						<?php
							while($k < $countCorrieri) {
								$corriere = mysqli_fetch_array($resultCorrieri, MYSQLI_ASSOC);
								if($k + 1 == $carrello['id_corriere']) {
									echo "<option value=".$corriere['nome']." selected>".$corriere['nome']." - ".$corriere['costo']."€</option>";
									$corriereSelezionato = $corriere;
								} else {
									echo "<option value=".$corriere['nome'].">".$corriere['nome']." - ".$corriere['costo']."€</option>";
								}
								$k++;
							}
						?>
					</select>
				</li>
				<?php } ?>
				<?php
					if($carrello['id_coupon'] != "") {
				?>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div class="text-purple">
								<h6 style="position: relative; top: 0.15rem" class="my-0"><?php echo $coupon['codice']?></h6>
							</div>
							<span style="position: relative; left: 3rem" class="text-purple move-button-2">-€<?php echo $coupon['importo_sconto']?></span>
							<a style="position: relative; left: 1.7rem" href="<?php echo "cart.php?removeCoupon=".$coupon['id']?>">
								<i class="fa fa-remove remove-product"><button class="btn btn-outline-success"></button></i>
							</a>
						</li>
				<?php
					}
					if($totale > 500) {
						$sconto = $totale / 10;
						$totale -= $sconto;
				?>
						<li class="list-group-item d-flex justify-content-between bg-light">
							<div class="text-purple">
								<h6 class="my-0">Sconto grandi quantità</h6>
							</div>
							<span class="text-purple">10%</span>
						</li>
				<?php
					}
					if($countProdotti != 0) {
						$totale += $corriereSelezionato['costo'];
						$totale -= $coupon['importo_sconto'];
					}
				?>


				<li class="list-group-item d-flex justify-content-between">
				  <strong>Totale</strong>
				  <?php if($countProdotti != 0 && ($carrello['id_coupon'] != "" || $totale > 500)) { ?>
					<s class="ml-5"><?php echo number_format($totale + $sconto + $coupon['importo_sconto'], 2)?>€</s>
				  <?php } ?>
				  <strong class="ml-1"><?php echo number_format($totale, 2) ?>€</strong>
				</li>

			  </ul>
			</form>
          <form method="post" action="update_cart.php" class="card p-2">
            <div class="input-group">
              <input type="text" name="codice" class="form-control" placeholder="Codice coupon">
              <div class="input-group-append">
                <button type="submit" name="coupon" class="btn btn-secondary bg-purple">Applica</button>
              </div>
            </div>
          </form>
		  <?php if($_GET['couponError'] == 1) { ?>
					<h6 class="text-red mt-2 text-center">Coupon già utilizzato</h6>
		  <?php } else if ($_GET['couponError'] == 2) { ?>
					<h6 class="text-red mt-2 text-center">Coupon inesistente</h6>
		  <?php } ?>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3 text-muted">Informazioni per la consegna</h4>
          <form class="needs-validation" method="post" action="purchase.php" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nome</label>
                <input type="text" class="form-control" name="nomeConsegna" id="firstName" value="<?=$user['nome']?>" required>
                <div class="invalid-feedback">
                  Il tuo nome è richiesto
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Cognome</label>
                <input type="text" class="form-control" name="cognomeConsegna" id="lastName" value="<?=$user['cognome']?>" required>
                <div class="invalid-feedback">
                  Il tuo cognome è richiesto
                </div>
              </div>
            </div>


            <div class="mb-3">
              <label for="email">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" name="emailConsegna" id="email" value="<?=$user['email']?>">
              <div class="invalid-feedback">
                La tua e-mail è richiesta
              </div>
            </div>

			<div class="mb-4">
              <label for="username">Telefono</label>
              <div class="input-group">
                <input type="text" class="form-control" name="telefonoConsegna" id="telefono" value="+39 <?=$user['numero_di_telefono']?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Il tuo telefono è richiesto
                </div>
              </div>
            </div>

			<hr class="mb-4">

			<div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" name="consegna" class="custom-control-input" id="predefinito-address" value="yes" checked>
              <label class="custom-control-label" for="predefinito-address">L'indirizzo di consegna è quello predefinito</label>
            </div>
						<div id="active_sub" style="display: none">
								<div class="mb-3">
									<label for="address">Indirizzo principale</label>
									<input type="text" class="form-control" name="indirizzoConsegna" id="indirizzo" value="<?= $indirizzo['via'];?>" placeholder="">
									<div class="invalid-feedback">
										Per favore inserisci l'indirizzo di consegna
									</div>
								</div>
							<div class="row">
								<div class="col-md-5 mb-3">
									<label for="country">Paese</label>
									<input type="text" class="form-control" name="paeseConsegna" id="stato" value="<?= $indirizzo['stato'];?>" placeholder="">
									<div class="invalid-feedback">
										Per favore seleziona un paese valido
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<label for="state">Città</label>
									<input type="text" class="form-control" name="cittaConsegna" id="citta" value="<?= $indirizzo['citta'];?>"placeholder="">
									<div class="invalid-feedback">
										Per favore inserisci una città.
									</div>
								</div>
								<div class="col-md-3 mb-3">
									<label for="zip">CAP</label>
									<input type="text" class="form-control" name="capConsegna" id="cap" value="<?= $indirizzo['cap'];?>" placeholder="">
									<div class="invalid-feedback">
										Inserisci un CAP valido
									</div>
								</div>
							</div>
						</div>

            <hr class="mb-4">

            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" name="fatturazione" class="custom-control-input" id="same-address" value="yes" checked>
              <label class="custom-control-label" for="same-address">L'indirizzo di fatturazione corrisponde all'indirizzo di consegna predefinito</label>
            </div>
					<div id="active_fatturazione" style="display: none">
						<div class="row">
							<div class="col-md-6 mb-3">
							  <label for="firstName">Nome</label>
							  <input type="text" class="form-control" name="nomeFatturazione" value="<?= $user['nome'];?>" id="fatt-firstName" placeholder="">
							  <div class="invalid-feedback">
								Il tuo nome è richiesto
							  </div>
							</div>
							<div class="col-md-6 mb-3">
							  <label for="lastName">Cognome</label>
							  <input type="text" class="form-control" name="cognomeFatturazione" value="<?= $user['cognome'];?>" id="fatt-lastName" placeholder="">
							  <div class="invalid-feedback">
								Il tuo cognome è richiesto
							  </div>
							</div>
						  </div>

						  <div class="mb-3">
							<label for="address">Indirizzo principale</label>
							<input type="text" class="form-control"  name="indirizzoFatturazione" value="<?= $indirizzo['via'];?>" id="fatt-address" placeholder="">
							<div class="invalid-feedback">
							  Per favore inserisci l'indirizzo di consegna
							</div>
						  </div>

						  <div class="row mb-3">
							<div class="col-md-5 mb-3">
							  <label for="country">Paese</label>
							  <input type="text" class="form-control" name="paeseFatturazione" value="<?= $indirizzo['stato'];?>" id="fatt-state" placeholder="">
							  <div class="invalid-feedback">
								Per favore seleziona un paese valido
							  </div>
							</div>
							<div class="col-md-4 mb-3">
							  <label for="state">Città</label>
							  <input type="text" class="form-control" name="cittaFatturazione" value="<?= $indirizzo['citta'];?>" id="fatt-city" placeholder="">
							  <div class="invalid-feedback">
								Per favore inserisci una città.
							  </div>
							</div>
							<div class="col-md-3 mb-3">
							  <label for="zip">CAP</label>
							  <input type="text" class="form-control" name="capFatturazione" value="<?= $indirizzo['cap'];?>" id="fatt-cap" placeholder="">
							  <div class="invalid-feedback">
								Inserisci un CAP valido
							  </div>
							</div>
						</div>
					</div>

            <hr class="mb-4">
			<?php if($countCarte > 0) { ?>
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" name="check_card" class="custom-control-input" id="predefinito-card" value="yes" checked>
					<label class="custom-control-label" for="predefinito-card">Utilizzare la carta predefinita</label>
				</div>
				<div id="carta_predefinita">
					<div class="mb-3">
						<label for="username">Carta registrata</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-lg fa-credit-card"></i></span>
							</div>
							<?php 
								$infoCarta = "";
								if($carta['codice'] == NULL) {
									$infoCarta = "Paypal";
								} else {
									$infoCarta = $carta['codice'];
								}
							?>
							<input type="text" class="form-control" style="border: 1px solid #ced4da; border-radius: .25rem" id="cc-card" value="<?=$infoCarta?>" disabled>
						</div>
					</div>
				</div>
				<div  id="active_card" style="display: none">
			<?php } else { ?>
				<div>
			<?php } ?>
							<div class="d-block my-3">
							  <div class="custom-control custom-radio">
								<input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="credit" checked required>
								<label class="custom-control-label" for="credit">Carta di credito</label>
							  </div>
							  <div class="custom-control custom-radio">
								<input id="debit" name="paymentMethod" type="radio" class="custom-control-input" value="debit" required>
								<label class="custom-control-label" for="debit">Carta di debito</label>
							  </div>
							  <div class="custom-control custom-radio">
								<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" value="paypal" required>
								<label class="custom-control-label" for="paypal">Paypal</label>
							  </div>
							</div>
							<div id="active_paypal" style="display: block">
								<div class="row">
							  <div class="col-md-6 mb-3">
								<label for="cc-name">Nome proprietario</label>
								<input type="text" class="form-control" name="nomeCarta" id="cc-name" value="<?= $carta['nome_proprietario'];?>" required>
								<div class="invalid-feedback">
								  Il nome del proprietario della carta deve essere inserito
								</div>
							  </div>
							  <div class="col-md-6 mb-3">
								<label for="cc-name">Cognome proprietario</label>
								<input type="text" class="form-control" name="cognomeCarta" id="cc-surname" value="<?= $carta['cognome_proprietario'];?>" required>
								<div class="invalid-feedback">
								  Il cognome del proprietario della carta deve essere inserito
								</div>
							  </div>
							</div>

							<div class="row">
							  <div class="col-md-6 mb-3">
								<label for="cc-number">Numero della carta</label>
								<input type="text" class="form-control" name="numeroCarta" id="cc-number" value="<?= $carta['codice'];?>" required>
								<div class="invalid-feedback">
								  Il numero della carta di credito deve essere inserito
								</div>
							  </div>
							  <div class="col-md-3 mb-3">
								<label for="cc-expiration">Valida fino</label>
								<input type="date" class="form-control pl-0" name="scadenzaCarta" id="cc-expiration" value="<?= $carta['data_di_scadenza'];?>" required>
								<div class="invalid-feedback">
								  Data di scadenza richiesta
								</div>
							  </div>
							  <div class="col-md-3 mb-3">
								<label for="cc-expiration">CVV</label>
								<input type="text" class="form-control" name="cvvCarta" id="cc-cvv" value="<?= $carta['cvv'];?>" required>
								<div class="invalid-feedback">
								  Il codice di sicurezza è richiesto
								</div>
							  </div>
							</div>
						</div>
						</div>
            <hr class="mb-4">
			<?php if($countProdotti > 0) { ?>
				<?php if($totale > 0) { ?>
					<button id="buy" class="btn btn-primary btn-lg btn-block" name="acquista" type="submit">Acquista</button>
				<?php } else { ?>
					<h6 class="text-center text-purple">Il totale deve essere maggiore di 0</h6>
				<?php } ?>
			<?php } else { ?>
				<h5 class="text-center">
					<a href="index.php" class="btn btn-lg btn-outline-secondary">Non hai selezionato nessun prodotto, comincia ad acquistare</a>
				</h5>
			<?php } ?>
          </form>
        </div>
      </div>
    </div>
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
		<script type="text/javascript">
			document.getElementById('predefinito-address').onclick = function() {
				toggleAddress(this, 'active_sub');
			};
			
			document.getElementById('same-address').onclick = function() {
				toggleFatturazione(this, 'active_fatturazione');
			};
			
			document.getElementById('paypal').onclick = function() {
				togglePaypal(this, 'active_paypal');
			};
			
			document.getElementById('credit').onclick = function() {
				toggleCreditOrDebit(this, 'active_paypal');
			};
			
			document.getElementById('debit').onclick = function() {
				toggleCreditOrDebit(this, 'active_paypal');
			};

			document.getElementById('predefinito-card').onclick = function() {
				toggleCard(this, 'active_card');
			};


			function toggleAddress(box, id) {
				var el = document.getElementById(id);
				if ( box.checked ) {
						el.style.display = 'none';
						document.getElementById('indirizzo').required = false;
						document.getElementById('indirizzo').value = "<?= $indirizzo['via'];?>";
						document.getElementById('stato').required = false;
						document.getElementById('stato').value = "<?= $indirizzo['stato'];?>";
						document.getElementById('citta').required = false;
						document.getElementById('citta').value = "<?= $indirizzo['citta'];?>";
						document.getElementById('cap').required = false;
						document.getElementById('cap').value = "<?= $indirizzo['cap'];?>";
				} else {
						el.style.display = 'block';
						document.getElementById('indirizzo').required = true;
						document.getElementById('indirizzo').value = "";
						document.getElementById('stato').required = true;
						document.getElementById('stato').value = "";
						document.getElementById('citta').required = true;
						document.getElementById('citta').value = "";
						document.getElementById('cap').required = true;
						document.getElementById('cap').value = "";
				}
			}

			function toggleCard(box, id) {
				var el = document.getElementById(id);
				var card = document.getElementById('carta_predefinita');
				if ( box.checked ) {
						el.style.display = 'none';
						card.style.display = 'block';
						document.getElementById('cc-name').required = false;
						document.getElementById('cc-name').value = "<?= $carta['nome_proprietario'];?>";
						document.getElementById('cc-surname').required = false;
						document.getElementById('cc-surname').value = "<?= $carta['cognome_proprietario'];?>";
						document.getElementById('cc-number').required = false;
						document.getElementById('cc-number').value = "<?= $carta['codice'];?>";
						document.getElementById('cc-expiration').required = false;
						document.getElementById('cc-expiration').value = "<?= $carta['data_di_scadenza'];?>";
						document.getElementById('cc-cvv').required = false;
						document.getElementById('cc-cvv').value = "<?= $carta['cvv'];?>";
				} else {
						el.style.display = 'block';
						card.style.display = 'none';
						document.getElementById('cc-name').required = true;
						document.getElementById('cc-name').value = "";
						document.getElementById('cc-surname').required = true;
						document.getElementById('cc-surname').value = "";
						document.getElementById('cc-number').required = true;
						document.getElementById('cc-number').value = "";
						document.getElementById('cc-expiration').required = true;
						document.getElementById('cc-expiration').value = "";
						document.getElementById('cc-cvv').required = true;
						document.getElementById('cc-cvv').value = "";
				}
			}

			function toggleFatturazione(box, id) {
				var el = document.getElementById(id);
				if ( box.checked ) {
						el.style.display = 'none';
						document.getElementById('fatt-firstName').required = false;
						document.getElementById('fatt-firstName').value = "<?= $user['nome'];?>";
						document.getElementById('fatt-lastName').required = false;
						document.getElementById('fatt-lastName').value = "<?= $user['cognome'];?>";
						document.getElementById('fatt-address').required = false;
						document.getElementById('fatt-address').value = "<?= $indirizzo['via'];?>";
						document.getElementById('fatt-state').required = false;
						document.getElementById('fatt-state').value = "<?= $indirizzo['stato'];?>";
						document.getElementById('fatt-city').required = false;
						document.getElementById('fatt-city').value = "<?= $indirizzo['citta'];?>";
						document.getElementById('fatt-cap').required = false;
						document.getElementById('fatt-cap').value = "<?= $indirizzo['cap'];?>";

				} else {
						el.style.display = 'block';
						document.getElementById('fatt-firstName').required = true;
						document.getElementById('fatt-firstName').value = "";
						document.getElementById('fatt-lastName').required = true;
						document.getElementById('fatt-lastName').value = "";
						document.getElementById('fatt-address').required = true;
						document.getElementById('fatt-address').value = "";
						document.getElementById('fatt-state').required = true;
						document.getElementById('fatt-state').value = "";
						document.getElementById('fatt-city').required = true;
						document.getElementById('fatt-city').value = "";
						document.getElementById('fatt-cap').required = true;
						document.getElementById('fatt-cap').value = "";
				}
			}
			
			function togglePaypal(radio, id) {
				var el = document.getElementById(id);
				if ( radio.checked ) {
						el.style.display = 'none';
						document.getElementById('cc-name').required = false;
						document.getElementById('cc-surname').required = false;
						document.getElementById('cc-number').required = false;
						document.getElementById('cc-expiration').required = false;
						document.getElementById('cc-cvv').required = false;
				} 
			}
			
			function toggleCreditOrDebit(radio, id) {
				var el = document.getElementById(id);
				if ( radio.checked ) {
						el.style.display = 'block';
						document.getElementById('cc-name').required = true;
						document.getElementById('cc-surname').required = true;
						document.getElementById('cc-number').required = true;
						document.getElementById('cc-expiration').required = true;
						document.getElementById('cc-cvv').required = true;
				} 
			}
			
		</script>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
