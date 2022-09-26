<?php
	include 'config.php';
	session_start();
	if($_SESSION['logged'] == 'true') {
		$username = $_SESSION['user'];
		$queryUser = "SELECT edit FROM clienti WHERE username = '$username'";
		$resultUser = mysqli_query($db, $queryUser);
		$user = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);
		if($user['edit'] == 1) {
			header("location: recover_password_change.php");
		}
	}
   /*
   $user_check = $_SESSION['user'];
   $ses_sql = mysqli_query($db,"select username from clienti where username = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['username'];

   if(!isset($_SESSION['user'])){
      header("location:login.php");
      die();
   }
   */
?>
