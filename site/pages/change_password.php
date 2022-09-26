<?php
	include 'session.php';
	if(isset($_POST['submit3'])){

		$query = "SELECT password FROM clienti WHERE username='".$_SESSION['user']."'";
		//echo $query;
	  $result = mysqli_query($db, $query);
	  $pass = mysqli_fetch_assoc($result);

		//echo md5($_POST['psw'])." - ".$pass['password'];
		if(md5($_POST['psw']) == $pass['password']){
			if($_POST['newPsw'] == $_POST['newPsw2']){
				$query = "UPDATE `clienti` SET `password` = '".md5($_POST['newPsw'])."'
			                             WHERE username = '".$_SESSION['user']."'
			  ";
				//echo $query;
			  mysqli_query($db, $query);
				header("location: profile.php?change=success");
			}else{
				header("location: profile.php?err=incorrect&change=psw");
			}
		}else{
			header("location: profile.php?err=oldPs&change=psw");
		}
	}
?>
