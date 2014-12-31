<?php
// include "Scenario.php";
include "Climate_Model.php";
// $model = new Climate_Model();
// $emissions_growth = new Emissions_Growth(2010, 0.13);

// $scenario_model->change_decision(1, 6);
session_start();



if(!isset($_SESSION['model']))
	$_SESSION['model']= new Climate_Model();

// if(!isset($_SESSION['emissions']))
// 	$_SESSION['emissions']= $emissions_growth;

?>

