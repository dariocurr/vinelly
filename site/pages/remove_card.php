<?php
  include "session.php";
  if (isset($_POST['submit_card'])){
	$query1 = "SELECT id FROM carte WHERE codice  = '".$_POST['cardNumber']."'";
	$result = mysqli_query($db, $query1);
	$carta = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$query2 = "SELECT id FROM clienti WHERE username  = '".$_SESSION['user']."'";
	$result = mysqli_query($db, $query2);
	$cliente = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $query3 = "DELETE FROM cliente_carta WHERE id_carta = ".$carta['id']." AND id_cliente = ".$cliente['id'];
    mysqli_query($db, $query3);
    header('location: profile.php?editData=false');
  }
?>
