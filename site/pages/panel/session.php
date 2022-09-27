<?php
session_start();
include '../config.php';
if ($_SESSION['logged_admin'] != 'true') {
	header("location: index.php");
}
