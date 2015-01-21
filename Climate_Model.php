<?php
/**
 * Page-level DocBlock
 */
class Climate_Model
{
	/**
	 * Page-level DocBlock
	 */
	const INCREMENT = 15;

	/**
	 * Page-level DocBlock
	 */
	const FIRST_YEAR = 2010;

	const INITIAL_EMISSIONS = 0.13;

	const MIN = 1;
	const MAX = 99;

	/**
	 * Page-level DocBlock
	 */
	 var $scenarios;

	 /**
	  * Page-level DocBlock
	  */
	var $groups;

	/**
	 * Page-level DocBlock
	 */
	var $disaster;

	/**
	 * Page-level DocBlock
	 */
	var $should_clone;

	/**
	 * Page-level DocBlock
	 */
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
			"A" => new Group("A", 1),
			"B" => new Group("B", 2),
			"C" => new Group("C", 3),
			"D" => new Group("D", 4),
			"E" => new Group("E", 5),
			"F" => new Group("F", 6),
			"G" => new Group("G", 7),
			"H" => new Group("H", 8),
			"I" => new Group("I", 9),
			"J" => new Group("J", 10),
			"K" => new Group("K", 11),
			"L" => new Group("L", 12),
			"M" => new Group("M", 13),
			"N" => new Group("N", 14),
			"O" => new Group("O", 15),
			"P" => new Group("P", 16)
		);
	}

	/**
	 * Page-level DocBlock
	 */
	function displayScenario($year)
	{
		if ($this->should_clone[$year])
			$this->cloneScenario($year);

		echo "<table class='table' id='main-table'>" . 
			 "<tr>" .
			 "<th class='main-header'> Year </th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2010'>2010</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2025'>2025</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2040'>2040</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2055'>2055</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2070'>2070</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2085'>2085</a></th>" .
			 "<th class='main-header text-center'><a href='' class='years' id='year2100'>2100</a></th></tr>";

		$this->scenarios[$year]->displayTable();

		echo "</table>";

		echo " <div class='container' id='getDisaster'>" .
		   	 "  <button type='button' class='btn btn-danger' id='danger'><i class='fa fa-bolt'></i>Check Disaster</button>" .
	    	 " </div>";


		echo "<table class='table'>";
		echo "<hr>";
		$this->displayGroups($year);
		echo "</table>";
	}

	function displayGroups($year)
	{
		$header = "<tr>" .
          "<th class='main-header'> Group </th>" .
          "<th class='main-header text-center'> Total $ </th>" .
          "<th class='main-header text-center'> Develop </th>" .
          "<th class='main-header text-center'> Decision </th>" .
          "<th class='main-header text-center'> Income </th>" .
          "<th class='main-header text-center'> Disaster </th>" .
          "<th class='main-header text-center'> Cost </th>" .
          "<th class='main-header text-center'> Net </th>" .
        "</tr>";

        echo $header;
		foreach ($this->groups as $key => $value)
			$value->displayGroup($year);

	}

	/**
	 * Page-level DocBlock
	 */
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

	/**
	 * Page-level DocBlock
	 */
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

	// function setNumberGroups($num)
	// {
	// 	$count = 0;
	// 	foreach ($this->groups as $key => $value) {
	// 		if ($num > $count)
	// 		{
	// 			$value->visibility = true;
	// 			$count++;
	// 		}
	// 		else
	// 		{
	// 			$value->visibility = false;
	// 			$count++;
	// 		}
	// 	}	
	// }


}

class Scenario
{
	// every iteration is a 15 years increment
	const INCREMENT = 15;

	// last year for every iteration
	const LAST_YEAR = 2100;

	// first year for every iteration
	const FIRST_YEAR = 2010;

	// integer with the current year for the scenario
	var $current_year;

	// objects with the scenario variables
	var $climate_variables;

	public function __construct($year)
	{
		$this->current_year = $year;

		$this->climate_variables = array(
			"Emissions_Growth" => new Climate_Variable("emissionsGrowth","Emissions Growth", $this->current_year, 0.13, "percentage"),
			"CO2_PPM" => new Climate_Variable("carbonPPM","CO<sub>2</sub> ppm", $this->current_year, 390, ""),
			"CO2_Radiative_Forcing" => new Climate_Variable("carbonRadioative","CO<sub>2</sub> Radiative Forcing", $this->current_year, 0, "round2decimals"),
			"Temperature_Increase" => new Climate_Variable("temperatureIncrease", "Temp Increase (&deg;C)", $this->current_year, 0, "round2decimals"),
			"Ocean_Heat_Storage" => new Climate_Variable("oceanHeat", "Ocean Heat Storage (&deg;C)", $this->current_year, 0, "round2decimals"),
			"Disaster_Risk" => new Climate_Variable("disasterRisk", "Disaster Risk", $this->current_year, 0, "round"),
			"Original_Risk" => new Climate_Variable("originalRisk", "Original Disaster Risk", $this->current_year, 0, "")
		);

		$this->updateAll();
	}

