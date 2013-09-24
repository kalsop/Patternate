<?php
  $query = "SELECT * FROM patterns ORDER BY id ASC";
  $result= mysql_query($query) or die(mysql_error());  

  while ($row = mysql_fetch_assoc($result)) { 
    $rows[] = $row; 
      
   } 

   
for($i=0;$i<count($rows);$i++) { 	 
    
    // Establish variables
    $id = $rows[$i]['id'];
    $garment_type_id = $rows[$i]['garment_type_id'];
    $pattern_company_id = $rows[$i]['pattern_company_id'];
    $patternCompany = getPatternCompanyNameById($pattern_company_id);
    
    $pattern_collection_id = $rows[$i]['pattern_collection_id'];
    if ($pattern_collection_id !== '') {
        $patternCollection = getPatternCollectionNameById($pattern_collection_id);
    }
    
    $patternNumber = $rows[$i]['pattern_number'];
    $mainImage = $rows[$i]['main_image'];
//    echo $id;
//    echo $garment_type_id; 

    


        
?>