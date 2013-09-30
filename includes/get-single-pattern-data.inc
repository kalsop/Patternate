<?php

$query = "SELECT * FROM patterns ORDER BY id ASC";
$result= mysql_query($query) or die(mysql_error());  

while ($row = mysql_fetch_assoc($result)) { 
  $rows[] = $row; 
    
 } 

 
for($i=0;$i<count($rows);$i++) { 
  $id = $rows[$i]['id'];
  $garment_type_id = $rows[$i]['garment_type_id'];
  $garment_type_id_array = explode( ',', $garment_type_id );
  $style_id = $rows[$i]['style_id'];
  $style_id_array = explode( ',', $style_id );
  $sleeve_id = $rows[$i]['sleeve_id'];
  $sleeve_id_array = explode( ',', $sleeve_id );
  $neckline_id = $rows[$i]['neckline_id'];
  $neckline_id_array = explode( ',', $neckline_id );
  $size_id = $rows[$i]['size_id'];
  $size_id_array = explode( ',', $size_id );
  $fabric_id = $rows[$i]['fabric_id'];
  $fabric_id_array = explode( ',', $fabric_id );
  $pattern_company_id = $rows[$i]['pattern_company_id'];
  $patternCompany = getPatternCompanyNameById($pattern_company_id);

  $pattern_collection_id = $rows[$i]['pattern_collection_id'];
  if ($pattern_collection_id !== '') {
    $patternCollection = getPatternCollectionNameById($pattern_collection_id);
  }

  $patternNumber = $rows[$i]['pattern_number'];
  $mainImage = $rows[$i]['main_image'];
}

?>









?>