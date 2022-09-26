<?php
	if(isset($_POST['acquista'])) {
		include "session.php";

		//ricevo i dati dal form del carrello
		$nomeConsegna = mysqli_real_escape_string($db, $_POST['nomeConsegna']);
		$cognomeConsegna = mysqli_real_escape_string($db, $_POST['cognomeConsegna']);
		$emailConsegna = mysqli_real_escape_string($db, $_POST['emailConsegna']);
		$telefonoConsegna = mysqli_real_escape_string($db, $_POST['telefonoConsegna']);
		$indirizzoConsegna = mysqli_real_escape_string($db, $_POST['indirizzoConsegna']);
		$statoConsegna = mysqli_real_escape_string($db, $_POST['paeseConsegna']);
		$cittaConsegna = mysqli_real_escape_string($db, $_POST['cittaConsegna']);
		$capConsegna = mysqli_real_escape_string($db, $_POST['capConsegna']);
		$nomeFatturazione = mysqli_real_escape_string($db, $_POST['nomeFatturazione']);
		$cognomeFatturazione = mysqli_real_escape_string($db, $_POST['cognomeFatturazione']);
		$indirizzoFatturazione = mysqli_real_escape_string($db, $_POST['indirizzoFatturazione']);
		$statoFatturazione = mysqli_real_escape_string($db, $_POST['paeseFatturazione']);
		$cittaFatturazione = mysqli_real_escape_string($db, $_POST['cittaFatturazione']);
		$capFatturazione = mysqli_real_escape_string($db, $_POST['capFatturazione']);
		$metodoPagamento = mysqli_real_escape_string($db, $_POST['paymentMethod']);
		$nomeCarta = mysqli_real_escape_string($db, $_POST['nomeCarta']);
		$cognomeCarta = mysqli_real_escape_string($db, $_POST['cognomeCarta']);
		$numeroCarta = mysqli_real_escape_string($db, $_POST['numeroCarta']);
		$scadenzaCarta = mysqli_real_escape_string($db, $_POST['scadenzaCarta']);
		$cvvCarta = mysqli_real_escape_string($db, $_POST['cvvCarta']);
		$dataAcquisto = date('Y-m-d H:i:s');

		//se non vi è l'indirizzo di consegna nella tabella indirizzi, lo inserisco
		$queryIndirizzo = "SELECT * FROM indirizzi WHERE stato = '".$statoConsegna."' AND citta = '".$cittaConsegna.
							"' AND cap = '".$capConsegna."' AND via = '".$indirizzoConsegna."'";
		$resultIndirizzo = mysqli_query($db, $queryIndirizzo);
		$countIndirizzo = mysqli_num_rows($resultIndirizzo);
		if($countIndirizzo == 0) {
			$queryInserisciIndirizzo = "INSERT INTO indirizzi (stato, citta, cap, via)
										VALUES ('$statoConsegna', '$cittaConsegna', '$capConsegna', '$indirizzoConsegna')";
			mysqli_query($db, $queryInserisciIndirizzo);
			$resultIndirizzo = mysqli_query($db, $queryIndirizzo);
		}
		$indirizzo = mysqli_fetch_array($resultIndirizzo, MYSQLI_ASSOC);
		$indirizzoConsegnaID = $indirizzo['id'];

		//se non vi è la carta nella tabella carte, la aggiungo
		$queryCarta = "SELECT * FROM carte WHERE nome_proprietario = '".$nomeCarta."' AND cognome_proprietario = '".$cognomeCarta."' AND codice = '".$numeroCarta.
						"' AND data_di_scadenza = '".$scadenzaCarta."' AND cvv = '".$cvvCarta."' AND tipologia = '".$metodoPagamento."'";
		$resultCarta = mysqli_query($db, $queryCarta);
		$countCarta = mysqli_num_rows($resultCarta);
		if($countCarta == 0) {
			$queryInserisciCarta = "INSERT INTO carte (nome_proprietario, cognome_proprietario, codice, data_di_scadenza, cvv, tipologia)
										VALUES ('$nomeCarta', '$cognomeCarta', '$numeroCarta', '$scadenzaCarta', '$cvvCarta', '$metodoPagamento')";
			mysqli_query($db, $queryInserisciCarta);
			$resultCarta = mysqli_query($db, $queryCarta);
		}
		$carta = mysqli_fetch_array($resultCarta, MYSQLI_ASSOC);
		$cartaID = $carta['id'];

		//se non vi è il collegamento tra il cliente e la carta nella tabella cliente_carta, lo aggiungo
		$queryUser = "SELECT * FROM clienti WHERE username = '".$_SESSION['user']."'";
		$resultUser = mysqli_query($db, $queryUser);
		$user = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);
		$userID = $user['id'];
		
		$queryClienteCarta = "SELECT * FROM cliente_carta WHERE id_cliente = ".$userID." AND id_carta = ".$cartaID;
		$resultClienteCarta = mysqli_query($db, $queryClienteCarta);
		$countClienteCarta = mysqli_num_rows($resultClienteCarta);
		if($countClienteCarta == 0) {
			$queryInserisciClienteCarta = "INSERT INTO cliente_carta (id_cliente, id_carta) VALUES ($userID, $cartaID)";
			mysqli_query($db, $queryInserisciClienteCarta);
		}

		//se non vi è l'indirizzo di fatturazione nella tabella indirizzi, lo inserisco
		$queryIndirizzoFattura = "SELECT * FROM indirizzi WHERE stato = '".$statoFatturazione."' AND citta = '".$cittaFatturazione.
							"' AND cap = '".$capFatturazione."' AND via = '".$indirizzoFatturazione."'";
		$resultIndirizzoFattura = mysqli_query($db, $queryIndirizzoFattura);
		$countIndirizzoFattura = mysqli_num_rows($resultIndirizzoFattura);
		if($countIndirizzoFattura == 0) {
			$queryInserisciIndirizzoFattura = "INSERT INTO indirizzi (stato, citta, cap, via)
										VALUES ('$statoFatturazione', '$cittaFatturazione', '$capFatturazione', '$indirizzoFatturazione')";
			mysqli_query($db, $queryInserisciIndirizzoFattura);
			$resultIndirizzoFattura = mysqli_query($db, $queryIndirizzoFattura);
		}
		$indirizzoFattura = mysqli_fetch_array($resultIndirizzoFattura, MYSQLI_ASSOC);
		$indirizzoFatturaID = $indirizzoFattura['id'];

		//inserimento dell'ordine

		$queryCarrello = "SELECT * FROM carrello WHERE id_cliente = ".$userID;
		$resultCarrello = mysqli_query($db, $queryCarrello);
		$carrello = mysqli_fetch_array($resultCarrello, MYSQLI_ASSOC);
		$carrelloID = $carrello['id'];

		if($carrello['id_coupon'] == "") {
			$couponID = "NULL";
		} else {
			$couponID = $carrello['id_coupon'];

			//inserimento dati in cliente_coupon
			$queryInserisciCarrelloCoupon = "INSERT INTO cliente_coupon (id_cliente, id_coupon) VALUES ($userID, $couponID)";
			mysqli_query($db, $queryInserisciCarrelloCoupon);
		}

		$corriereID = $carrello['id_corriere'];
		$queryInserisciOrdine = "INSERT INTO ordini (id_cliente, id_indirizzo_sped, id_carta, data_acquisto, id_coupon, id_corriere)
									VALUES ($userID, $indirizzoConsegnaID, $cartaID, '$dataAcquisto', $couponID, $corriereID)";
		mysqli_query($db, $queryInserisciOrdine);

		//inserisco la fattura nella tabella fatture
		$queryOrdine = "SELECT id FROM ordini WHERE id_cliente = ".$userID." AND id_indirizzo_sped = ".$indirizzoConsegnaID." AND id_carta = ".$cartaID.
						" AND data_acquisto = '".$dataAcquisto."' AND id_corriere = ".$corriereID;
		$resultOrdine = mysqli_query($db, $queryOrdine);
		$ordine = mysqli_fetch_array($resultOrdine, MYSQLI_ASSOC);
		$ordineID = $ordine['id'];

		$queryInserisciFattura = "INSERT fatture (id_indirizzo, id_ordine, nome, cognome) VALUES ($indirizzoFatturaID, $ordineID, '$nomeFatturazione', '$cognomeFatturazione')";
		mysqli_query($db, $queryInserisciFattura);

		//parte per il costo totale e per l'aggiornamento di vini e ordine_vini
		$queryProdotti = "SELECT vini.id AS vinoID, vini.cantina AS cantina, vini.nome AS nome, vini.prezzo AS prezzo, vini.quantita AS quantitaVino,
								carrello_vini.quantita AS quantitaSelezionata FROM carrello_vini, vini WHERE vini.id = carrello_vini.id_vino AND carrello_vini.id_carrello = ".$carrelloID;
		$resultProdotti = mysqli_query($db, $queryProdotti);
		$countProdotti = mysqli_num_rows($resultProdotti);
		$i = 0;

		$queryCoupon = "SELECT * FROM coupon WHERE id = ".$carrello['id_coupon'];
		$resultCoupon = mysqli_query($db, $queryCoupon);
		$coupon = mysqli_fetch_array($resultCoupon, MYSQLI_ASSOC);

		$queryCorriere = "SELECT * FROM corrieri WHERE id = ".$carrello['id_corriere'];
		$resultCorriere = mysqli_query($db, $queryCorriere);
		$corriere = mysqli_fetch_array($resultCorriere, MYSQLI_ASSOC);

		$totale = $corriere['costo'] - $coupon['importo_sconto'];
		while($i < $countProdotti) {
			$prodotto = mysqli_fetch_array($resultProdotti, MYSQLI_ASSOC);
			$prodottoID = $prodotto['vinoID'];
			$quantitaSelezionata = $prodotto['quantitaSelezionata'];
			$nuovaQuantita = $prodotto['quantitaVino'] - $quantitaSelezionata;
			$queryAggiornaQuantita = "UPDATE vini SET quantita = ".$nuovaQuantita." WHERE id = ".$prodottoID;
			mysqli_query($db, $queryAggiornaQuantita);

			$queryInserisciOrdineVino = "INSERT INTO ordine_vino (id_ordine, id_vino, quantita) VALUES ($ordineID, $prodottoID, $quantitaSelezionata)";
			mysqli_query($db, $queryInserisciOrdineVino);

			$totale += $prodotto['prezzo'] * $quantitaSelezionata;
			$i++;
		}
		if($totale > 500) {
			$totale -= $totale / 10;
		}

		//aggiorno il totale dell'ordine
		$queryAggiornaTotale = "UPDATE ordini SET costo_totale = ".$totale." WHERE id = ".$ordineID;
		mysqli_query($db, $queryAggiornaTotale);

		//svuotare carrello
		$querySvuotaCarrelloVini = "DELETE FROM carrello_vini WHERE id_carrello = ".$carrelloID;
		mysqli_query($db, $querySvuotaCarrelloVini);
		$querySvuotaCarrello = "UPDATE carrello SET id_coupon = NULL WHERE id = ".$carrelloID;
		mysqli_query($db, $querySvuotaCarrello);

		if($metodoPagamento == 'paypal'){
			header("location: paypal.php");
		} else {
			header("location: payment_successful.php?".$queryClienteCarta);
		}
	}
?>
