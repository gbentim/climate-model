/*****************************************************************
* JQUERY 'DOCUMENT READY' FUNCTION
* Only runs Jquery Functions when the whole document is ready
* ****************************************************************/

var url = "src/controller.php?" + "year=";

groupsInput();
hideVariablesRows();

$("#decrement").click(function( event ) {
  event.preventDefault();
     
  hideGroupsRows();                 
});

$("#increment").click(function( event ) {
  event.preventDefault();

  hideGroupsRows();
});

$("#input-info").on("input", function() {
     hideGroupsRows();
});

$( ".years" ).click(function( event ) {
  event.preventDefault();
  
  year = $(this).text();
  loadTable(year);
});

$("#danger").click(function( event ) {
  event.preventDefault();
  additional_params = "";
  additional_params += "&disaster=true";
  loadTable(year, additional_params)     
});

// button that advances one iteration of year at a time
$("#next").click(function( event ) {
  event.preventDefault();
  additional_params = "";
  // if the last year is reached, advance to the first iteration
  nextYear = (parseInt(year) == 2100) ? 2010 : parseInt(year) + 15;
  loadTable(nextYear, additional_params)     
});

$("#reset").click(function( event ) {
  event.preventDefault();
  // var retVal = confirm("This will delete all data from this game.\nAre you sure you want to do this?");
  // if( retVal == true ){
  //    additional_params = "&reset=true";
  // }else{
  //    additional_params = "";
  // }
  additional_params = "&reset=true";
  nextYear = 2010;
  loadTable(nextYear, additional_params)     
});

function loadTable ( year )
{
  console.log("Sou lindo")
}


//

// loadTable(2010);

// $( document ).ready(function()
// {

    // loadTable(2010);

    // prevent();

    

    // prevent()

    // setTimeout(function(){


   


    // }, 400);

    // setTimeout(function(){
    // }, 50);

// });

// $( window ).load(function()
// {
//   loadTable(2010);
// });



// function prevent()
// {
//   additional_params = "";
//   year = 2010;

  // $( ".years" ).click(function( event ) {
  //   event.preventDefault();
  //   year = $(this).text();
  //   loadTable(year);
  // });

  // $(".choice").change(function() {
  //   additional_params = "";
  //   additional_params += "&group_name=" + $(this).attr('name');
  //   additional_params += "&group_value=" + $(this).val();
  //   loadTable(year, additional_params)     
  // });

  // $("#danger").click(function( event ) {
  //   event.preventDefault();
  //   additional_params = "";
  //   additional_params += "&disaster=true";
  //   loadTable(year, additional_params)     
  // });

  // // button that advances one iteration of year at a time
  // $("#next").click(function( event ) {
  //   event.preventDefault();
  //   additional_params = "";
  //   // if the last year is reached, advance to the first iteration
  //   nextYear = (parseInt(year) == 2100) ? 2010 : parseInt(year) + 15;
  //   loadTable(nextYear, additional_params)     
  // });

  // $("#reset").click(function( event ) {
  //   event.preventDefault();
  //   var retVal = confirm("This will delete all data from this game.\nAre you sure you want to do this?");
  //   if( retVal == true ){
  //      additional_params = "&reset=true";
  //   }else{
  //      additional_params = "";
  //   }
  //   nextYear = 2010;
  //   loadTable(nextYear, additional_params)     
  // });

  //  setTimeout(function(){
  //    hideGroupsRows();
  //   }, 400);

  //   setTimeout(function(){
  //    loadChart();
  //   }, 50);

  //   groupsInput();

  //   hideVariablesRows();
// }

/*****************************************************************
* HIDE VARIABLE ROWS
* Show and Hide Climate Variable Rows
* ****************************************************************/
function hideVariablesRows()
{
    $("#hideMenu li a").click(function(e) {
      e.preventDefault();

      var  name = $(this).attr('name');


      $( "#" + name ).toggle('slow');
      
      var text = $( this ).text();

      if(text == "Show All Rows")
      {         
        var elem = $(".variablesRow");
        elem.show('slow');
      }

      else if(text == "Hide All Rows")
      {
        var elem = $(".variablesRow");
        elem.hide('slow');
      }

    });
}


/*****************************************************************
* HIDE GROUPS ROWS
* Show and Hide Group Rows
* ****************************************************************/
function hideGroupsRows()
{

    var num = $("#input-info").val();

    $('.groupRow').hide();
 
    
    for(x=1; x<=num; x++)
    {
       console.log("Quantas vezes estou fazendo essa merda?")
       $( "#groupRow" + x ).show();
    }
    
}


