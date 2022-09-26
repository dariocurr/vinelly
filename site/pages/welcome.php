<!doctype html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../res/img/logo.ico">

		<title>Vinelly - Registrazione effettuata</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/common.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/product.css" rel="stylesheet">
	</head>
	<body class="bg-normal">
	<!-- HEADER -->
		<?php
			include "header.php";
		?>
		<div class="position-relative overflow-hidden text-center mt-5 pt-5 mb-3">
		  <div class="col-md-5 p-lg-1 mx-auto my-1">
				<img class="featurette-image img-fluid mx-auto" src="../res/img/welcome.png" style="max-width: 300px; max-height: 300px;">
		  </div>
		</div>
		<div class="text-center">
			<?php if(isset($_GET['change'])) { ?>
				<h4 class="mb-2">Cambio password effettuato<h4>
			<?php } else { ?>
				<h4 class="mb-2">Registrazione effettuata<h4>
			<?php } ?>
			<a href="login.php"><button class="mb-4 mt-2 btn btn-lg btn-primary">Effettua il login</button><a>
		</div>
	<!-- FOOTER -->
        <?php
            include "footer.php";
        ?>
	</body>
</html>
