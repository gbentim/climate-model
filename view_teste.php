<!DOCTYPE html>
<html lang="en" >
  <head>
    <title> CC Model</title>
    <meta charset = "utf-8"/>

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"> -->

<!-- CSS Flat -->
<link rel="stylesheet" type="text/css" href="css/bootstrap-flatly.min.css">

<!-- Fontawesome Icons -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="css/css-custom.css">




  </head>
    
  <body>

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
      <a class="navbar-brand" href="#">Climate Change Models</a>
    </div>

    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Scenarios <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Pre-set Scenario 1</a></li>
            <li><a href="#">Pre-set Scenario 2</a></li>
            <li><a href="#">Pre-set Scenario 3</a></li>
            <li class="divider"></li>
            <li><a href="#">Save Current Scenario</a></li>
            <li class="divider"></li>
            <li><a href="#">Create a Scenario</a></li>
          </ul>
        </li> -->
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Hide Rows <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Emissions Growth</a></li>
            <li><a href="#">CO2 PPM</a></li>
            <li><a href="#">CO2 Radiative Forcing</a></li>
            <li><a href="#">Temperature Increase</a></li>
            <li><a href="#">Ocean Heat Storage</a></li>
            <li><a href="#">Disaster Risk</a></li>
            <li><a href="#">Previous Disaster Risk</a></li>
            <li><a href="#">Original Disaster Risk</a></li>
            <li class="divider"></li>
            <li><a href="#">Show all Rows</a></li>
          </ul>
        </li> -->
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Number of Groups <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a class="num_groups" href="#">1</a></li>
            <li><a class="num_groups" href="#">2</a></li>
            <li><a class="num_groups" href="#">3</a></li>
            <li><a class="num_groups" href="#">4</a></li>
            <li><a class="num_groups" href="#">5</a></li>
            <li><a class="num_groups" href="#">6</a></li>
            <li><a class="num_groups" href="#">7</a></li>
            <li><a class="num_groups" href="#">8</a></li>
            <li><a class="num_groups" href="#">9</a></li>
            <li><a class="num_groups" href="#">10</a></li>
            <li><a class="num_groups" href="#">11</a></li>
            <li><a class="num_groups" href="#">12</a></li>
            <li><a class="num_groups" href="#">13</a></li>
            <li><a class="num_groups" href="#">14</a></li>
            <li><a class="num_groups" href="#">15</a></li>
            <li><a class="num_groups" href="#">16</a></li>
          </ul>
        </li> -->
      </ul>
<!--       <ul class="nav navbar-nav navbar-right">
        <li><button type="button" class="btn btn-default navbar-btn">Sign in</button></li>
        <li><button type="button" class="btn btn-default navbar-btn">Sign Up</button></li>
      </ul> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    
    
    <div class="container" id="main-container">
      <div class="row">
        
        <div class="container" id="wrapper">
          <!-- CORRIGIR RESPONSIVENESS DAS COLUNAS - Criar 2 colunas de 6 e duas de 6 dentro de cada!! -->
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-left">
                <div class="col-xs-6 pull-left">
                  <p class="options"><i class="fa fa-toggle-on"></i>Show/Hide Rows</p>
                </div>
                <div class="col-xs-6 pull-right">
                  <!-- Hide & Show Hows - Begin -->
                  <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
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
                      <li class="divider"></li>
                      <li><a href="#" name="variablesRow">Show All Rows</a></li>
                      <li><a href="#" name="variablesRow">Hide All Rows</a></li>
                    </ul>
                  </div>
                  <!-- Hide & Show Hows - End -->
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                <div class="col-xs-6 pull-left">
                  <p class="options"><i class="fa fa-users fa-fw"></i>Number of Groups</p>
                </div>
                <div class="col-xs-6 pull-right">
                  <!-- Input Group - Increment and Decrement Grous -->
                   <div style="width: 150px;">
                     <div class="input-group">
                          <span class="input-group-btn groupsInput">
                              <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                  <span class="glyphicon glyphicon-minus"></span>
                              </button>
                          </span>
                          <input type="text" id="input-info" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                          <span class="input-group-btn groupsInput">
                              <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                  <span class="glyphicon glyphicon-plus"></span>
                              </button>
                          </span>
                      </div>                  
                   </div>
                  <!-- Input Group - End -->
                </div>
              </div>
          </div>
      <div class="container" id="scenario-table">
    <!--     <table class="table" >
    
        </table>
    
          </table> -->
        </div>
        <div class="container" id="getDisaster">
          <button type='button' class='btn btn-danger' id='danger'><i class="fa fa-bolt"></i>Check Disaster</button>
        </div>
    </div>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <!-- Custom Javascript -->
    <script type="text/javascript" src="js/js-custom.js"></script>

 </body>
</html>