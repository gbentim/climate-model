<!DOCTYPE html>
<html lang="en" >
  <head>
    <title> Guilherme Bentim's Home Page</title>
    <meta charset = utf-8/>
    <script type="text/javascript" src="climateModel.js"></script>
    <style type = "text/css">
      td, th {
                border: thin solid black;
                text-align: left;
                font-size: larger;
             }

      table  {
                border: thin solid black; 
                /*border-collapse: collapse; */
                /*border-top-width: medium;*/
                /*border-bottom-width: medium;  */
                /*border-left-width: medium;*/
                /*border-right-width: medium; */
             }

    </style>
  </head>
  <body>
  <body onload="if (window.myvalue != true) { hideRows('groupRow', 16); }">
    <div align = "center">
      <button onclick="showRows('infoRow', 4)"/> Show all rows </button>
      <table>
        <tr>
          <th> Year </th>
          <th> 2010 </th>
          <th> 2025 </th>
          <th> 2040 </th>
          <th> 2055 </th>
          <th> 2070 </th>
          <th> 2085 </th>
          <th> 2100 </th>
        </tr>
        <tr id="infoRow1">
          <td> Emissions Growth </td>
          <td> <?php echo $scenario['emissions_growth']; ?> </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td>  
            <button onclick="hideRows('infoRow', 1, 1)"/> Hide </button>
          </td>
        </tr>
        <tr id="infoRow2">
          <td> CO2 ppm </td>
          <td> <?php echo $scenario['co2_ppm']; ?> </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td>  
            <button onclick="hideRows('infoRow', 2, 2)"/> Hide </button>
          </td>
        </tr>
        <tr id="infoRow3">
          <td> CO2 Radiative Forcing </td>
          <td> <?php echo $scenario['co2_radiative_forcing']; ?> </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td>  
            <button onclick="hideRows('infoRow', 3, 3)"/> Hide </button>
          </td>
        </tr>
          <td> Temp Increase </td>
          <td> <?php echo $scenario['temp_increase']; ?> </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
        </tr>
        <tr id="infoRow4">
          <td> Ocean Heat Storage </td>
          <td> <?php echo $scenario['ocean_heat_storage']; ?> </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td>  
            <button onclick="hideRows('infoRow', 4, 4)"/> Hide </button>
          </td>
        </tr>
          <td> Disaster Risk </td>
          <td> <?php echo $scenario['original_disaster_risk']; ?> </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
          <td> 0 </td>
        </tr>
        <tr>
          <th> Original Disaster Risk </th>
          <th> <?php echo $scenario['emissions_growth']; ?> </th>
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
            <select id="numGroups" onchange="setNumGroups()">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
               </select>  </td>
           <!--  <form>
              <input type="text" size="1" id="numGroups" onkeydown="if (event.keyCode == 13) { this.form.submit(); setNumGroups(); return false; }"><br>
            </form> -->
          </th>
        </tr>
        <tr>
          <td> Disaster Scenario </td>
          <td> 0 </td>
        </tr>
      </table>

      </br>
      <hr>
      </br>

      <table>
        <tr>
          <th> Group </th>
          <th> Total $ </th>
          <th> Develop </th>
          <th> Income </th>
          <th> Disaster </th>
          <th> Cost </th>
          <th> Net </th> 
        </tr>
        <tr id="groupRow1">
          <td> A </td>
          <td>  </td>
          <td> <select id="groupAction1" onchange="setIncome(1)">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td id="incomeGroup1">  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow2">
          <td> B </td>
          <td>  </td>
          <td> <select id="groupAction2" onchange="setIncome(2)">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td id="incomeGroup2">  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow3">
          <td> C </td>
          <td>  </td>
          <td> <select id="group3">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow4">
          <td> D </td>
          <td>  </td>
          <td> <select id="group4">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow5">
          <td> E </td>
          <td>  </td>
           <td> <select id="group5">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow6">
          <td> F </td>
          <td>  </td>
          <td> <select id="group6">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow7">
          <td> G </td>
          <td>  </td>
          <td> <select id="group7">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow8">
          <td> H </td>
          <td>  </td>
          <td> <select id="group8">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow9">
          <td> I </td>
          <td>  </td>
          <td> <select id="group9">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow10">
          <td> J </td>
          <td>  </td>
          <td> <select id="group10">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow11">
          <td> K </td>
          <td>  </td>
          <td> <select id="group11">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow12">
          <td> L </td>
          <td>  </td>
          <td> <select id="group12">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow13">
          <td> M </td>
          <td>  </td>
          <td> <select id="group13">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow14">
          <td> N </td>
          <td>  </td>
          <td> <select id="group14">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow15">
          <td> O </td>
          <td>  </td>
          <td> <select id="group15">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr id="groupRow16">
          <td> P </td>
          <td>  </td>
          <td> <select id="group16">
                  <option value="0">Prohibit</option>
                  <option value="1">Restrict</option>
                  <option value="3">Discourage</option>
                  <option value="5">Maintain</option>
                  <option value="6">Encourage</option>
               </select>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
      </table>
    </div>
  </body>
</html>
