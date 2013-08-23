<?php
        // Get garment type

      
        // 1. get array data stored in sizes_id of the pattern = [1,2,3]
       $garmentTypeExplode = $rows[$i]['garment_type_id'];
        $garmentType_id_array = explode( ',', $garmentTypeExplode );
//        print_r($sizes_id_array);
        
               // 2. Loop through array to get each pattern_for id
       for ($m = 0; $m < count($garmentType_id_array); ++$m) {
    
        // 3. Get 'name' of where id = pattern_for_id
      
          $garmentTypeQuery = "SELECT * from garment_type WHERE id = $garmentType_id_array[$m]";
          $garmentTypeData= mysql_query($garmentTypeQuery) or die(mysql_error());
 
         while($garmentTypeRow = mysql_fetch_array( $garmentTypeData)) {
           $garmentType = $garmentTypeRow['name'];
          echo $garmentType . ' ';
 
          }  
       }
       
?>

