<?php 
	include "num_session.php";
	$q = intval($_GET['q']);

/*	echo $q;
	echo $s;*/

	if ($q == 2025)
	{
	    $_SESSION['model']->updateEmissions($q, 0.15);
	}

	if ($q == 2040)
	{
	    $_SESSION['model']->updateEmissions($q, 0.16);
	}

	if ($q == 2055)
	{
	    $_SESSION['model']->updateEmissions($q, 0.17);
	}

	$_SESSION['model']->displayScenario($q);
  
	//echo "<p>" . $_SESSION['emissions']->getInitialValue() . "</p>";

	//$_SESSION['emissions']->setInitialValue(10);

	//echo "<p>" . $_SESSION['emissions']->getInitialValue() . "</p>";

	// $_SESSION['emissions']->displayPredictions();

?>
