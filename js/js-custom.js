    
 var url = "controller.php?" + "year=";

$( document ).ready(function() {
     
    loadTable(2010);

    // groupsInput();

    hideRows();

/*****************************************************************

* Change Header Numbers Style when Selected
*
* ****************************************************************/
/*function tableHeaderStyle()
{
    var year = $("#")
    $(selector).click(function)
}
*/

/*****************************************************************

* Show and Hide Rows
*
* ****************************************************************/
function hideRows()
{
    $("#hideMenu li a").click(function(e) {
      e.preventDefault();
      var  name = $(this).attr('name');


      $( "#" + name ).toggle('slow');
      
      var text = $( this ).text();

       if(text == "Show All Rows")
      {
         
        var elem = $(".variablesRow")
        elem.show('slow');

      }

      else if(text == "Hide All Rows")
      {
         
        var elem = $(".variablesRow")
        elem.hide('slow');

      }

     

    });
}

/*****************************************************************
* GROUPS INPUT
* Increment or Decrement number of Groups
// * ****************************************************************/
// function groupsInput()
// {

//   $('.btn-number').click(function(e){
//       e.preventDefault();
      
//       fieldName = $(this).attr('data-field');
//       type      = $(this).attr('data-type');
//       var input = $("input[name='"+fieldName+"']");
//       var currentVal = parseInt(input.val());
//       if (!isNaN(currentVal)) {
//           if(type == 'minus') {
              
//               if(currentVal > input.attr('min')) {
//                   input.val(currentVal - 1).change();
//               } 
//               if(parseInt(input.val()) == input.attr('min')) {
//                   $(this).attr('disabled', true);
//               }

//           } else if(type == 'plus') {

//               if(currentVal < input.attr('max')) {
//                   input.val(currentVal + 1).change();
//               }
//               if(parseInt(input.val()) == input.attr('max')) {
//                   $(this).attr('disabled', true);
//               }

//           }
//       } else {
//           input.val(0);
//       }
//   });
//   $('.input-number').focusin(function(){
//      $(this).data('oldValue', $(this).val());
//   });
//   $('.input-number').change(function() {
      
//       minValue =  parseInt($(this).attr('min'));
//       maxValue =  parseInt($(this).attr('max'));
//       valueCurrent = parseInt($(this).val());
      
//       name = $(this).attr('name');
//       if(valueCurrent >= minValue) {
//           $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
//       } else {
//           alert('Sorry, the minimum value was reached');
//           $(this).val($(this).data('oldValue'));
//       }
//       if(valueCurrent <= maxValue) {
//           $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
//       } else {
//           alert('Sorry, the maximum value was reached');
//           $(this).val($(this).data('oldValue'));
//       }
      

//   });
//   $(".input-number").keydown(function (e) {
//           // Allow: backspace, delete, tab, escape, enter and .
//           if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
//                // Allow: Ctrl+A
//               (e.keyCode == 65 && e.ctrlKey === true) || 
//                // Allow: home, end, left, right
//               (e.keyCode >= 35 && e.keyCode <= 39)) {
//                    // let it happen, don't do anything
//                    return;
//           }
//           // Ensure that it is a number and stop the keypress
//           if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
//               e.preventDefault();
//           }
//       });
// }

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

         // OLD Code   
         /* $(".num_groups").click(function( event ) {
              event.preventDefault();
              groups = $(this).text();
              additional_params = "";
              additional_params += "&num_groups="+groups;
              loadTable(year, additional_params)     
          });*/

          // $(".groupsInput").click(function( event ) {
          //     event.preventDefault();
          //     groups = $("#input-info").val();
          //     additional_params = "";
          //     additional_params += "&num_groups="+groups;
          //     loadTable(year, additional_params)     
          // });


     });

}


// END of DocumentReady
});