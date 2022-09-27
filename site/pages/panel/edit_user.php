<!doctype html>

<?php
include "session.php";
$query1 = "SELECT clienti.nome AS nome, clienti.cognome AS cognome, clienti.email AS email, clienti.username AS username, clienti.numero_di_telefono AS numero,
				clienti.data_nascita AS data, clienti.domanda_sicurezza AS domanda, clienti.risposta_sicurezza AS risposta, clienti.password AS password,
				indirizzi.stato AS stato, indirizzi.citta AS citta, indirizzi.cap AS cap, indirizzi.via AS via 
				FROM clienti, indirizzi WHERE clienti.id_indirizzo =  indirizzi.id AND clienti.id = " . $_GET['id'];
$result = mysqli_query($db, $query1);
$datiCliente = mysqli_fetch_array($result, MYSQLI_ASSOC);
if (isset($_POST['submit'])) {
	$nome = mysqli_real_escape_string($db, $_POST['nome']);
	$cognome = mysqli_real_escape_string($db, $_POST['cognome']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$telefono = mysqli_real_escape_string($db, $_POST['telefono']);
	$dataNascita = mysqli_real_escape_string($db, $_POST['dataNascita']);
	$via = mysqli_real_escape_string($db, $_POST['via']);
	$stato = mysqli_real_escape_string($db, $_POST['stato']);
	$citta = mysqli_real_escape_string($db, $_POST['citta']);
	$CAP = mysqli_real_escape_string($db, $_POST['CAP']);
	$domandaSicurezza = mysqli_real_escape_string($db, $_POST['domandaSicurezza']);
	$rispostaSicurezza = mysqli_real_escape_string($db, $_POST['rispostaSicurezza']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$password = md5($password);
	$query2 = "UPDATE clienti, indirizzi SET clienti.nome = '$nome', clienti.cognome = '$cognome', clienti.email = '$email', 
					clienti.username = '$username', clienti.numero_di_telefono = '$telefono', clienti.data_nascita = '$dataNascita', 
					clienti.domanda_sicurezza = '$domandaSicurezza', clienti.risposta_sicurezza = '$rispostaSicurezza', 
					clienti.password = '$password', clienti.edit = 1, indirizzi.stato = '$stato', indirizzi.citta = '$citta', indirizzi.cap = '$CAP',
					indirizzi.via = '$via' WHERE clienti.id_indirizzo =  indirizzi.id AND clienti.id = " . $_GET['id'];
	mysqli_query($db, $query2);
	header("location: users.php");
}
?>

<html lang="it">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../res/img/logo.ico">

	<title>Pannello amministratore - Modifica cliente</title>

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
				<form class="form-signin text-center" method="post" action="">
					<h1 class="h3 mb-4 font-weight-normal">Modifica dati cliente</h1>
					<input type="text" id="inputNome" name="nome" value="<?php echo $datiCliente['nome'] ?>" class="form-control-dark" placeholder="Nome" required autofocus>
					<input type="text" id="inputCognome" name="cognome" value="<?php echo $datiCliente['cognome'] ?>" class="form-control-dark" placeholder="Cognome" required autofocus>
					<input type="email" id="inputEmail" name="email" value="<?php echo $datiCliente['email'] ?>" class="form-control-dark" placeholder="Email" required autofocus>
					<input type="text" id="inputUsername" name="username" value="<?php echo $datiCliente['username'] ?>" class="form-control-dark" placeholder="Username" required autofocus>
					<input type="text" id="inputNumero" name="telefono" value="<?php echo $datiCliente['numero'] ?>" class="form-control-dark" placeholder="Numero di telefono" required autofocus>
					<input type="date" id="inputDataNascita" name="dataNascita" value="<?php echo $datiCliente['data'] ?>" class="form-control-dark" placeholder="Data di nascita" required autofocus>
					<input type="text" id="inputIndirizzo" name="via" value="<?php echo $datiCliente['via'] ?>" class="form-control-dark" placeholder="Indirizzo" required autofocus>
					<input type="text" id="inputStato" name="stato" value="<?php echo $datiCliente['stato'] ?>" class="form-control-dark" placeholder="Stato" required autofocus>
					<input type="text" id="inputCitta" name="citta" value="<?php echo $datiCliente['citta'] ?>" class="form-control-dark" placeholder="Città" required autofocus>
					<input type="text" id="inputCAP" name="CAP" value="<?php echo $datiCliente['cap'] ?>" class="form-control-dark" placeholder="CAP" required autofocus>
					<input type="text" id="inputDomanda" name="domandaSicurezza" value="<?php echo $datiCliente['domanda'] ?>" class="form-control-dark" placeholder="Domanda di sicurezza" required autofocus>
					<input type="text" id="inputRisposta" name="rispostaSicurezza" value="<?php echo $datiCliente['risposta'] ?>" class="form-control-dark" placeholder="Risposta" required autofocus>
					<input type="text" id="inputPassword" name="password" class="form-control-dark" placeholder="Inserire nuova password" required autofocus>
					<small class="text-red">Il cliente deve cambiare la password al prossimo accesso</small>
					<br>
					<button class="btn btn-lg btn-primary btn-block mt-4" name="submit" type="submit">Modifica</button>
				</form>
			</main>
		</div>
	</div>

</body>

</html>