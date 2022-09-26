<!doctype html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../res/img/icon.ico">

		<title>Vinelly - Registrati</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/common.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/login.css" rel="stylesheet">
	</head>
	<!-- HEADER -->
			<?php
					include "register.php";
					include "header.php";
			?>
	<body class="text-center-bk">

		<form class="form-signin mt-0" method="post" action="">
			<h1 class="h3 mb-3 font-weight-normal">Per cominciare ad acquistare, registrati</h1>
			<input type="text" id="inputName" name="name" class="form-control mb-1" placeholder="Nome" required autofocus>
			<input type="text" id="inputSurname" name="surname" class="form-control mb-1" placeholder="Cognome" required autofocus>
			<input type="email" id="inputEmail" name="email" class="form-control mb-1" placeholder="Email" required autofocus>
			<?php if($_GET['err'] == 'mail') {?> <h6 class="mb-3 font-weight-normal text-red">Email già registrata</h6> <?php } ?>
			<input type="text" id="inputUsername" name="username" class="form-control mb-1" placeholder="Username" required autofocus>
			<?php if($_GET['err'] == 'usr') {?> <h6 class="mb-3 font-weight-normal text-red">Username già in uso</h6> <?php } ?>
			<input type="date" id="inputDate" name="date" value="1980-01-01" class="form-control mb-1" placeholder="Data di nascita" required autofocus>
			<input type="text" id="inputNumber" name="number" class="form-control mb-1" placeholder="Numero di telefono" required autofocus>
			<input type="text" id="inputAddress" name="address" class="form-control mb-1" placeholder="Indirizzo principale" required autofocus>
            <input type="text" id="inputState" name="state" class="form-control mb-1" placeholder="State" novalidate>
            <input type="text" id="inputCity" name="city" class="form-control mb-1" placeholder="Città" required autofocus>
            <input type="text" id="inputCAP" name="CAP" class="form-control mb-1" placeholder="CAP" required autofocus>
			<select class="form-control custom-select-signin mb-1" name="question" size="1" required>
				<option value="Nome del primo animale domestico">Nome del primo animale domestico</option>
				<option value="Nome della madre">Nome della madre</option>
				<option value="Nome della città di nascita">Nome della città di nascita</option>
				<option value="Nome del primo compagno di banco">Nome del primo compagno di banco</option>
			</select>
			<input type="question" id="" name="answer" class="form-control mb-1" placeholder="Risposta" required autofocus>
			<?php if($_GET['err'] == 'incorrect') {?> <h6 class="mb-3 font-weight-normal text-red">Le due password non coincidono</h6> <?php } ?>
			<input type="password" id="inputPassword" name="password" class="form-control mb-1 " placeholder="Password" required autofocus>
			<input type="password" id="inputPassword" name="password2" class="form-control mb-1" placeholder="Ripeti password" required autofocus>
			<br>
			<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Registrati</button>
		</form>
		<!-- FOOTER -->
        <?php
            include "footer.php";
        ?>
	</body>
</html>