	public function __clone()
	{
		$this->climate_variables = array(
			"Emissions_Growth" => clone $this->climate_variables["Emissions_Growth"],
			"CO2_PPM" => clone $this->climate_variables["CO2_PPM"],
			"CO2_Radiative_Forcing" => clone $this->climate_variables["CO2_Radiative_Forcing"],
			"Temperature_Increase" => clone $this->climate_variables["Temperature_Increase"],
			"Ocean_Heat_Storage" => clone $this->climate_variables["Ocean_Heat_Storage"],
			"Disaster_Risk" => clone $this->climate_variables["Disaster_Risk"],
			"Original_Risk" => clone $this->climate_variables["Original_Risk"]
		);
	}

	function setCurrentYear($year)
	{
		$this->current_year = $year;
		$this->setVariablesYear();
	}

	function setVariablesYear()
	{
		$this->climate_variables["Emissions_Growth"]->setCurrentYear($this->current_year);
   		$this->climate_variables["CO2_PPM"]->setCurrentYear($this->current_year);
   		$this->climate_variables["CO2_Radiative_Forcing"]->setCurrentYear($this->current_year);
   		$this->climate_variables["Ocean_Heat_Storage"]->setCurrentYear($this->current_year);
   		$this->climate_variables["Temperature_Increase"]->setCurrentYear($this->current_year);
   		$this->climate_variables["Disaster_Risk"]->setCurrentYear($this->current_year);
   		$this->climate_variables["Original_Risk"]->setCurrentYear($this->current_year);
	}

	function displayTable()
	{
		$this->climate_variables["Emissions_Growth"]->displayPredictions();
   		$this->climate_variables["CO2_PPM"]->displayPredictions();
   		$this->climate_variables["CO2_Radiative_Forcing"]->displayPredictions();
   		$this->climate_variables["Ocean_Heat_Storage"]->displayPredictions();
   		$this->climate_variables["Temperature_Increase"]->displayPredictions();
   		$this->climate_variables["Disaster_Risk"]->displayPredictions();
   		$this->climate_variables["Original_Risk"]->displayPredictions();
	}

	function updateAll()
	{
		$this->updateEmissionsGrowth();
		$this->updateCO2PPM();
		$this->updateCO2Radiative();
		$this->updateOceanHeat();
		$this->updateTempIncrease();
		$this->updateDisasterRisk();
		$this->updateOriginalRisk();
	}
	
	function setEmissionsGrowth($value)
	{
		$this->climate_variables["Emissions_Growth"]->predictions[$this->current_year] = $value;
		$this->updateAll();
	}

	function updateEmissionsGrowth()
	{
		for ($x=$this->current_year+self::INCREMENT; $x<=self::LAST_YEAR; $x+=self::INCREMENT)
    	{
    		$previous = $this->climate_variables["Emissions_Growth"]->predictions[$x - self::INCREMENT];
    		$this->climate_variables["Emissions_Growth"]->predictions[$x] = $previous*(($previous/4)+1);
  
   		}
	}

	function updateCO2PPM()
	{
		for ($x=$this->current_year+self::INCREMENT; $x<=self::LAST_YEAR; $x+=self::INCREMENT)
    	{
    		$previous = $this->climate_variables["CO2_PPM"]->predictions[$x - self::INCREMENT];
    		$current_emisions = $this->climate_variables["Emissions_Growth"]->predictions[$x - self::INCREMENT];
    		$this->climate_variables["CO2_PPM"]->predictions[$x] = round($previous*($current_emisions+1));
   		}
	}

	function updateCO2Radiative()
	{	
		for ($x=$this->current_year; $x<=self::LAST_YEAR; $x+=self::INCREMENT)
    	{
    		$current_co2 = $this->climate_variables["CO2_PPM"]->predictions[$x];
    		$this->climate_variables["CO2_Radiative_Forcing"]->predictions[$x] = 5.35*log($current_co2/278);
    	}
	}

	function updateOceanHeat()
	{
		for ($x=$this->current_year; $x<=self::LAST_YEAR; $x+=self::INCREMENT)
    	{
    		$current_radiative = $this->climate_variables["CO2_Radiative_Forcing"]->predictions[$x];
    		$this->climate_variables["Ocean_Heat_Storage"]->predictions[$x] = $current_radiative*0.75*0.45;
    	}
	}

