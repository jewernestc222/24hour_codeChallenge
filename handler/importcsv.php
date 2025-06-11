<?php

$pizza_type_id ="";
    $name = "";
    $category = "";
    $ingredients = "";
    $xy[] ="";
if ( $handle = fopen( 'file_downloaded/pizza_types.csv', 'r' ) ) {
    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
      $pizza_type_id = str_replace(',', '', $row[0]);
      $name = str_replace(',', '', $row[1]);
      $category = str_replace(',', '', $row[2]);
      $ingredients = str_replace(',', '', $row[3]);
      array_push($xy,(object)["pizza_type" => $pizza_type_id,"name" => $name, "category" => $category,"ingredients" => $ingredients]);
    }
}
echo json_encode($xy);
?>