<!doctype html>
<?php
  include 'session.php';
    if(isset($_POST['submit'])) {
      header("location:payment_successful.php");
    }
?>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../res/img/logo.ico">

		<title>PayPal</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/common.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/login.css" rel="stylesheet">
	</head>
	<body class="text-center">
		<form class="form-signin" method="post" action="">
			<img class="mb-4" src="../res/img/paypal.png">
			<h1 class="h3 mb-3 font-weight-normal" >Effettua il login</h1>
			<input type="email" class="form-control" style="border-color: transparent; box-shadow: none" id="username" name="username" placeholder="email" required>
			<div class="invalid-feedback" style="width: 100%;">
					La tua email è necessaria
			</div>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="password" class="form-control mb-0" style="border-color: transparent; box-shadow: none" placeholder="Password" required>
			<br>
			<button class="btn btn-lg btn-paypal btn-block" name="submit" type="submit">Login</button>
			<br>
    </form>
	</body>
</html>
