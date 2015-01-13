<?php

class Climate_Variable
{	
	// every iteration is a 15 years increment
	const INCREMENT = 15;

	// initial value that calculations will derive from
	var $initial_value;
	
	// the year in question
	var $current_year;

	// hash table with all prediction values
	var $predictions;

	// name of the variable to be displayed
	var $name;

	// choose the formatting option for display
	var $formatting_options;

	function Climate_Variable($name, $year, $value, $option) 
	{
		$this->name = $name;
		$this->current_year = $year;
		$this->initial_value = $value;

		$this->predictions = array(
			2010 => 0,
			2025 => 0,
			2040 => 0,
			2055 => 0,
			2070 => 0,
			2085 => 0,
			2100 => 0
			);

		$this->formatting_options = $option;
		$this->predictions[$this->current_year] = $this->initial_value;
	}

	function setInitialValue($value) 
	{
		$this->initial_value = $value;

		$this->update();
	}

	function setCurrentYear($year)
	{
		$this->current_year = $year;
	}

	function getInitialValue() 
	{
		return $this->initial_value;
	}

	function displayPredictions()
	{
		$html_string = "<tr>\n";
		$html_string .= "<td>" . $this->name .  "</td>";

		$year_id = 2010;
		$style = "";
		foreach ($this->predictions as $key => $value) 
		{
			if ($year_id  == $this->current_year)
				$style = " style='border: 2px solid black'";
			else
				$style = "";

			$html_string .= "<td class='col" . $year_id . "'" . $style . ">" . $this->convertDisplay($value) . "</td>";
			$year_id = $year_id + self::INCREMENT;
		}
		$html_string .= "</tr>\n";

		echo $html_string;
	}

	function convertDisplay($value)
	{
		$str;
		switch ($this->formatting_options)
		{
			case "percentage":
				$str = round($value*100, 1) . "%";
				break;
			case "round2decimals":
				$str = round($value, 2);
				break;
			case "round":
				$str = round($value);
				break;
			default:
				$str = $value;
				break;
		}
		return $str;
	}

}

?>