<!-- </div>
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
      </table> -->











            <div class="round_container_xsides">
          <div class="round_container_ysides">
                <div class="round_container">  