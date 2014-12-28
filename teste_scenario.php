<?php


    const INCREMENT = 15;
    $current_year;
	$data;
    $group_data;
	$num_groups;
    $group_name;


		$current_year = 2010;
        $num_groups = 1;
		$data = array();
		for ($x=2010; $x<=2100; $x += self::INCREMENT){
    		$data[$x] = array(
				"emissions_growth" => $create_category_array('Emissions Growth'),
				"co2_ppm" => $create_category_array('CO2 PPM'),
				"co2_radiative_forcing" => $create_category_array('CO2 Radiative Forcing'),
				"temp_increase" => $create_category_array('Temperature Increase'),
				"ocean_heat_storage" => $create_category_array('Ocean Heat Storage'),
				"disaster_risk" => $create_category_array('Disaster Risk'),
				"previous_disaster_risk" => $create_category_array('Previous Disaster Risk'),
				"original_disaster_risk" => $create_category_array('Original Disaster Risk'),
			);
        }
        $data[2010]["emissions_growth"][2010] = .13;
        $data[2010]["co2_ppm"][2010] = 390;
        $all_values_for_given_year("emissions_growth");
        $all_values_for_given_year("co2_ppm");
        $group_data = array();
        $group_name = "A"; 
        for ($x=1; $x<=16; $x++){
            $group_data[$x] = array(
                "name" => $group_name,
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
            $group_name++;
            if ($x <= $num_groups)
                $group_data[$x]["exists"] = true;
        }


    function change_num_groups($groups)
    { 
        $num_groups = $groups;
        for ($x=1; $x<=16; $x++){
            if ($x <= $num_groups)
                $group_data[$x]["exists"] = true;
        }
        $calculate_single_emissions();
    }

    function calculate_single_emissions()
    {
        if ($current_year == 2010)
            $previous = 0.13;
        else
    	   $previous = $data[$current_year]["emissions_growth"][$current_year-self::INCREMENT];
    	$data[$current_year]["emissions_growth"][$current_year] = $previous - (0.01*(5*$average()));
    }

    //working, tested
    function calculate_emissions_growth()
    {
    	for ($x=$current_year+15; $x<=2100; $x+=15)
    	{
    		$previous = $data[$current_year]["emissions_growth"][$x- 15];
    		$data[$current_year]["emissions_growth"][$x] = $previous*(($previous/4)+1);
   		}
    }

    //working, tested
    function calculate_co2_ppm()
    {
    	for ($x=$current_year+15; $x<=2100; $x+=15)
    	{
    		$previous = $data[$current_year]["co2_ppm"][$x-15];
    		$current_emisions = $data[$current_year]["emissions_growth"][$x-15];
    		$data[$current_year]["co2_ppm"][$x] = round($previous*($current_emisions+1));
   		}
    }

    //working, tested
    function calculate_co2_radiative_forcing()
    {
    	for ($x=$current_year; $x<=2100; $x+=15)
    	{
    		$current_co2 = $data[$current_year]["co2_ppm"][$x];
    		$data[$current_year]["co2_radiative_forcing"][$x] = 5.35*log($current_co2/278);
   		}
        $all_values_for_given_year("co2_radiative_forcing"); 
    }

    //working, tested
    function calculate_temp_increase()
    {
    	for ($x=$current_year; $x<=2100; $x+=15)
    	{
    		$current_radiative = $data[$current_year]["co2_radiative_forcing"][$x];
    		$current_ocean_heat = $data[$current_year]["ocean_heat_storage"][$x];
    		$sum_ocean_heat = $sumOceanHeat($x);
            if ($sum_ocean_heat == 0)
                $sum_ocean_heat = 0.3;
    		$data[$current_year]["temp_increase"][$x] = ($current_radiative*0.75)-$current_ocean_heat+($sum_ocean_heat*0.3);
   		}
    }

    //working, tested
    function calculate_ocean_heat_storage()
    {
    	for ($x=$current_year; $x<=2100; $x+=15)
    	{
    		$current_radiative = $data[$current_year]["co2_radiative_forcing"][$x];
    		$data[$current_year]["ocean_heat_storage"][$x] = $current_radiative*0.75*0.45;
   		}
    }

    //working, tested
    function calculate_disaster_risk()
    {
    	for ($x=$current_year; $x<=2100; $x+=15)
    	{
    		$current_temp = $data[$current_year]["temp_increase"][$x];
    		$data[$current_year]["disaster_risk"][$x] = 0.0126*exp(1.1278*$current_temp)*100;
    		if ($data[$current_year]["disaster_risk"][$x] > 100)
    			$data[$current_year]["disaster_risk"][$x] = 100;
   		}
    }

    //working, tested
    function sumOceanHeat($end_year)
    {
    	$start_year = 2010;
    	$sum = 0;
    	for ($x=$start_year; $x<$end_year; $x+=15)
    		$sum += $data[$current_year]["ocean_heat_storage"][$x];
    	return $sum;
    }

    function average()
    {
        $sum = 0;
        $count = 0;
        for ($x=1; $x<16; $x++)
        {
            if ($group_data[$x]["exists"] == true)
            {
                echo "PORRA = " . $group_data[$x]['decision'][$current_year];
                $sum += $group_data[$x]['decision'][$current_year];
                $count++;
            }
        }

        echo "NUM = " . $count;
        echo "SUM = " . $sum;
        $avg = $sum/$count;
    	echo "AVG = " . $avg;
        return $avg;
    }


    function calculate_year()
    {  
        $calculate_single_emissions();
        $calculate_emissions_growth();
        $calculate_co2_ppm();
        $calculate_co2_radiative_forcing();
        $calculate_ocean_heat_storage();
        $calculate_temp_increase();
        $calculate_disaster_risk();
    }

    //working, tested, but it's dynamic
    function all_values_for_given_year($row)
    {
        for ($x=$current_year; $x<=2100; $x += 15){
            $data[$x][$row][$current_year] = $data[$current_year][$row][$current_year];
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
	            <td> " . $data[$current_year][$row]['formatted_name'] . " </td>
	            <td id='col2010'> " . round($data[$current_year][$row][2010], 3) . " </td>
	            <td id='col2025'> " . round($data[$current_year][$row][2025], 3) . " </td>
	            <td id='col2040'> " . round($data[$current_year][$row][2040], 3) . " </td>
	            <td id='col2055'> " . round($data[$current_year][$row][2055], 3) . " </td>
	            <td id='col2070'> " . round($data[$current_year][$row][2070], 3) . " </td>
	            <td id='col2085'> " . round($data[$current_year][$row][2085], 3) . " </td>
	            <td id='col2100'> " . round($data[$current_year][$row][2100], 3) . " </td>
	          </tr>";
	}

    //working
    function display_table($given_year)
	{
		$current_year = $given_year;
        $calculate_year();
		foreach ($data[$current_year] as $key => $value) {
			$display_row($key);
		}
	}

// $row["name"]
    function display_group_row($num, $row)
    {
        echo "<tr id='group$num'>
                <td id='group$num"."Name'> " . $row["name"] . "</td>
                <td id='group$num"."Total'> 0 </td>
                <td>
                <form actio='scenario_object.php' method='post'>
                  <select name='group$num"."Decision' onchange='this.form.submit();'>
                    <option selected='selected' disabled='disabled'> Select </option>
                    <option value='0'>Prohibit</option>
                    <option value='1'>Restrict</option>
                    <option value='3'>Discourage</option>
                    <option value='5'>Maintain</option>
                    <option value='6'>Encourage</option>
                  </select>
                </td>
                <td id='group$num"."Income'>" . $row["decision"][$current_year]."</td>
                <td id='group$num"."Disaster'> Disaster </td>
                <td id='group$num"."Cost'> Cost </td>
                <td id='group$num"."Net'> " . $row["net"] . " </td>
              </tr>";
    }

    function change_decision($group, $decision)
    {
        $group_data[$group]['decision'][$current_year] = $decision;
    }

    function display_group_table($given_year)
    {
        $current_year = $given_year;
        foreach ($group_data as $key => $value) {
            if ($value["exists"] == true)
                $display_group_row($key, $value);
        }
    }

?>

