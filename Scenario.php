<?php

class Scenario
{
    const INCREMENT = 15;
    var $current_year;
	var $data;
    var $group_data;
	var $num_groups;
    var $group_name;

	function Scenario($groups)	{
		$this->current_year = 2010;
        $this->num_groups = $groups;
		$this->data = array();
		for ($x=2010; $x<=2100; $x += self::INCREMENT){
    		$this->data[$x] = array(
				"emissions_growth" => $this->create_category_array('Emissions Growth'),
				"co2_ppm" => $this->create_category_array('CO2 PPM'),
				"co2_radiative_forcing" => $this->create_category_array('CO2 Radiative Forcing'),
				"temp_increase" => $this->create_category_array('Temperature Increase'),
				"ocean_heat_storage" => $this->create_category_array('Ocean Heat Storage'),
				"disaster_risk" => $this->create_category_array('Disaster Risk'),
				"previous_disaster_risk" => $this->create_category_array('Previous Disaster Risk'),
				"original_disaster_risk" => $this->create_category_array('Original Disaster Risk'),
			);
        }
        $this->data[2010]["emissions_growth"][2010] = .13;
        $this->data[2010]["co2_ppm"][2010] = 390;
        $this->all_values_for_given_year("emissions_growth");
        $this->all_values_for_given_year("co2_ppm");
        $this->group_data = array();
        $this->group_name = "A"; 
        for ($x=1; $x<=16; $x++){
            $this->group_data[$x] = array(
                "name" => $this->group_name,
                "exists" => false,
                "net" => 0,
                "decision" => array(
                    2010 => 0,
                    2025 => 0,
                    2040 => 0,
                    2055 => 0,
                    2070 => 0,
                    2085 => 0,
                    2100 => 0
                ),
            );
            $this->group_name++;
            if ($x <= $this->num_groups)
                $this->group_data[$x]["exists"] = true;
        }

    }

    public function change_num_groups($groups)
    {   
        $this->num_groups = $groups;
        for ($x=1; $x<=16; $x++){
            if ($x <= $this->num_groups)
                $this->group_data[$x]["exists"] = true;
        }
    }

    function calculate_single_emissions()
    {
    	$previous = $this->data[$this->current_year]["emissions_growth"][$this->current_year-self::INCREMENT];
    	$this->data[$this->current_year]["emissions_growth"][$this->current_year] = $previous - (0.01*(5*$this->numGroups-$this->incomeSum())/ $this->num_groups);
    }

    //working, tested
    function calculate_emissions_growth()
    {
    	for ($x=$this->current_year+15; $x<=2100; $x+=15)
    	{
    		$previous = $this->data[$this->current_year]["emissions_growth"][$x- 15];
    		$this->data[$this->current_year]["emissions_growth"][$x] = $previous*(($previous/4)+1);
   		}
    }

    //working, tested
    function calculate_co2_ppm()
    {
    	for ($x=$this->current_year+15; $x<=2100; $x+=15)
    	{
    		$previous = $this->data[$this->current_year]["co2_ppm"][$x-15];
    		$current_emisions = $this->data[$this->current_year]["emissions_growth"][$x-15];
    		$this->data[$this->current_year]["co2_ppm"][$x] = round($previous*($current_emisions+1));
   		}
    }

    //working, tested
    function calculate_co2_radiative_forcing()
    {
    	for ($x=$this->current_year; $x<=2100; $x+=15)
    	{
    		$current_co2 = $this->data[$this->current_year]["co2_ppm"][$x];
    		$this->data[$this->current_year]["co2_radiative_forcing"][$x] = 5.35*log($current_co2/278);
   		}
        $this->all_values_for_given_year("co2_radiative_forcing"); 
    }

    //working, tested
    function calculate_temp_increase()
    {
    	for ($x=$this->current_year; $x<=2100; $x+=15)
    	{
    		$current_radiative = $this->data[$this->current_year]["co2_radiative_forcing"][$x];
    		$current_ocean_heat = $this->data[$this->current_year]["ocean_heat_storage"][$x];
    		$sum_ocean_heat = $this->sumOceanHeat($x);
            if ($sum_ocean_heat == 0)
                $sum_ocean_heat = 0.3;
    		$this->data[$this->current_year]["temp_increase"][$x] = ($current_radiative*0.75)-$current_ocean_heat+($sum_ocean_heat*0.3);
   		}
    }

    //working, tested
    function calculate_ocean_heat_storage()
    {
    	for ($x=$this->current_year; $x<=2100; $x+=15)
    	{
    		$current_radiative = $this->data[$this->current_year]["co2_radiative_forcing"][$x];
    		$this->data[$this->current_year]["ocean_heat_storage"][$x] = $current_radiative*0.75*0.45;
   		}
    }

