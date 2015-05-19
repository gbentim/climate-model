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
                    <h4 class="modal-title" id="myModalLabel">Disaster Chart</h4>
                  </div>
                  <div class="modal-body">
                    <div id="chart" style="width:500px; height:400px;"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal2">Temperature Chart</button>
                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal3">CO2 Chart</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Temperature Chart</h4>
                  </div>
                  <div class="modal-body">
                    <div id="chartTemp" style="width:500px; height:400px;"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">CO2 Chart</h4>
                  </div>
                  <div class="modal-body">
                    <div id="chartCO2" style="width:500px; height:400px;"></div>
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
    <script type="text/javascript" src="public_html/js/js-custom.js"></script>

  </body>
</html>