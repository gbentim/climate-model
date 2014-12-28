<?php

class Climate_Model
{
	// every iteration is a 15 years increment
	const INCREMENT = 15;

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

	}

	function displayScenario($year)
	{
		if ($this->should_clone[$year])
			$this->cloneScenario($year);

		echo "<h2>" . $this->scenarios[$year]->current_year . "</h2>";
		echo "<tr>" .
			 "<th> Year </th>" .
			 "<th><a href=''>2010</a></th>" .
			 "<th><a href=''>2025</a></th>" .
			 "<th><a href=''>2040</a></th>" .
			 "<th><a href=''>2055</a></th>" .
			 "<th><a href=''>2070</a></th>" .
			 "<th><a href=''>2085</a></th>" .
			 "<th><a href=''>2100</a></th></tr>";

		$this->scenarios[$year]->displayTable();
	}

	function cloneScenario($year)
	{
		$this->scenarios[$year] = clone $this->scenarios[$year - self::INCREMENT];
		$this->scenarios[$year]->setCurrentYear($year);
		$this->should_clone[$year] = false;
	}

	function updateEmissions($year, $value)
	{
		if ($this->should_clone[$year])
			$this->cloneScenario($year);
/*		echo "O que ta pegando...  Year: " . $year . "Valor: " . $value;*/
		$this->scenarios[$year]->setEmissionsGrowth($value);
		$this->should_clone[$year + self::INCREMENT] = true;
	}
}

class Scenario
{
	// every iteration is a 15 years increment
	const INCREMENT = 15;

	// last year for every iteration
	const LAST_YEAR = 2100;

	// integer with the current year for the scenario
	var $current_year;

	// objects with the scenario variables
	var $climate_variables;

	public function __construct($year)
	{
		$this->current_year = $year;

		$this->climate_variables = array(
			"Emissions_Growth" => new Climate_Variable("Emissions Growth", $this->current_year, 0.13, "percentage"),
			"CO2_PPM" => new Climate_Variable("CO<sub>2</sub> ppm", $this->current_year, 390, ""),
			"CO2_Radiative_Forcing" => new Climate_Variable("CO<sub>2</sub> Radiative Forcing", $this->current_year, 0, "round2decimals"),
			"Temperature_Increase" => new Climate_Variable("Temp Increase (&deg;C)", $this->current_year, 0, "round2decimals"),
			"Ocean_Heat_Storage" => new Climate_Variable("Ocean Heat Storage (&deg;C)", $this->current_year, 0, "round2decimals"),
			"Disaster_Risk" => new Climate_Variable("Disaster Risk", $this->current_year, 0, "round")
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
			"Disaster_Risk" => clone $this->climate_variables["Disaster_Risk"]
		);
	}

	function setCurrentYear($year)
	{
		$this->current_year = $year;
	}

	function displayTable()
	{
		$this->climate_variables["Emissions_Growth"]->displayPredictions();
   		$this->climate_variables["CO2_PPM"]->displayPredictions();
   		$this->climate_variables["CO2_Radiative_Forcing"]->displayPredictions();
   		$this->climate_variables["Ocean_Heat_Storage"]->displayPredictions();
   		$this->climate_variables["Temperature_Increase"]->displayPredictions();
   		$this->climate_variables["Disaster_Risk"]->displayPredictions();
	}

	function updateAll()
	{
		$this->updateEmissionsGrowth();
		$this->updateCO2PPM();
		$this->updateCO2Radiative();
		$this->updateOceanHeat();
		$this->updateTempIncrease();
		$this->updateDisasterRisk();
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
	//group name (oiriginally A-J)
	var $group_name;

	// hash table with income for every given year
	var $income;

	// boolean or disaster object containing cost
	var $disaster;

	// hash table with total net income for every given year
	var $total;

	// boolean if group is alive or dead
	var $alive;


}

class Disaster
{

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

	function getInitialValue() 
	{
		return $this->initial_value;
	}

	function displayPredictions()
	{
		$html_string = "<tr>\n";
		$html_string .= "<td>" . $this->name .  "</td>";

		$year_id = $this->current_year;

		foreach ($this->predictions as $key => $value) 
		{
			$html_string .= "<td class='col" . $year_id . "'>" . $this->convertDisplay($value) . "</td>";
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