    //working, tested
    function calculate_disaster_risk()
    {
    	for ($x=$this->current_year; $x<=2100; $x+=15)
    	{
    		$current_temp = $this->data[$this->current_year]["temp_increase"][$x];
    		$this->data[$this->current_year]["disaster_risk"][$x] = 0.0126*exp(1.1278*$current_temp)*100;
    		if ($this->data[$this->current_year]["disaster_risk"][$x] > 100)
    			$this->data[$this->current_year]["disaster_risk"][$x] = 100;
   		}
    }

    //working, tested
    function sumOceanHeat($end_year)
    {
    	$start_year = 2010;
    	$sum = 0;
    	for ($x=$start_year; $x<$end_year; $x+=15)
    		$sum += $this->data[$this->current_year]["ocean_heat_storage"][$x];
    	return $sum;
    }

    function incomeSum()
    {
        $sum = 0;
    	return $sum;
    }


    function calculate_year()
    {  
        // $this->calculate_single_emissions();
        $this->calculate_emissions_growth();
        $this->calculate_co2_ppm();
        $this->calculate_co2_radiative_forcing();
        $this->calculate_ocean_heat_storage();
        $this->calculate_temp_increase();
        $this->calculate_disaster_risk();
        // $this->
    }

    //working, tested, but it's dynamic
    function all_values_for_given_year($row)
    {
        for ($x=$this->current_year; $x<=2100; $x += 15){
            $this->data[$x][$row][$this->current_year] = $this->data[$this->current_year][$row][$this->current_year];
        }
    }

    function create_category_array($formatted_name)
    {
        return array(
            'formatted_name' => $formatted_name,
            2010 => 0,
            2025 => 0,
            2040 => 0,
            2055 => 0,
            2070 => 0,
            2085 => 0,
            2100 => 0
        );
    }

    //working
	function display_row($row)
	{
		echo "<tr id='$row'>
	           <td> " . $this->data[$this->current_year][$row]['formatted_name'] . " </td>
	            <td id='col2010'> " . round($this->data[$this->current_year][$row][2010], 3) . " </td>
	            <td id='col2025'> " . round($this->data[$this->current_year][$row][2025], 3) . " </td>
	            <td id='col2040'> " . round($this->data[$this->current_year][$row][2040], 3) . " </td>
	            <td id='col2055'> " . round($this->data[$this->current_year][$row][2055], 3) . " </td>
	            <td id='col2070'> " . round($this->data[$this->current_year][$row][2070], 3) . " </td>
	            <td id='col2085'> " . round($this->data[$this->current_year][$row][2085], 3) . " </td>
	            <td id='col2100'> " . round($this->data[$this->current_year][$row][2100], 3) . " </td>
	          </tr>";
	}

    //working
    public function display_table($given_year)
	{   
        echo "<tr>
          <th> Year </th>
          <th> <a href='#' onclick='loadTable(2010)'> 2010 </a> </th>
          <th> <a href='#' onclick='loadTable(2025)'> 2025 </a> </th>
          <th> <a href='#' onclick='loadTable(2040)'> 2040 </a> </th>
          <th> <a href='#' onclick='loadTable(2055)'> 2055 </a> </th>
          <th> <a href='#' onclick='loadTable(2070)'> 2070 </a> </th>
          <th> <a href='#' onclick='loadTable(2085)'> 2085 </a> </th>
          <th> <a href='#' onclick='loadTable(2100)'> 2100 </a> </th>
        </tr>";
		$this->current_year = $given_year;
        $this->calculate_year();
		foreach ($this->data[$this->current_year] as $key => $value) {
			$this->display_row($key);
		}
	}

// $row["name"]
    public function display_group_row($num, $row)
    {
        echo "<tr id='group$num'>
                <td id='group$num"."Name'> " . $row["name"] . "</td>
                <td id='group$num"."Total'> 0 </td>
                <td>
                <form action='scenario_object.php' method='post'>
                  <select name='group$num"."Decision' onchange='this.form.submit();'>
                    <option value='0'>Prohibit</option>
                    <option value='1'>Restrict</option>
                    <option value='3'>Discourage</option>
                    <option value='5'>Maintain</option>
                    <option value='6'>Encourage</option>
                  </select>
                </td>
                <td id='group$num"."Income'>" . $row["decision"][$this->current_year]."</td>
                <td id='group$num"."Disaster'> Disaster </td>
                <td id='group$num"."Cost'> Cost </td>
                <td id='group$num"."Net'> " . $row["net"] . " </td>
              </tr>";
    }

    public function change_decision($group, $decision)
    {
        $this->group_data[$group]['decision'][$this->current_year] = $decision;
    }

    public function display_group_table($given_year)
    {
        $this->current_year = $given_year;
        foreach ($this->group_data as $key => $value) {
            if ($value["exists"] == true)
                $this->display_group_row($key, $value);
        }
    }
}
?>
