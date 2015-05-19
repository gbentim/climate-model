<?php 
	include "config.php";

	if (isset($_GET['reset']) == true)
		if (session_destroy())
			print "A new game has started.\n";

	if (isset($_GET['year']))
		$year = intval($_GET['year']);

	if (isset($_GET['groups_decisions']))
	{
		$_SESSION['model']->changeGroupsDecision($_GET['groups_decisions'], $year);
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
