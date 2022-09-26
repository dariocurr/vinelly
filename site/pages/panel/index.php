<!doctype html>
<?php
  include '../session.php';
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);
    $mypassword = md5($mypassword);

    $sql = "SELECT id FROM admin WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        //session_register("myusername");
        $_SESSION['user'] = $myusername;
        $_SESSION['logged_admin'] = 'true';
        header("location: products.php");
      }else {
        $_SESSION['logged_admin'] = 'false';
         header("location: index.php?error=1");
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

    <title>Vinelly - Pannello amministratore</title>

    <!-- Bootstrap core CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />

    <!-- Custom styles for this template -->
    <link href="../../css/panel.css" rel="stylesheet">
  </head>

  <body>

	<?php
		include "panel_header.php";
	?>

	<form class="form-signin text-center" style="margin-top: 6rem" method="POST" action="">
		<img class="mb-4" src="../../res/img/logo_single_small.png" alt="" width="150" height="150">
		<h1 class="h3 mb-3 font-weight-normal">Effettua il login</h1>
    <?php if($_GET['error'] == 1) { ?>
      <h6 class="mb-3 font-weight-normal text-red">Accesso non riuscito</h1>
    <?php } ?>
    <div class="mb-0">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">@</span>
        </div>
        <input type="text" class="form-control" id="username" name="username" placeholder="MarioRossi" required>
        <div class="invalid-feedback" style="width: 100%;">
          Il tuo username è richiesto
        </div>
      </div>
    </div>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control mb-0" placeholder="Password" required>
		<br>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	</form>

  </body>
</html>
