<!-- HEADER -->
<header>
	<?php
		include 'config.php';
		session_start()
	?>
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-purple">
		<a class="navbar-brand" href="index.php"><img src="../res/img/logo_all_white.png" height="41" widht="150"/></a>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="gallery.php?type=bianco">Bianchi</a>
				</li>
				<li class="nav-item ml-1">
					<a class="nav-link" href="gallery.php?type=rosso">Rossi</a>
				</li>
				<li class="nav-item ml-1">
					<a class="nav-link" href="gallery.php?type=rosato">Rosati</a>
				</li>
				<li class="nav-item ml-1">
					<a class="nav-link" href="gallery.php?type=spumante">Spumanti</a>
				</li>
				<li class="nav-item ml-1">
					<a class="nav-link" href="album.php">Prodotti</a>
				</li>
				<li class="nav-item ml-1">
					<a class="nav-link" href="about.php">Team</a>
				</li>
			</ul>
			<?php if($_SESSION["logged"] == 'true'){ ?>
				<a href="cart.php"><i class="fa fa-lg fa-shopping-cart mx-3"><button class="btn btn-outline-success my-2 my-sm-0 ml-1 mr-1"></button></i></a>
				<a href="profile.php"><i class="fa fa-lg fa-user mx-3"><button class="btn btn-outline-success my-2 my-sm-0 ml-1"></button></i></a>
				<a href="logout.php"><i class="fa fa-lg fa-sign-out mx-3"><button class="btn btn-outline-success my-2 my-sm-0 ml-1"></button></i></a>
			<?php } else { ?>
				<a href="signin.php"><button class="btn btn-outline-success my-2 my-sm-0 ml-1">Registrati</button></a>
				<a href="login.php"><i class="fa fa-lg fa-sign-in ml-2"><button class="btn btn-outline-success my-2 my-sm-0 ml-1"></button></i></a>
			<?php } ?>
		</div>
	</nav>
</header>
