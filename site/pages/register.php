<?php
include "session.php";
if (isset($_POST['submit'])) {

	$user_check_query = "SELECT * FROM clienti";
	$result = mysqli_query($db, $user_check_query);
	$count = mysqli_num_rows($result);

	while ($count > 0) {
		$user = mysqli_fetch_assoc($result);
		if ($_POST['username'] == $user['username']) {
			$err_usr = 1;
		}
		if ($_POST['email'] == $user['email']) {
			$err_mail = 1;
		}
		$count--;
	}

	if ($err_usr == 0) {
		if ($err_mail == 0) {
			if ($_POST['password'] == $_POST['password2']) {
				$nome = mysqli_real_escape_string($db, $_POST['name']);
				$cognome = mysqli_real_escape_string($db, $_POST['surname']);
				$email = mysqli_real_escape_string($db, $_POST['email']);
				$username = mysqli_real_escape_string($db, $_POST['username']);
				$numero = mysqli_real_escape_string($db, $_POST['number']);
				$password = mysqli_real_escape_string($db, $_POST['password']);
				$passwordCriptata = md5($password);
				$data = mysqli_real_escape_string($db, $_POST['date']);
				$domanda = mysqli_real_escape_string($db, $_POST['question']);
				$risposta = mysqli_real_escape_string($db, $_POST['answer']);
				$stato = mysqli_real_escape_string($db, $_POST['state']);
				$citta = mysqli_real_escape_string($db, $_POST['city']);
				$cap = mysqli_real_escape_string($db, $_POST['CAP']);
				$via = mysqli_real_escape_string($db, $_POST['address']);
				$query1 = "SELECT * FROM indirizzi WHERE stato = '$stato' AND citta = '$citta' AND cap = '$cap' AND via = '$via'";
				$result1 = mysqli_query($db, $query1);
				$count = mysqli_num_rows($result1);
				if ($count == 0) {
					$query2 = "INSERT INTO indirizzi (stato, citta, cap, via) VALUES ('$stato', '$citta', '$cap', '$via')";
					mysqli_query($db, $query2);
				}
				$query3 = "SELECT id FROM indirizzi WHERE stato = '$stato' AND citta = '$citta' AND cap = '$cap' AND via = '$via'";
				$result3 = mysqli_query($db, $query3);
				$row = mysqli_fetch_assoc($result3);
				$addressID = $row['id'];
				$query4 = "INSERT INTO clienti (nome, cognome, email, username, id_indirizzo, numero_di_telefono, password, data_nascita,
											domanda_sicurezza, risposta_sicurezza, edit)
						VALUES ('$nome', '$cognome', '$email', '$username', '$addressID', '$numero', '$passwordCriptata', '$data', '$domanda', '$risposta', 0)";
				mysqli_query($db, $query4);
				$query5 = "SELECT id FROM clienti WHERE username='" . $username . "'";
				$result5 = mysqli_query($db, $query5);
				$user = mysqli_fetch_assoc($result5);
				$userID = $user['id'];
				$queryCreazioneCarrello = "INSERT INTO carrello (id_cliente) VALUES ($userID)";
				mysqli_query($db, $queryCreazioneCarrello);
				header('location: welcome.php');

				/* Parte dell'invio della mail
			$nome_mittente = "Vinelly";
			$mail_mittente = "support@vinelly.it";
			$mail_oggetto = "Vinelly - Registrazione completata";
			$mail_destinatario = $email;
			$mail_corpo = "Ti sei registrato a Vinelly.it\n\n Username: ".$username."\nPassword".$password."\n\nComincia ad acquistare";
			$mail_headers = "Da: ".$nome_mittente." < " .$mail_mittente.">\r\n";
			$mail_headers .= "Inviata a : ".$mail_mittente."\r\n";
			$mail_headers .= "MIME-Version: 1.0\r\n";
			$mail_headers .= "Content-type: charset=iso-8859-1";
			if(mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers)) {
				header('location: welcome.php');
			} else {
				header('location: signin.php?sent=0');
			}
			*/
			} else {
				header('location: signin.php?err=incorrect');
			}
		} else {
			header('location: signin.php?err=mail');
		}
	} else {
		header('location: signin.php?err=usr');
	}
}
