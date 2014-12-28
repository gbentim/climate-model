<?php
// include "index.php";
class Scen{

public $scenario = array(
	"emissions_growth" => "",
	"co2_ppm" => "",
	"co2_radiative_forcing" => "",
	"temp_increase" => "",
	"ocean_heat_storage" => "",
	"original_disaster_risk" => ""
	);

function generate_scenario(){
	$table = "";

	$table = "
	<!--div align = 'center'--!>
      <button onclick='showRows(\'infoRow\', 4)'/> Show all rows </button>
      <table>
        <tr id='infoRow1'>
          <td> Emissions Growth </td>
          <td> " .$this->scenario['emissions_growth'] ." </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td>  
            <button onclick='hideRows(\'infoRow\', 1, 1)'/> Hide </button>
          </td>
        </tr>
        <tr id='infoRow2'>
          <td> CO2 ppm </td>
          <td> " .$this->scenario['co2_ppm']  ." </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td>  
            <button onclick='hideRows(\'infoRow\', 2, 2)'/> Hide </button>
          </td>
        </tr>
        <tr id='infoRow3'>
          <td> CO2 Radiative Forcing </td>
          <td>  " .$this->scenario['co2_radiative_forcing'] ." </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td>  
            <button onclick='hideRows(\'infoRow\', 3, 3)'/> Hide </button>
          </td>
        </tr>
          <td> Temp Increase </td>
          <td> " .$this->scenario['temp_increase'] ."  </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
        </tr>
        <tr id='infoRow4'>
          <td> Ocean Heat Storage </td>
          <td> " .$this->scenario['ocean_heat_storage'] ."  </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td>  
            <button onclick='hideRows(\'infoRow\', 4, 4)'/> Hide </button>
          </td>
        </tr>
          <td> Disaster Risk </td>
          <td> " .$this->scenario['original_disaster_risk'] ."  </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
        </tr>
        <tr>
          <th> Original Disaster Risk </th>
          <th> " .$this->scenario['emissions_growth'] ."  </th>
          <th> 0 </th>
          <th> 0 </th>
          <th> 0 </th>
          <th> 0 </th>
          <th> 0 </th>
          <th> 0 </th>
        </tr>
        <tr>
          <th>
            Number of Groups:
          </th>
          <th> 
            <select id='numGroups' onchange='setNumGroups()'>
                  <option value='0'>0</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                  <option value='6'>6</option>
                  <option value='7'>7</option>
                  <option value='8'>8</option>
                  <option value='9'>9</option>
                  <option value='10'>10</option>
                  <option value='11'>11</option>
                  <option value='12'>12</option>
                  <option value='13'>13</option>
                  <option value='14'>14</option>
                  <option value='15'>15</option>
                  <option value='17'>16</option>
               </select>  </td>
           <!--  <form>
              <input type='text' size='1' id='numGroups' onkeydown='if (event.keyCode == 13) { this.form.submit(); setNumGroups(); return false; }'><br>
            </form> -->
          </th>
        </tr>
        <tr>
          <td> Disaster Scenario </td>
          <td> 0 </td>
        </tr>
      </table>";

	return $table;
}

}
?>