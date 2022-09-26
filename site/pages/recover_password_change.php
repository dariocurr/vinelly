<?php 
	include 'config.php';
	session_start();
    if(isset($_POST['submit'])){
  		if($_POST['newPsw'] == $_POST['newPsw2']){
			$query = "";
			$password = md5($_POST['newPsw']);
			if($_SESSION['logged'] == 'true') {
				$query = "UPDATE clienti SET password = '".$password."', edit = 0 WHERE username = '".$_SESSION['user']."'";
				header("location: index.php");
			} else {
				$query = "UPDATE clienti SET password = '".$password."', edit = 0 WHERE id = '".$_SESSION['tmp_id']."'";
				header("location: welcome.php?change=success");
			}
  			mysqli_query($db, $query);
  		}else{
  			header("location: recover_password_change.php?err=incorrect");
  		}
  	}
?>

<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../res/img/icon.ico">
		
		<?php
			$title = "Vinelly - ";
			if($_SESSION['logged'] == 'true') {
				$title .="Cambia password";
			} else {
				$title .="Recupera password";
			}
		?>
		<title><?php echo $title?></title>

		<!-- Bootstrap core CSS -->
		<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />

		<!-- Custom styles for this template -->
		<link href="../css/login.css" rel="stylesheet">
	</head>
	<body class="text-center">
        <!-- HEADER -->
        <?php
            include "header.php";
        ?>
        <form class="form-signin" method="POST" action="recover_password_change.php">
          <img class="mb-4" src="../res/img/logo_single_small.png" alt="" width="150" height="150">
			<?php
				$messaggio = "";
				if($_SESSION['logged'] == 'true') {
					$messaggio .="Devi cambiare la tua password";
				} else {
					$messaggio .="Recupera la tua password";
				}
			?>
    	  <h1 class="h3 mb-3 font-weight-normal"><?php echo $messaggio?></h1>
          <?php if($_GET['err'] == 'incorrect') {?> <h6 class="mb-3 font-weight-normal text-red">Le due password non coincidono</h6> <?php } ?>
          <input type="password" id="inputNewPassword" name="newPsw" class="form-control mb-1 bg-white" placeholder="Nuova password" required autofocus>
          <input type="password" id="inputNewPassword2" name="newPsw2" class="form-control mb-1 bg-white" placeholder="Ripeti password" required autofocus>
          <br>
          <button type="submit" class="btn btn-lg btn-primary btn-block" name="submit">Salva</button>
        </form>
        <!-- FOOTER -->
        <?php
            include "footer.php";
        ?>
	</body>
</html>
