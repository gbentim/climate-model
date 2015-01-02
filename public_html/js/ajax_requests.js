// var url = "/src/controller.php?" + "year=";
var url = "http://localhost/climate-model/src/controller.php?" + "year=";

$( document ).ready(function() {
     
    loadTable(2010);

});


function loadTable(year, additional_params)
{
  additional_params = typeof additional_params !== 'undefined' ? additional_params : "";
    $("#scenario-table").load(url + year + additional_params, 
      // alert(url + year + additional_params);
      function prevent()
      {
        $( ".years" ).click(function( event ) {
        event.preventDefault();
        year = $(this).text();
        loadTable(year);
      });

      $(".choice").change(function() {
        additional_params = "";
        additional_params += "&group_name=" + $(this).attr('name');
        additional_params += "&group_value=" + $(this).val();
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