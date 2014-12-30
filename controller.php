<?php 
	include "num_session.php";
/*	$year = intval($_GET['q']);*/

	if (isset($_GET['year']))
		$year = intval($_GET['year']);



/*	echo $year;
	echo $s;*/

	if ($year == 2025)
	{
	    $_SESSION['model']->updateEmissions($year, 0.15);
	}

	if ($year == 2040)
	{
	    $_SESSION['model']->updateEmissions($year, 0.16);
	}

	if ($year == 2055)
	{
	    $_SESSION['model']->updateEmissions($year, 0.17);
	}


	$_SESSION['model']->groups["A"]->kill($year);
	$_SESSION['model']->groups["B"]->kill(2025);
	$_SESSION['model']->groups["C"]->kill(2040);
	$_SESSION['model']->groups["D"]->kill(2055);
	$_SESSION['model']->groups["E"]->kill(2070);

	$_SESSION['model']->groups["F"]->changeDecision(2010, 6);

	$_SESSION['model']->displayScenario($year);
  
	//echo "<p>" . $_SESSION['emissions']->getInitialValue() . "</p>";

	//$_SESSION['emissions']->setInitialValue(10);

	//echo "<p>" . $_SESSION['emissions']->getInitialValue() . "</p>";

	// $_SESSION['emissions']->displayPredictions();

?>
