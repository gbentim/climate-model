<?php
include "/lib/Climate_Model.php";

session_start();

if(!isset($_SESSION['model']))
	$_SESSION['model']= new Climate_Model();
?>