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
    
 var url = "controller.php?" + "year=";

$( document ).ready(function() {
     
    loadTable(2010);

});


function loadTable(year, additional_params)
{
  additional_params = typeof additional_params !== 'undefined' ? additional_params : "";
  //alert(year);
   $("#scenario-table").load(url + year + additional_params, 

        function prevent()
        {
          $( ".years" ).click(function( event ) {
         //alert( event.isDefaultPrevented() ); // false
         event.preventDefault();
         //alert( event.isDefaultPrevented() ); // true

          year = $(this).text();
          loadTable(year);
        });

          $(".choice").change(function() {
              additional_params = "";
              additional_params += "&group_name=" + $(this).attr('name');
              additional_params += "&group_value=" + $(this).val();
              // alert(additional_params);
              loadTable(year, additional_params)     
          });

          $("#danger").click(function( event ) {
              event.preventDefault();
              additional_params = "";
              additional_params += "&disaster=true";
              loadTable(year, additional_params)     
          });

          $(".num_groups").click(function( event ) {
              event.preventDefault();
              groups = $(this).text();
              additional_params = "";
              additional_params += "&num_groups="+groups;
              loadTable(year, additional_params)     
          });


     });

}

// function changeGroups()
// {

// }

// var choices = []; 

// function getChoice()
// {
  
//   $('.choice :selected').each(function(i, selected){ 
//     choices[i] = $(selected).val(); 
//   });

//   loadChoice();
//   alert(choices);
// }

// function loadChoice()
// {
  
//   //var choiceArray = choices.serializeArray()

//   $.ajax({
//      type: "GET",
//      url: "controller.php",
//      // async: false,
//      data:  {choices:choices},
//      // dataType: "json",
//      // data: JSON.stringify({ choices: choices }),
//      success: function(r){
//        // $('.answer').html(msg);
//        alert("Enviei decisao: "+r.responseText);
//      }
//   });
// }


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
<!--       <ul class="nav navbar-nav navbar-right">
        <li><button type="button" class="btn btn-default navbar-btn">Sign in</button></li>
        <li><button type="button" class="btn btn-default navbar-btn">Sign Up</button></li>
      </ul> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

    <div class="container" id="scenario-table">
<!--     <table class="table" >

    </table>

      </table> -->
    </div>
 </body>
</html>