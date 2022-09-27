<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
	<a class="navbar-brand col-sm-3 col-md-2 mr-0">Vinelly</a>
	<?php
	session_start();
	if ($_SESSION['logged_admin'] == 'true') { ?>
		<a href="panel_logout.php"><i class="fa fa-lg fa-sign-out"><button class="btn btn-outline-success my-2 my-sm-0 ml-1"></button></i></a>
	<?php } ?>
</nav>