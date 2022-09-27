<!doctype html>

<?php
include "session.php";
$query1 = "SELECT * FROM coupon";
$result = mysqli_query($db, $query1);
$count = mysqli_num_rows($result);
$i = 0;
if ($_GET['remove'] > 0) {
	$query2 = "DELETE FROM coupon WHERE id = " . $_GET['remove'];
	mysqli_query($db, $query2);
	header("location: coupon.php");
}
?>

<html lang="it">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../res/img/logo.ico">

	<title>Pannello amministratore - Coupon</title>

	<!-- Bootstrap core CSS -->
	<link href="../css/common.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="../../css/panel.css" rel="stylesheet">
</head>

<body>

	<?php
	include "panel_header.php";
	?>

	<div class="container-fluid">
		<div class="row">
			<?php
			include "panel_sidebar.php";
			?>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 text-center">
				<h2>Coupon</h2>
				<div class="table-responsive mt-4">
					<table class="table table-striped table-sm" style="width: 50%" align="center">
						<thead>
							<tr>
								<th>ID</th>
								<th>Codice</th>
								<th>Importo</th>
								<th>Rimuovi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($i < $count) {
								$row = mysqli_fetch_assoc($result);
							?>
								<tr>
									<td><?php echo $row['id'] ?></td>
									<td><?php echo $row['codice'] ?></td>
									<td><?php echo $row['importo_sconto'] ?></td>
									<td>
										<a class="mt-2 move-button" href="coupon.php?remove=<?php echo $row['id'] ?>">
											<i class="fa fa-remove remove-product"><button class="btn btn-outline-success"></button></i>
										</a>
									</td>
								</tr>
							<?php
								$i++;
							} ?>
						</tbody>
					</table>
				</div>
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