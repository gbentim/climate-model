<!DOCTYPE html>
<html lang="en" >
  <head>
    <title> CC Model</title>
    <meta charset = "utf-8"/>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"/></script>

<script src="/climate-model/public_html/js/ajax_requests.js" type = "text/javascript" language = "javascript"/></script>
    
</head>
    
<body>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Climate Change Models</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
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
        </li>
      </ul>
    </div>
  </div>
</nav>


    <div class="container" id="scenario-table">
        <!--  Tables loaded with Ajax request    -->
    </div>


 </body>
</html>