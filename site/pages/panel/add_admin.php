<!doctype html>

<?php
	include "session.php";
	if(isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$query = "SELECT * FROM admin WHERE username = '$username'";
		$result = mysqli_query($db, $query);
		$count = mysqli_num_rows($result);
		if($count == 0) {
			$password = md5($password);
			$query = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
			$result = mysqli_query($db, $query);
			if($result) {
				header("location: add_admin.php");
			} else {
				header("location: add_admin.php?error=1");
			}
		} else {
			header("location: add_admin.php?error=2");
		}	
	}
?>

<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../res/img/icon.ico">

    <title>Pannello amministratore - Aggiungi amministratore</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/common.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/panel.css" rel="stylesheet">
  </head>

  <body>

	<?php
		include "session.php";
		include "panel_header.php";
	?>

    <div class="container-fluid">
      <div class="row">
        <?php
			include "panel_sidebar.php";
		?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<form class="form-signin text-center" method="post" action="">
				<h1 class="h3 mb-4 font-weight-normal">Aggiungi un amministratore</h1>
				<input type="text" id="inputUsername" name="username" class="form-control-dark" placeholder="Username" required autofocus>
				<input type="password" id="inputPassword" name="password" class="form-control-dark" placeholder="Password" required autofocus>
				<br>
				<?php if($_GET['error'] == 1) { ?>
					<h6 class="mb-3 font-weight-normal text-red">Inserimento non riuscito</h6>
				<?php } else if($_GET['error'] == 2) { ?>
					<h6 class="mb-3 font-weight-normal text-red">Username già presente nel database</h6>
				<?php } ?>
				<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Inserisci nuovo ammistratore</button>
			</form>
        </main>

      </div>
    </div>

    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Bootstrap core JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Font Awesome icons (free version) -->
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>

  </body>
</html>
