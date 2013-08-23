<?php

      //Get fabric
      
        // 1. get array data stored in fabric_id of the pattern = [1,2,3]
       $fabricExplode = $rows[$i]['fabric_id'];
        $fabric_id_array = explode( ',', $fabricExplode );
//        print_r($fabric_id_array);
        
               // 2. Loop through array to get each pattern_for id
       for ($l = 0; $l < count($fabric_id_array); ++$l) {
    
        // 3. Get 'name' of where id = pattern_for_id
      
          $fabricQuery = "SELECT * from fabrics WHERE id = $fabric_id_array[$l]";
          $fabricData= mysql_query($fabricQuery) or die(mysql_error());
 
         while($fabricRow = mysql_fetch_array( $fabricData)) {
           $fabric = $fabricRow['name'];
          echo $fabric . ' ';
 
          }  
       }
       
?>