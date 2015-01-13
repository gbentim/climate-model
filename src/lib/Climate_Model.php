<?php
include "Scenario.php";
include "Group.php";


class Climate_Model
{
	// every iteration is a 15 years increment
	const INCREMENT = 15;

	// first year for every iteration
	const FIRST_YEAR = 2010;

	const INITIAL_EMISSIONS = 0.13;

	const MIN = 1;
	const MAX = 99;

	// array with 7 scenario objects
	var $scenarios;

	// array with 16 group objects
	var $groups;

	// disaster object
	var $disaster;

	//if scenarios need to be cloned
	var $should_clone;

	function Climate_Model()
	{
		$initial_scenario = new Scenario(2010);
		$this->scenarios = array(
			2010 => $initial_scenario,
			2025 => "",
			2040 => "",
			2055 => "",
			2070 => "",
			2085 => "",
			2100 => ""
		);

		$this->should_clone = array(
			2010 => false,
			2025 => true,
			2040 => true,
			2055 => true,
			2070 => true,
			2085 => true,
			2100 => true
		);

		$this->groups = array(
			"A" => new Group("A"),
			"B" => new Group("B"),
			"C" => new Group("C"),
			"D" => new Group("D"),
			"E" => new Group("E"),
			"F" => new Group("F"),
			"G" => new Group("G"),
			"H" => new Group("H"),
			"I" => new Group("I"),
			"J" => new Group("J"),
			"K" => new Group("K"),
			"L" => new Group("L"),
			"M" => new Group("M"),
			"N" => new Group("N"),
			"O" => new Group("O"),
			"P" => new Group("P")
		);
	}

	function displayScenario($year)
	{
		if ($this->should_clone[$year])
			$this->cloneScenario($year);

		// echo "<h2>" . $this->scenarios[$year]->current_year . "</h2>";
		echo "<table class='table'>" . 
			 "<tr>" .
			 "<th> Year </th>" .
			 "<th><a href='' class='years'>2010</a></th>" .
			 "<th><a href='' class='years'>2025</a></th>" .
			 "<th><a href='' class='years'>2040</a></th>" .
			 "<th><a href='' class='years'>2055</a></th>" .
			 "<th><a href='' class='years'>2070</a></th>" .
			 "<th><a href='' class='years'>2085</a></th>" .
			 "<th><a href='' class='years'>2100</a></th></tr>";

		$this->scenarios[$year]->displayTable();

		echo "</table>";
		echo "<table class='table'>";
		echo "<hr>";
		echo "<button type='button' class='btn btn-danger btn-block' id='danger'>Disaster</button>";
		echo "<hr>";
		$this->displayGroups($year);
		echo "</table>";
	}

	function displayGroups($year)
	{
		// "<tr><td></td></tr> <tr style='border-bottom: 1px solid #000;'><td> </td> </tr>" . 
		$header = "<tr>" .
          "<th> Group </th>" .
          "<th> Total $ </th>" .
          "<th> Develop </th>" .
          "<th> Decision </th>" .
          "<th> Income </th>" .
          "<th> Disaster </th>" .
          "<th> Cost </th>" .
          "<th> Net </th>" .
        "</tr>";

        echo $header;
		foreach ($this->groups as $key => $value)
			$value->displayGroup($year);
	}

	function cloneScenario($year)
	{
		if ($year != self::FIRST_YEAR && $this->scenarios[$year-self::INCREMENT] == "")
			$this->scenarios[$year] = clone $this->scenarios[self::FIRST_YEAR];
		else
		{
			$this->scenarios[$year] = clone $this->scenarios[$year - self::INCREMENT];
			$this->should_clone[$year] = false;
		}
		$this->scenarios[$year]->setCurrentYear($year);
	}

	function updateEmissions($year, $value)
	{
		if ($this->should_clone[$year])
			$this->cloneScenario($year);

		if ($year == self::FIRST_YEAR)
			$previous = self::INITIAL_EMISSIONS;
		else
		{
			$previous = $this->scenarios[$year]->climate_variables["Emissions_Growth"]->predictions[$year - self::INCREMENT];
			$previous = $previous*(($previous/4)+1);
		}

		$new_emissions = $previous - (0.01 * (5 - $value));
		// echo "O que ta pegando...  Valor anterior: " . $previous;
		// echo "Valor average: " . $value;
		$this->scenarios[$year]->setEmissionsGrowth($new_emissions);
		$this->should_clone[$year + self::INCREMENT] = true;
	}

	function calculateAverage($year)
	{
		$total = 0;
		$num_groups = 0;
		foreach ($this->groups as $key => $value)
		{
			if ($value->data[$year]["decision"] != null)
			{
				$total = $total + $value->data[$year]["decision"];
				$num_groups++;
			}
		}

		return $total / $num_groups;
	}

	function changeGroupDecision($name, $year, $value)
	{		
		$this->groups[$name]->changeDecision($year, $value);

		$average = $this->calculateAverage($year);

		// echo "This is the average: " . $average;

		$this->updateEmissions($year, $average);
	}

	function createDisasterScenario($year)
	{
		foreach ($this->groups as $key => $value)
			if ($value->data[$year]["decision"] != null)
				$this->generateDisaster($value->group_name, $year);
	}

	function generateDisaster($group, $year)
	{
		$disaster = rand (self::MIN, self::MAX);
		$risk = round($this->scenarios[$year]->climate_variables["Disaster_Risk"]->predictions[$year]);

		if ($disaster > $risk)
		{
			$this->groups[$group]->data[$year]["disaster"] = false;
			$this->groups[$group]->data[$year]["cost"] = 0;
			$this->groups[$group]->calculateNet($year);
		}
		else
		{
			$this->groups[$group]->data[$year]["disaster"] = true;
			$this->groups[$group]->calculateCost($year, $disaster, $risk);
		}

		// echo "<p> Group: " . $group . "</p>";
		// echo "<p> The disaster scenario is: " . $disaster . "</p>";
		// echo "<p> The disaster risk is: " . $risk . "</p>";
	}

	function setNumberGroups($num)
	{
		$count = 0;
		foreach ($this->groups as $key => $value) 
		{
			if ($num > $count)
			{
				$value->visibility = true;
				$count++;
			}
			else
			{
				$value->visibility = false;
				$count++;
			}
		}	
	}
}

?>