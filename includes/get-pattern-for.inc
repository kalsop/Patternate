<?php
        //Get pattern for
      
        // 1. get array data stored in pattern_for_id of the pattern = [1,2,3]
       $patternForExplode = $rows[$i]['pattern_for_id'];
        $pattern_for_id_array = explode( ',', $patternForExplode );
      
      
        // 2. Loop through array to get each pattern_for id
       for ($j = 0; $j < count($pattern_for_id_array); ++$j) {
    
        // 3. Get 'name' of where id = pattern_for_id
      
          $patternForQuery = "SELECT * from pattern_for WHERE id = $pattern_for_id_array[$j]";
          $patternForData= mysql_query($patternForQuery) or die(mysql_error());
 
         while($patternForRow = mysql_fetch_array( $patternForData)) {
           $patternFor = $patternForRow['name'];
          echo $patternFor;
 
          }  
       }

?>