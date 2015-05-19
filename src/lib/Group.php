<?php

class Group
{
	// every iteration is a 15 years increment
	const INCREMENT = 15;

	// last year for every iteration
	const LAST_YEAR = 2100;

	// first year for every iteration
	const FIRST_YEAR = 2010;

	//group name (oiriginally A-J)
	var $group_name;

	// hash table with decisions, income, net, total and alive for every given year
	var $data;

	// boolean or disaster object containing cost
	var $disaster;

	var $visibility;

	var $group_id;


	function Group($name, $id)
	{
		$this->group_name = $name;
		$this->group_id = $id;

		$group_variables = array(
			"decision" => null,
			"income" => 0,
			"net" => 0,
			"total" => 0,
			"alive" => true,
			"disaster" => null,
			"cost" => 0
			);

		$this->data = array(
			2010 => $group_variables,
			2025 => $group_variables,
			2040 => $group_variables,
			2055 => $group_variables,
			2070 => $group_variables,
			2085 => $group_variables,
			2100 => $group_variables);

		$this->visibility = false;
	}

	function displayGroup($year)
	{
		$this->calculateTotal($year);

		$disaster = "";
		$style = "";
		if ($this->data[$year]["disaster"] == true)
		{
			$disaster = "<span class='label label-danger' style='font-size: 1em;'><i class='fa fa-exclamation-triangle'></i>Harm<i class='fa'></i></span>";
			$style = " class='text-center harm'";
		}
		elseif (is_null($this->data[$year]["disaster"]) == false)
		{
			//$disaster = "<span class='label label-success' style='font-size: 1em;'><i class='fa fa-exclamation-triangle'></i>No Harm</span>";
			$disaster = "No Harm";
			$style = " class='text-center noHarm'";
		}

		$name = "group" . $this->group_name;
		$html_string = "<tr style='display:none;' class='groupRow' id='groupRow" . $this->group_id . "'>\n";

		$html_string .= "<td id='" . $name . "'> " . $this->group_name . "</td>" .
                "<td id='". $name ."Total'" . "class='text-center decisionRow'" . ">". $this->data[$year]["total"] . "</td>";
        if ($this->data[$year]["alive"] == true)
        	$html_string .= "<td class='text-center'>" .
                  "<select  class='choice' name='" . $this->group_name . "'>" .
                    "<option value='null'></option>" .
                    "<option value='0'>Prohibit (0)</option>" .
                    "<option value='1'>Restrict (1)</option>" .
                    "<option value='3'>Discourage (3)</option>" .
                    "<option value='5'>Maintain (5)</option>" .
                    "<option value='6'>Encourage (6)</option>" .
                  "</select>" .
                "</td>";
        else
        	$html_string .= "<td class='text-center decisionRow' style='background-color: #E74C3C; color: white;'> Economic Collapse </td>";
        

        $html_string .= "<td class='text-center decisionRow' style='background-color: #" . $this->decisionColor($year) . "; color: white;'>" . $this->currentDecision($year) . "</td>" . 
                "<td id='" . $name . "Income'" . "class='text-center decisionRow'" . ">" . $this->data[$year]["income"] . "</td>" .
                "<td id='" . $name . "Disaster'" . $style . ">" . $disaster . "</td>" .
                "<td id='" . $name . "Cost'" . "class='text-center decisionRow'" . ">" . $this->data[$year]["cost"] . "</td>" .
                "<td id='" . $name . "Net'" . "class='text-center decisionRow'" . ">" . $this->data[$year]["net"] . "</td>";

        //onchange='getChoice()'
        $html_string .= "</tr>";

		// if ($this->data[$year]["alive"] == true && $this->visibility == true)
		// if ($this->data[$year]["alive"] == true)
        	echo $html_string;
        // else
        // elseif ($this->data[$year]["alive"] == false && $this->visibility == true)
        	// echo "<tr style='background-color: #E74C3C; color: white;'><td>" . $this->group_name . "</td><td> DEAD </td></tr>";
	}

	function currentDecision($year)
	{
		switch ($this->data[$year]["decision"])
		{
			case null:
				return "None";
			case 0:
				return "Prohibited";
			case 1:
				return "Restricted";
			case 3:
				return "Discouraged";
			case 5:
				return "Maintained";
			case 6:
				return "Encouraged";
			default:
				return "Arrombado";
		}
	}

	function decisionColor($year)
	{
		switch ($this->data[$year]["decision"])
		{
			case null:
				return "white";
			case 0:
				return "00CCFF";
			case 1:
				return "0099FF";
			case 3:
				return "3366FF";
			case 5:
				return "6633FF";
			case 6:
				return "9900FF";
			default:
				return "black";
		}
	}

	function updateAll($year, $key)
	{
		try 
		{
			for ($x=$year+self::INCREMENT; $x<=self::LAST_YEAR; $x+=self::INCREMENT)
				$this->data[$x][$key] = $this->data[$year][$key];
		}
		catch (Exception $e)
		{
			echo 'Caught exception, idiota: ',  $e->getMessage(), "\n";
		}
	}

	function kill($year)
	{
		$this->data[$year]["alive"] = false;
		$this->updateAll($year, "alive");
	}

	function changeDecision($year, $value)
	{
		if ($value == 0 || $value == 1 || $value == 3 || $value == 5 || $value == 6)
		{
			$this->data[$year]["decision"] = $value;
			$this->updateIncome($year);
		}
		else
			echo "Os valores tão errados, retardado";
	}

	function updateIncome($year)
	{
		$this->data[$year]["income"] = $this->data[$year]["decision"];
		/*$this->data[$year]["total"] = $this->data[$year]["total"] + $this->data[$year]["income"];*/
		// $this->calculateTotal($year);
		// $this->updateAll($year, "total");
	}

	/**
	 * Calculate Total
	 *
	 * Updates the 'Total' variable, that represents how much that group currently has.
	 * This is called whenever a group is displayed.
	 *
	 * @param int $year - The year of the scenario that will be updated
	 */
	function calculateTotal($year)
	{
		$this->data[$year]["total"] = 0;
		for ($x=self::FIRST_YEAR + self::INCREMENT; $x<=$year; $x+=self::INCREMENT){
			$this->data[$year]["total"] = $this->data[$x - self::INCREMENT]["net"];
			$this->updateAll($year, "total");
		}
	}

	/**
	 * Calculate Cost
	 *
	 * 
	 *
	 * @param int $year - The year of the scenario that will be updated
	 */
	function calculateCost($year, $disaster, $risk)
	{
		$this->data[$year]["cost"] = (-($risk - $disaster));
		// echo "<p> This is the cost: " . $this->data[$year]["cost"] . "</p>";
		$this->calculateNet($year);
	}

	/**
	 * Calculate Net
	 *
	 * Updates the 'Net' variable, that represents how much that group has after
	 * the decisions were made and after the disaster scenario has taken place.
	 * I.e, it is the amount the group will have in the next round.
	 * This is called every time the disaster scenario is generated.
	 *
	 * @param int $year - The year of the scenario that will be updated
	 */
	function calculateNet($year)
	{
		$this->data[$year]["net"] = $this->data[$year]["total"] + $this->data[$year]["income"] + $this->data[$year]["cost"];

		if ($this->data[$year]["net"] < 0)
			$this->kill($year);
	}
}

?>