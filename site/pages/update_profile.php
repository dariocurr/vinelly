<?php
include "session.php";
if (isset($_POST['submit'])) {

	$user_check_query = "SELECT username,email FROM clienti WHERE username != '" . $_SESSION['user'] . "'";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	$err_usr = 0;
	$err_mail = 0;

	foreach ($user as $username) {
		if ($_POST['username'] == $username) {
			$err_usr = 1;
		}
	}
	foreach ($user as $email) {
		if ($_POST['email'] == $email) {
			$err_mail = 1;
		}
	}

	if ($err_usr == 0) {
		if ($err_mail == 0) {
			$user_check_query = "SELECT id_indirizzo,id FROM clienti WHERE username='" . $_SESSION['user'] . "'";
			$result = mysqli_query($db, $user_check_query);
			$address = mysqli_fetch_assoc($result);
			$id_indirizzo = $address['id_indirizzo'];

			$query = "UPDATE `indirizzi` SET `citta`= '" . $_POST['city'] . "',
                                       `cap` = '" . $_POST['CAP'] . "',
                                       `stato` = '" . $_POST['state'] . "',
                                       `via` = '" . $_POST['address'] . "'
                                   WHERE id = " . $id_indirizzo . "";
			//echo $query."\n";
			mysqli_query($db, $query);

			$query = "UPDATE `clienti` SET `nome` = '" . $_POST['name'] . "',
                                     `cognome` = '" . $_POST['surname'] . "',
                                     `email` = '" . $_POST['email'] . "',
                                     `username` = '" . $_POST['username'] . "',
                                     `numero_di_telefono` = '" . $_POST['number'] . "',
                                     `data_nascita` = '" . $_POST['date'] . "'
                                  WHERE id = " . $address['id'] . "
      ";
			$_SESSION['user'] = $_POST['username'];
			//echo $query;
			mysqli_query($db, $query);
			header('location: profile.php?');
		} else {
			header('location: profile.php?err=mail&editData=true');
		}
	} else {
		header('location: profile.php?err=usr&editData=true');
	}
}
