<?php 
	include "config.php";

	if (isset($_GET['year']))
		$year = intval($_GET['year']);

	if (isset($_GET['group_value']) && isset($_GET['group_name']))
	{
		$name = $_GET['group_name'];
		$value = $_GET['group_value'];
		$_SESSION['model']->changeGroupDecision($name, $year, $value);
	}

	if (isset($_GET['disaster']) == true)
	{
		$_SESSION['model']->createDisasterScenario($year);
	}

	if (isset($_GET['num_groups']))
	{
		$_SESSION['model']->setNumberGroups($_GET['num_groups']);
	}

	$_SESSION['model']->displayScenario($year);
?>
