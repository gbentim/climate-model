<!DOCTYPE html>
<html lang="en" >
  <head>
    <title> CC Model</title>
    <meta charset = "utf-8"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- CSS Flat -->
    <link rel="stylesheet" type="text/css" href="public_html/css/bootstrap-flatly.min.css">
    <!-- Fontawesome Icons -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="public_html/css/css-custom.css">
  </head>

  <body>
    <!-- Start of Navigation Menu -->
    <nav class="navbar navbar-default navbar-inverse" role="navigation">  
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <button type="submit" class="btn btn-default"> Reset </button> -->                   
          <a class="navbar-brand" href="#">Tragedy of the Common Atmosphere: Model</a>
        </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                   
        <ul class="nav navbar-nav">
        </ul>
        <ul class="nav navbar-nav" style="float: right">
          <li><button type='button' class='btn btn-danger' id='reset'> Reset </button></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  <!-- End of Navigation Menu -->
  </nav>

  <!-- Start of Main Container -->
  <div class="container" id="main-container">
    
    <!-- Start of Row of Header -->
    <div class="row">
      <!-- Start of Container that Wraps Header -->
      <div class="container" id="wrapper">     
        <div class="col-md-4">
          <div class="row text-center">
            <p class="options"><i class="fa fa-eye"></i>Show/Hide Rows</p>
          </div>
          <div class="row">
            <div class="span7 text-center">
              <!-- Start of Hide & Show DropDown -->
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                Select Row
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" id="hideMenu">
                  <li><a href="#" name="emissionsGrowth">Emissions Growth</a></li>
                  <li><a href="#" name="carbonPPM">CO2 PPM</a></li>
                  <li><a href="#" name="carbonRadioative">CO2 Radiative Forcing</a></li>
                  <li><a href="#" name="oceanHeat">Ocean Heat Storage</a></li>
                  <li><a href="#" name="temperatureIncrease">Temperature Increase</a></li>
                  <li><a href="#" name="disasterRisk">Disaster Risk</a></li>
                  <li><a href="#" name="originalRisk">Original Risk</a></li>
                  <li class="divider"></li>
                  <li><a href="#" name="variablesRow">Show All Rows</a></li>
                  <li><a href="#" name="variablesRow">Hide All Rows</a></li>
                </ul>
              <!-- End of Hide & Show DropDown -->
              </div>
            </div>
          </div>
        </div>
                  
        <div class="col-md-4">
          <div class="row text-center">
            <p class="options"> <i class="fa fa-line-chart"></i>See Disaster Chart</p>
          </div>
          <div class="row">
            <div class="span7 text-center">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
              Disaster Chart
              </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Chart</h4>
                  </div>
                  <div class="modal-body">
                    <div id="chart" style="width:500px; height:400px;"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
                   
        <div class="col-md-4">
          <div class="row text-center">
            <p class="options"><i class="fa fa-users fa-fw"></i>Number of Groups</p>
          </div>
          <div class="row">
            <div class="span7 text-center">
              <div class="input-group">
                <span id="decrement" class="input-group-btn groupsInput">
                  <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                    <span class="glyphicon glyphicon-minus"></span>
                  </button>
                </span>
                <input type="text" id="input-info" name="quant[1]" class="form-control input-number" value="0" min="0" max="16">
                <span id="increment" class="input-group-btn groupsInput">
                  <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                    <span class="glyphicon glyphicon-plus"></span>
                  </button>
                </span>
              </div> 
            </div>
          </div>
        </div>
      
      <!-- End of Container that Wraps Header -->
      </div>
    <!-- End of Row of Header -->
    </div>

    <!-- Start of Row of Game Tables -->
    <div class="row">
      <!-- Start of Game Tables -->
      <div class="container" id="scenario-table">
      <table class='table' id='main-table'>
        <tr> 
          <th class='main-header'> Year </th> 
            <th class='main-header text-center'><a href='' class='years' id='year2010'>2010</a></th>
            <th class='main-header text-center'><a href='' class='years' id='year2025'>2025</a></th>
            <th class='main-header text-center'><a href='' class='years' id='year2040'>2040</a></th>
            <th class='main-header text-center'><a href='' class='years' id='year2055'>2055</a></th>
            <th class='main-header text-center'><a href='' class='years' id='year2070'>2070</a></th>
            <th class='main-header text-center'><a href='' class='years' id='year2085'>2085</a></th>
            <th class='main-header text-center'><a href='' class='years' id='year2100'>2100</a></th>
          </tr>
          <tr class="variablesRow" id="emissionsGrowth" style="display: table-row;">
            <td>Emissions Growth</td>
            <td id="2010emissionsGrowth" class="col2010 text-center selected">13%</td>
            <td id="2025emissionsGrowth" class="col2025 text-center">13.4%</td>
            <td id="2040emissionsGrowth" class="col2040 text-center">13.9%</td>
            <td id="2055emissionsGrowth" class="col2055 text-center">14.4%</td>
            <td id="2070emissionsGrowth" class="col2070 text-center">14.9%</td>
            <td id="2085emissionsGrowth" class="col2085 text-center">15.4%</td>
            <td id="2100emissionsGrowth" class="col2100 text-center">16%</td>
          </tr>
          <tr class="variablesRow" id="carbonPPM" style="">
            <td>CO<sub>2</sub> ppm</td>
            <td id="2010carbonPPM" class="col2010 text-center selected">390</td>
            <td id="2025carbonPPM" class="col2025 text-center">441</td>
            <td id="2040carbonPPM" class="col2040 text-center">500</td>
            <td id="2055carbonPPM" class="col2055 text-center">569</td>
            <td id="2070carbonPPM" class="col2070 text-center">651</td>
            <td id="2085carbonPPM" class="col2085 text-center">748</td>
            <td id="2100carbonPPM" class="col2100 text-center">863</td>
          </tr>
          <tr class="variablesRow" id="carbonRadioative" style="display: table-row;">
            <td>CO<sub>2</sub> Radiative Forcing</td>
            <td id="2010carbonRadioative" class="col2010 text-center selected">1.81</td>
            <td id="2025carbonRadioative" class="col2025 text-center">2.47</td>
            <td id="2040carbonRadioative" class="col2040 text-center">3.14</td>
            <td id="2055carbonRadioative" class="col2055 text-center">3.83</td>
            <td id="2070carbonRadioative" class="col2070 text-center">4.55</td>
            <td id="2085carbonRadioative" class="col2085 text-center">5.3</td>
            <td id="2100carbonRadioative" class="col2100 text-center">6.06</td>
          </tr>
          <tr class="variablesRow" id="oceanHeat" style="display: table-row;">
            <td>Ocean Heat Storage (°C)</td>
            <td id="2010oceanHeat" class="col2010 text-center selected">0.61</td>
            <td id="2025oceanHeat" class="col2025 text-center">0.83</td>
            <td id="2040oceanHeat" class="col2040 text-center">1.06</td>
            <td id="2055oceanHeat" class="col2055 text-center">1.29</td>
            <td id="2070oceanHeat" class="col2070 text-center">1.54</td>
            <td id="2085oceanHeat" class="col2085 text-center">1.79</td>
            <td id="2100oceanHeat" class="col2100 text-center">2.05</td>
          </tr>
          <tr class="variablesRow" id="temperatureIncrease" style="">
            <td>Temp Increase (°C)</td>
            <td id="2010temperatureIncrease" class="col2010 text-center selected">0.84</td>
            <td id="2025temperatureIncrease" class="col2025 text-center">1.2</td>
            <td id="2040temperatureIncrease" class="col2040 text-center">1.73</td>
            <td id="2055temperatureIncrease" class="col2055 text-center">2.33</td>
            <td id="2070temperatureIncrease" class="col2070 text-center">3.02</td>
            <td id="2085temperatureIncrease" class="col2085 text-center">3.78</td>
            <td id="2100temperatureIncrease" class="col2100 text-center">4.64</td>
          </tr>
          <tr class="variablesRow" id="disasterRisk" style="">
            <td>Disaster Risk</td>
            <td id="2010disasterRisk" class="col2010 text-center selected">3</td>
            <td id="2025disasterRisk" class="col2025 text-center">5</td>
            <td id="2040disasterRisk" class="col2040 text-center">9</td>
            <td id="2055disasterRisk" class="col2055 text-center">17</td>
            <td id="2070disasterRisk" class="col2070 text-center">38</td>
            <td id="2085disasterRisk" class="col2085 text-center">90</td>
            <td id="2100disasterRisk" class="col2100 text-center">100</td>
          </tr>
          <tr class="variablesRow" id="originalRisk" style="">
            <td>Original Disaster Risk</td>
            <td id="2010originalRisk" class="col2010 text-center selected">3</td>
            <td id="2025originalRisk" class="col2025 text-center">5</td>
            <td id="2040originalRisk" class="col2040 text-center">9</td>
            <td id="2055originalRisk" class="col2055 text-center">17</td>
            <td id="2070originalRisk" class="col2070 text-center">38</td>
            <td id="2085originalRisk" class="col2085 text-center">90</td>
            <td id="2100originalRisk" class="col2100 text-center">100</td>
          </tr>
        </table>

        <div class='container' id='getDisaster'>
          <button type='button' class='btn btn-danger' id='danger'><i class='fa fa-bolt'></i>Check Disaster</button>
          <button type='button' class='btn btn-success' id='next'><i class='fa fa-arrow-right'></i>Next Year</button>
        </div>

        <table class="table"><tbody>
          <tr>
            <th class="main-header"> Player </th>
            <th class="main-header text-center"> Total $ </th>
            <th class="main-header text-center"> Develop </th>
            <th class="main-header text-center"> Decision </th>
            <th class="main-header text-center"> Income </th>
            <th class="main-header text-center"> Disaster </th>
            <th class="main-header text-center"> Cost </th>
            <th class="main-header text-center"> Net </th>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow1">
            <td id="groupA"> A</td>
            <td id="groupATotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="A">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupAIncome" class="text-center decisionRow">0</td>
            <td id="groupADisaster"></td>
            <td id="groupACost" class="text-center decisionRow">0</td>
            <td id="groupANet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow2">
            <td id="groupB"> B</td>
            <td id="groupBTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="B">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupBIncome" class="text-center decisionRow">0</td>
            <td id="groupBDisaster"></td>
            <td id="groupBCost" class="text-center decisionRow">0</td>
            <td id="groupBNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow3">
            <td id="groupC"> C</td>
            <td id="groupCTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="C">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupCIncome" class="text-center decisionRow">0</td>
            <td id="groupCDisaster"></td><td id="groupCCost" class="text-center decisionRow">0</td>
            <td id="groupCNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow4">
            <td id="groupD"> D</td>
            <td id="groupDTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="D">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupDIncome" class="text-center decisionRow">0</td>
            <td id="groupDDisaster"></td>
            <td id="groupDCost" class="text-center decisionRow">0</td>
            <td id="groupDNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow5">
            <td id="groupE"> E</td>
            <td id="groupETotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="E">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupEIncome" class="text-center decisionRow">0</td>
            <td id="groupEDisaster"></td>
            <td id="groupECost" class="text-center decisionRow">0</td>
            <td id="groupENet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow6">
            <td id="groupF"> F</td>
            <td id="groupFTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="F">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupFIncome" class="text-center decisionRow">0</td>
            <td id="groupFDisaster"></td>
            <td id="groupFCost" class="text-center decisionRow">0</td>
            <td id="groupFNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow7">
            <td id="groupG"> G</td>
            <td id="groupGTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="G">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupGIncome" class="text-center decisionRow">0</td>
            <td id="groupGDisaster"></td>
            <td id="groupGCost" class="text-center decisionRow">0</td>
            <td id="groupGNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow8">
            <td id="groupH"> H</td>
            <td id="groupHTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="H">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select></td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupHIncome" class="text-center decisionRow">0</td>
            <td id="groupHDisaster"></td>
            <td id="groupHCost" class="text-center decisionRow">0</td>
            <td id="groupHNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow9">
            <td id="groupI"> I</td>
            <td id="groupITotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="I"><option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupIIncome" class="text-center decisionRow">0</td>
            <td id="groupIDisaster"></td>
            <td id="groupICost" class="text-center decisionRow">0</td>
            <td id="groupINet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow10">
            <td id="groupJ"> J</td>
            <td id="groupJTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="J">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupJIncome" class="text-center decisionRow">0</td>
            <td id="groupJDisaster"></td>
            <td id="groupJCost" class="text-center decisionRow">0</td>
            <td id="groupJNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow11">
            <td id="groupK"> K</td>
            <td id="groupKTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="K">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupKIncome" class="text-center decisionRow">0</td>
            <td id="groupKDisaster"></td>
            <td id="groupKCost" class="text-center decisionRow">0</td>
            <td id="groupKNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow12">
            <td id="groupL"> L</td>
            <td id="groupLTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="L">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupLIncome" class="text-center decisionRow">0</td>
            <td id="groupLDisaster"></td>
            <td id="groupLCost" class="text-center decisionRow">0</td>
            <td id="groupLNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow13">
            <td id="groupM"> M</td>
            <td id="groupMTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="M">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupMIncome" class="text-center decisionRow">0</td>
            <td id="groupMDisaster"></td>
            <td id="groupMCost" class="text-center decisionRow">0</td>
            <td id="groupMNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow14">
            <td id="groupN"> N</td>
            <td id="groupNTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="N">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupNIncome" class="text-center decisionRow">0</td>
            <td id="groupNDisaster"></td>
            <td id="groupNCost" class="text-center decisionRow">0</td>
            <td id="groupNNet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow15">
            <td id="groupO"> O</td>
            <td id="groupOTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="O">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupOIncome" class="text-center decisionRow">0</td>
            <td id="groupODisaster"></td>
            <td id="groupOCost" class="text-center decisionRow">0</td>
            <td id="groupONet" class="text-center decisionRow">0</td>
          </tr>
          <tr style="display: none;" class="groupRow" id="groupRow16">
            <td id="groupP"> P</td>
            <td id="groupPTotal" class="text-center decisionRow">0</td>
            <td class="text-center">
              <select class="choice" name="P">
                <option value="null"></option>
                <option value="0">Prohibit (0)</option>
                <option value="1">Restrict (1)</option>
                <option value="3">Discourage (3)</option>
                <option value="5">Maintain (5)</option>
                <option value="6">Encourage (6)</option>
              </select>
            </td>
            <td class="text-center decisionRow" style="background-color: #white; color: white;">None</td>
            <td id="groupPIncome" class="text-center decisionRow">0</td>
            <td id="groupPDisaster"></td>
            <td id="groupPCost" class="text-center decisionRow">0</td>
            <td id="groupPNet" class="text-center decisionRow">0</td>
          </tr>
        </tbody></table>

      <!-- End Game Tables -->
      </div>
    <!-- End of Row of Game Tables -->
    </div>

    <div class="row">
    </div>
  <!-- End of Main Container -->      
  </div>
        
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
  <!-- Jquery Local Copy -->
  <script type="text/javascript" src="public_html/js/jquery-2.1.3.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script> -->
  <!-- Bootstrap Javascript Local Copy -->
  <script type="text/javascript" src="public_html/js/bootstrap.min.js"></script>
  <!-- HighChart Local Copy -->
  <script type="text/javascript" src="public_html/js/highcharts.js"></script>
  <!-- HighChart The -->
  <!--<script type="text/javascript" src="/js/themes/gray.js"></script>-->
  <!-- Custom Javascript -->
  <script type="text/javascript" src="public_html/js/js-custom2.js"></script>
  
  </body>
</html>