<?php
include "index2.php";
  // session_start();

  $scenario_model->change_decision(1, 6);

  for ($x=1; $x<=16; $x++){
    if (isset($_POST['group'.$x.'Decision']))
      $scenario_model->change_decision($x, $_POST['group'.$x.'Decision']);
  }

  // include "view2.php";
  // exit;

?>