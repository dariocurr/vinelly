<?php
include "session.php";

$queryUser = "SELECT id FROM clienti WHERE username = '" . $_SESSION['user'] . "'";
$resultUser = mysqli_query($db, $queryUser);
$user = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);
$userID = $user['id'];

$queryCarrello = "SELECT id FROM carrello WHERE id_cliente = " . $userID;
$resultCarrello = mysqli_query($db, $queryCarrello);
$carrello = mysqli_fetch_array($resultCarrello, MYSQLI_ASSOC);
$carrelloID = $carrello['id'];

if (isset($_POST['refresh'])) {
	$nuovoCorriere = mysqli_real_escape_string($db, $_POST['corriere']);

	$queryCorriere = "SELECT id FROM corrieri WHERE nome = '" . $nuovoCorriere . "'";
	$resultCorriere = mysqli_query($db, $queryCorriere);
	$corriere = mysqli_fetch_array($resultCorriere, MYSQLI_ASSOC);
	$nuovoCorriereID = $corriere['id'];

	$queryAggiornaCorriere = "UPDATE carrello SET id_corriere = " . $nuovoCorriereID . " WHERE id = " . $carrelloID;
	mysqli_query($db, $queryAggiornaCorriere);

	$queryProdotti = "SELECT * FROM carrello_vini WHERE id_carrello = " . $carrelloID;
	$resultProdotti = mysqli_query($db, $queryProdotti);
	$countProdotti = mysqli_num_rows($resultProdotti);
	$i = 0;

	while ($i < $countProdotti) {
		$vinoID = mysqli_real_escape_string($db, $_POST['vinoID' . $i]);
		$queryAggiornaQuantita = "UPDATE carrello_vini SET quantita = " . mysqli_real_escape_string($db, $_POST['vino' . $i]) .
			" WHERE id_carrello = " . $carrelloID . " AND id_vino = " . $vinoID;
		mysqli_query($db, $queryAggiornaQuantita);
		$i++;
	}

	header("location: cart.php");
}


if (isset($_POST['coupon'])) {
	$couponCodice = mysqli_real_escape_string($db, $_POST['codice']);
	$queryCoupon = "SELECT id FROM coupon WHERE codice = '" . $couponCodice . "'";
	$resultCoupon = mysqli_query($db, $queryCoupon);
	$countCoupon = mysqli_num_rows($resultCoupon);
	if ($countCoupon != 0) {
		$coupon = mysqli_fetch_array($resultCoupon, MYSQLI_ASSOC);
		$couponID = $coupon['id'];

		$queryCarrelloCoupon = "SELECT * FROM cliente_coupon WHERE id_cliente = " . $userID . " AND id_coupon = " . $couponID;
		$resultCarrelloCoupon = mysqli_query($db, $queryCarrelloCoupon);
		$countCoupon = mysqli_num_rows($resultCarrelloCoupon);
		if ($countCoupon == 0) {
			$queryAggiornaCoupon = "UPDATE carrello SET id_coupon = " . $couponID . " WHERE id_cliente = " . $userID;
			mysqli_query($db, $queryAggiornaCoupon);
			header("location: cart.php");
		} else {
			header("location: cart.php?couponError=1");
		}
	} else {
		header("location: cart.php?couponError=2");
	}
}
