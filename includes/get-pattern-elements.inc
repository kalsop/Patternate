<?php

// The function to...  
  function getPatternElements($facetInfo) {
		$element = $facetInfo[0];
	  $columnName = $element . '_id';
    $pattern_element_id_array = $facetInfo[1]; 
    $friendlyName = $facetInfo[2];
 
  
    // For every item in the array of style IDs...
  
   for ($l=0;$l<count($pattern_element_id_array);++$l) {
     
     echo '<h3>' . $friendlyName . '</h3>';
   
    // Get the individual attribute ID from the element array (e.g. 2nd item in array of style IDs)
   
      $getMyQuery = "SELECT * FROM $element WHERE ID = $pattern_element_id_array[$l]";
      $getMyResult= mysql_query($getMyQuery) or die(mysql_error());
      while ($myRow = mysql_fetch_assoc($getMyResult)) { 
                $myRows[] = $myRow; 
            } 
            
             for ($k=0;$k<count($myRows);++$k) {
        
               echo $myRows[$k]['name'] . ' ';
             }
      }
}






// Still need to elimate the duplication of attributes
 


      


  

?>
