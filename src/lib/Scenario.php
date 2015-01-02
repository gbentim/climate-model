<?php
include "Climate_Variable.php";

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

?>