	function updateTempIncrease()
	{
		for ($x=$this->current_year; $x<=self::LAST_YEAR; $x+=self::INCREMENT)
    	{
    		$current_radiative = $this->climate_variables["CO2_Radiative_Forcing"]->predictions[$x];
    		$current_ocean_heat = $this->climate_variables["Ocean_Heat_Storage"]->predictions[$x];
    		$sum_ocean_heat = $this->sumOceanHeat($x);
    		if ($sum_ocean_heat == 0)
    			$sum_ocean_heat = 0.3;
    		$this->climate_variables["Temperature_Increase"]->predictions[$x] = ($current_radiative*0.75)-$current_ocean_heat+($sum_ocean_heat*0.3);
    	}
	}

	function updateDisasterRisk()
	{
		for ($x=$this->current_year; $x<=self::LAST_YEAR; $x+=self::INCREMENT)
    	{	
    		$current_temp = $this->climate_variables["Temperature_Increase"]->predictions[$x];
    		$this->climate_variables["Disaster_Risk"]->predictions[$x] = 0.0126*exp(1.1278*$current_temp)*100;
    		if ($this->climate_variables["Disaster_Risk"]->predictions[$x] > 100)
    			$this->climate_variables["Disaster_Risk"]->predictions[$x] = 100;
    	}
	}

	function updateOriginalRisk()
	{
		$this->climate_variables["Original_Risk"]->predictions[2010] = 3;
		$this->climate_variables["Original_Risk"]->predictions[2025] = 5;
		$this->climate_variables["Original_Risk"]->predictions[2040] = 9;
		$this->climate_variables["Original_Risk"]->predictions[2055] = 17;
		$this->climate_variables["Original_Risk"]->predictions[2070] = 38;
		$this->climate_variables["Original_Risk"]->predictions[2085] = 90;
		$this->climate_variables["Original_Risk"]->predictions[2100] = 100;

	}

	function sumOceanHeat($end_year)
    {
    	$start_year = 2010;
    	$sum = 0;
    	for ($x=$start_year; $x<$end_year; $x+=15)
    		$sum += $this->climate_variables["Ocean_Heat_Storage"]->predictions[$x];
    	return $sum;
    }
}

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
                "<td id='". $name ."Total'" . "class='text-center decisionRow'" . ">". $this->data[$year]["total"] . "</td>" .
                "<td class='text-center'>" .
                  "<select  class='choice' name='" . $this->group_name . "'>" .
                    "<option value='null'>Default</option>" .
                    "<option value='0'>Prohibit</option>" .
                    "<option value='1'>Restrict</option>" .
                    "<option value='3'>Discourage</option>" .
                    "<option value='5'>Maintain</option>" .
                    "<option value='6'>Encourage</option>" .
                  "</select>" .
                "</td>" .
                "<td class='text-center decisionRow'>" . $this->currentDecision($year) . "</td>" . 
                "<td id='" . $name . "Income'" . "class='text-center decisionRow'" . ">" . $this->data[$year]["income"] . "</td>" .
                "<td id='" . $name . "Disaster'" . $style . ">" . $disaster . "</td>" .
                "<td id='" . $name . "Cost'" . "class='text-center decisionRow'" . ">" . $this->data[$year]["cost"] . "</td>" .
                "<td id='" . $name . "Net'" . "class='text-center decisionRow'" . ">" . $this->data[$year]["net"] . "</td>";

        //onchange='getChoice()'
        $html_string .= "</tr>";

		// if ($this->data[$year]["alive"] == true && $this->visibility == true)
		if ($this->data[$year]["alive"] == true)
        	echo $html_string;
        else
        // elseif ($this->data[$year]["alive"] == false && $this->visibility == true)
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

	// HTML Row ID
	var $rowID;

	// choose the formatting option for display
	var $formatting_options;

	function Climate_Variable($rowID, $name, $year, $value, $option, $preset="") 
	{
		$this->rowID = $rowID;
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
		$html_string = "<tr class='variablesRow' id='" . $this->rowID . "'>\n";
		$html_string .= "<td>" . $this->name .  "</td>";

		$year_id = 2010;
		$style = "";
		foreach ($this->predictions as $key => $value) 
		{
			if ($year_id  == $this->current_year)
			//	$style = " style='border: 2px solid black'";
			//	$style = " style='background-color: #6DDFC8; color:white;'";
				$style = " selected";
			else
				$style = "";

			$html_string .= "<td id='" . $year_id . $this->rowID . "' class='col" . $year_id . " text-center" . $style . "'>" . $this->convertDisplay($value) . "</td>";
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