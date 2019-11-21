<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  require_once(__DIR__ . '/../../../config.php');

  include_once 'objects/orgstructure.php';


  $orgstructure = new orgstructure();

  // Category read query
  $result = $orgstructure->read();
  
  // Get row count
  $num = count($result);
  // Check if any categories
  if($num > 0) {
        // Cat array
        $cat_arr = array();
        $cat_arr['data'] = array();

        array_push($cat_arr['data'], $result);
        // Turn to JSON & output
        echo json_encode($cat_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
