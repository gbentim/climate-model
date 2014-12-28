<?php 
	include "num_session.php";
	$q = intval($_GET['q']);

	$_SESSION['scenario']->display_table($q);
?>
