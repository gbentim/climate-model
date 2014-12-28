<?php 
      // include "Scenario.php";
      // $scenario_model = new Scenario(0);
if (!isset($_GET['sel']))
{
  $_GET['sel'] = 2010;
}

if (!isset($_GET['grp']))
{
  $_GET['grp'] = 1;
}
?>
<!DOCTYPE html>
<html lang="en" >
  <head>
    <title> CC Model</title>
    <meta charset = utf-8/>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

     <style type = "text/css">
        <?php 
        	$num = $_GET['sel'];
        	echo "#col" .$num ." {
        		border: 2px solid black;
        	}";
    	?>


    </style>
  </head>
  
  <body>

<nav class="navbar navbar-default" role="navigation">
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
        <li class="dropdown">
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
        </li>
        <li class="dropdown">
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
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Number of Groups <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=1">1</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=2">2</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=3">3</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=4">4</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=5">5</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=6">6</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=7">7</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=8">8</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=9">9</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=10">10</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=11">11</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=12">12</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=13">13</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=14">14</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=15">15</a></li>
            <li><a href="?sel=<?php echo $_GET['sel'] ?>&grp=16">16</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><button type="button" class="btn btn-default navbar-btn">Sign in</button></li>
        <li><button type="button" class="btn btn-default navbar-btn">Sign Up</button></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



  	<div class="container">

  	<!-- <table> -->
     <!-- <div data-toggle="table"> -->
  	<table class="table" >
        <tr>
          <th> Year </th>
          <th> <a href="?sel=2010&grp=<?php echo $_GET['grp'] ?>"> 2010 </a> </th>
          <th> <a href="?sel=2025&grp=<?php echo $_GET['grp'] ?>"> 2025 </a> </th>
          <th> <a href="?sel=2040&grp=<?php echo $_GET['grp'] ?>"> 2040 </a> </th>
          <th> <a href="?sel=2055&grp=<?php echo $_GET['grp'] ?>"> 2055 </a> </th>
          <th> <a href="?sel=2070&grp=<?php echo $_GET['grp'] ?>"> 2070 </a> </th>
          <th> <a href="?sel=2085&grp=<?php echo $_GET['grp'] ?>"> 2085 </a> </th>
          <th> <a href="?sel=2100&grp=<?php echo $_GET['grp'] ?>"> 2100 </a> </th>
        </tr>
        <?php
          $scenario_model->display_table($_GET['sel']);
        ?>
        </tr>
        <tr>
          <td> Disaster Scenario </td>
          <td> 0 </td>
        </tr>
      </form>
    </table>

     </br>
     <hr>
     </br>

  	<table class="table">
        <tr>
          <th> Group </th>
          <th> Total $ </th>
          <th> Develop </th>
          <th> Income </th>
          <th> Disaster </th>
          <th> Cost </th>
          <th> Net </th> 
        </tr>
        <?php
          $scenario_model->change_num_groups($_GET['grp']);
          $scenario_model->display_group_table($_GET['sel']);
        ?>
      </table>



</div>
  </body>
</html>