<?php
if ( isset( $_GET['logout'] ) ) {
    session_start();
	$_SESSION['loggedin'] = false;
	$_SESSION['username'] = false;
	$_SESSION['role'] = false;
	session_destroy();
	header('location:index.php');
}