<?php

if ( $handle = fopen( 'file_downloaded/pizza_types.csv', 'r' ) ) {
    $pizza_type_id ="";
    $name = "";
    $category = "";
    $ingredients = "";
    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
      $pizza_type_id = $row[0];
      $name = $row[1];
      $category = $row[2];
      $ingredients = $row[3];
      print_r($name);

    }
    fclose($handle);
}

?>