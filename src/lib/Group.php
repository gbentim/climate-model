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


	function Group($name)
	{
		$this->group_name = $name;

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
		$disaster = "";
		$style = "";
		if ($this->data[$year]["disaster"] == true)
		{
			$disaster = "Se ferrou mane";
			$style = "style='background-color: red; color: white;'";
		}
		elseif (is_null($this->data[$year]["disaster"]) == false)
		{
			$disaster = "de boa na lagoa";
			$style = "style='background-color: green; color: white;'";
		}

		$name = "group" . $this->group_name;
		$html_string = "<tr>\n";

		$html_string .= "<td id='" . $name . "'> " . $this->group_name . "</td>" .
                "<td id='". $name ."Total'>". $this->data[$year]["total"] . "</td>" .
                "<td>" .
                  "<select  class='choice' name='" . $this->group_name . "'>" .
                    "<option value='null'>Default</option>" .
                    "<option value='0'>Prohibit</option>" .
                    "<option value='1'>Restrict</option>" .
                    "<option value='3'>Discourage</option>" .
                    "<option value='5'>Maintain</option>" .
                    "<option value='6'>Encourage</option>" .
                  "</select>" .
                "</td>" .
                "<td>" . $this->currentDecision($year) . "</td>" . 
                "<td id='" . $name . "Income'>" . $this->data[$year]["income"] . "</td>" .
                "<td id='" . $name . "Disaster'" . $style . ">" . $disaster . "</td>" .
                "<td id='" . $name . "Cost'>" . $this->data[$year]["cost"] . "</td>" .
                "<td id='" . $name . "Net'> ". $this->data[$year]["net"] . "</td>";

        //onchange='getChoice()'
        $html_string .= "</tr>";

		if ($this->data[$year]["alive"] == true && $this->visibility == true)
        	echo $html_string;
        elseif ($this->data[$year]["alive"] == false && $this->visibility == true)
        	echo "<tr style='background-color: red; color: white;'><td>" . $this->group_name . "</td><td> DEAD </td></tr>";
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
				return "Maintaned";
			case 6:
				return "Encouraged";
			default:
				return "Arrombado";
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

	function calculateTotal($year)
	{
		$this->data[$year]["total"] = 0;
		for ($x=self::FIRST_YEAR; $x<=$year; $x+=self::INCREMENT){
			$this->data[$year]["total"] = $this->data[$year]["total"] + $this->data[$x]["net"];
			$this->updateAll($year, "total");
		}
		if ($this->data[$year]["total"] < 0)
			$this->kill($year);
	}

	function calculateCost($year, $disaster, $risk)
	{
		$this->data[$year]["cost"] = round(-($risk - $disaster)/10);
		// echo "<p> This is the cost: " . $this->data[$year]["cost"] . "</p>";
		$this->calculateNet($year);
	}

	function calculateNet($year)
	{
		$this->data[$year]["net"] = $this->data[$year]["income"] + $this->data[$year]["cost"];
		$this->calculateTotal($year);
	}
}

?>