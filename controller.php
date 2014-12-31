<?php 
	include "num_session.php";
/*	$year = intval($_GET['q']);*/

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
		// echo "<h2> the number of groups selected is: " . $_GET['num_groups'];
		$_SESSION['model']->setNumberGroups($_GET['num_groups']);
	}

	$_SESSION['model']->displayScenario($year);



/*	echo $year;
	echo $s;*/

	// if ($year == 2025)
	// {
	//     $_SESSION['model']->updateEmissions($year, 1);
	// }

	// if ($year == 2040)
	// {
	//     $_SESSION['model']->updateEmissions($year, 3);
	// }

	// if ($year == 2055)
	// {
	//     $_SESSION['model']->updateEmissions($year, 5);
	// }


	// $_SESSION['model']->groups["A"]->kill($year);
	// $_SESSION['model']->groups["B"]->kill(2025);
	// $_SESSION['model']->groups["C"]->kill(2040);
	// $_SESSION['model']->groups["D"]->kill(2055);
	// $_SESSION['model']->groups["E"]->kill(2070);

	// $_SESSION['model']->groups["F"]->changeDecision(2010, 6);


  
	//echo "<p>" . $_SESSION['emissions']->getInitialValue() . "</p>";

	//$_SESSION['emissions']->setInitialValue(10);

	//echo "<p>" . $_SESSION['emissions']->getInitialValue() . "</p>";

	// $_SESSION['emissions']->displayPredictions();

?>