/*****************************************************************
* GROUPS INPUT
* UI Buttons to Increment or Decrement number of Groups
 * ****************************************************************/
 function groupsInput()
 {

   $('.btn-number').click(function(e){
       e.preventDefault();
       fieldName = $(this).attr('data-field');
       type      = $(this).attr('data-type');
       var input = $("input[name='"+fieldName+"']");
       var currentVal = parseInt(input.val());
       if (!isNaN(currentVal)) {
           if(type == 'minus') {
              
               if(currentVal > input.attr('min')) {
                   input.val(currentVal - 1).change();
               } 
               if(parseInt(input.val()) == input.attr('min')) {
                   $(this).attr('disabled', true);
               }

           } else if(type == 'plus') {

               if(currentVal < input.attr('max')) {
                   input.val(currentVal + 1).change();
               }
               if(parseInt(input.val()) == input.attr('max')) {
                   $(this).attr('disabled', true);
               }

           }
       } else {
           input.val(0);
       }
   });
   $('.input-number').focusin(function(){
      $(this).data('oldValue', $(this).val());
   });
   $('.input-number').change(function() {
      
       minValue =  parseInt($(this).attr('min'));
       maxValue =  parseInt($(this).attr('max'));
       valueCurrent = parseInt($(this).val());
      
       name = $(this).attr('name');
       if(valueCurrent >= minValue) {
           $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
       } else {
           alert('Sorry, the minimum value was reached');
           $(this).val($(this).data('oldValue'));
       }
       if(valueCurrent <= maxValue) {
           $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
       } else {
           alert('Sorry, the maximum value was reached');
           $(this).val($(this).data('oldValue'));
       }
      

   });

   $(".input-number").keydown(function (e) {
           // Allow: backspace, delete, tab, escape, enter and .
           if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
               (e.keyCode == 65 && e.ctrlKey === true) || 
                // Allow: home, end, left, right
               (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
           }
           // Ensure that it is a number and stop the keypress
           if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
               e.preventDefault();
           }
       });
 }


/********************************************************************
* LOAD TABLE
* Load Main Tables of Game: Climate Variables Table and Groups Table 
*********************************************************************/
// function loadTable(year, additional_params)
// {
//   additional_params = typeof additional_params !== 'undefined' ? additional_params : "";
//   // year = typeof year !== 'undefined' ? additional_params : 2010;
//   // document.write("I wanna see the first request" + url + year + additional_params);
//   $("#scenario-table").load(url + year + additional_params,

//         function prevent()
//         {
//           $("#carbonRadioative").hide();
//           $("#emissionsGrowth").hide();
//           $("#oceanHeat").hide();


//           $( ".years" ).click(function( event ) {
//          event.preventDefault();

//           year = $(this).text();
//           loadTable(year);
//         });

//           $(".choice").change(function() {
//               additional_params = "";
//               additional_params += "&group_name=" + $(this).attr('name');
//               additional_params += "&group_value=" + $(this).val();
//               loadTable(year, additional_params)     
//           });

          

//      });

//    setTimeout(function(){
//      hideGroupsRows();
//    }, 400);
  
//   setTimeout(function(){
//      loadChart();
//    }, 50);

// }


/*****************************************************************
* GRAPHIC
* 
* ****************************************************************/
function loadChart()
{

        var data10 = parseInt($('#2010disasterRisk').text());
        var data25 = parseInt($('#2025disasterRisk').text());
        var data40 = parseInt($('#2040disasterRisk').text());
        var data55 = parseInt($('#2055disasterRisk').text());
        var data70 = parseInt($('#2070disasterRisk').text());
        var data85 = parseInt($('#2085disasterRisk').text());
        var data100 = parseInt($('#2100disasterRisk').text());

        $('#chart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Disaster Risk Comparison Chart'
            },
            subtitle: {
                text: 'Climate Change Model'
            },
            xAxis: {
                categories: ['2010', '2025', '2040', '2055', '2070', '2085', '2100']
            },
            yAxis: {
                title: {
                    text: 'Risk (%)'
                },

                min: 0, max: 100
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Current Disaster Risk',
                data: [data10, data25, data40, data55, data70, data85, data100]
            }, {
                name: 'Original Disaster Risk',
                data: [3, 5, 9, 17, 38, 90, 100]
            }]
        });
  

}