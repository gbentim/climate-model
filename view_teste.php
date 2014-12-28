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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script type = "text/javascript" language = "javascript">
    
 var url = "controller.php?" + "q=";

$( document ).ready(function() {
     
    loadTable(2010);
     

});


function loadTable(year)
{
  //alert(year);
   $("#scenario-table").load(url + year, 

        function prevent()
        {
          $( "a" ).click(function( event ) {
         //alert( event.isDefaultPrevented() ); // false
         event.preventDefault();
         //alert( event.isDefaultPrevented() ); // true

          year = $(this).text();
          loadTable(year);
        });


     });

}

</script>



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
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li><a href="#">7</a></li>
            <li><a href="#">8</a></li>
            <li><a href="#">9</a></li>
            <li><a href="#">10</a></li>
            <li><a href="#">11</a></li>
            <li><a href="#">12</a></li>
            <li><a href="#">13</a></li>
            <li><a href="#">14</a></li>
            <li><a href="#">15</a></li>
            <li><a href="#">16</a></li>
          </ul>
        </li>
      </ul>
<!--       <ul class="nav navbar-nav navbar-right">
        <li><button type="button" class="btn btn-default navbar-btn">Sign in</button></li>
        <li><button type="button" class="btn btn-default navbar-btn">Sign Up</button></li>
      </ul> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <div class="container">


    <table class="table" id="scenario-table">

    </table>

    
     <!-- <div data-toggle="table"> -->
    <table class="table" >
        <tr>
          <th> Group </th>
          <th> Total $ </th>
          <th> Develop </th>
          <th> Income </th>
          <th> Disaster </th>
          <th> Cost </th>
          <th> Net </th> 
        </tr>
    <tr id='groupA'>
                <td id='groupA"."Name'> " A "</td>
                <td id='groupA"."Total'> 0 </td>
                <td>
                <form method='post'>
                  <select name='groupA"."Decision' onchange='loadTable(this.value);'>
                    <option value='0'>Prohibit</option>
                    <option value='1'>Restrict</option>
                    <option value='3'>Discourage</option>
                    <option value='5'>Maintain</option>
                    <option value='6'>Encourage</option>
                  </select>
                </td>
                <td id='groupAIncome'> 0</td>
                <td id='groupA"."Disaster'> Disaster </td>
                <td id='groupA"."Cost'> Cost </td>
                <td id='groupA"."Net'> 0 </td>
              </tr>
      </table>
</div>
    </body>
</html>