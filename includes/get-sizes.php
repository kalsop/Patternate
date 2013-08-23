      //Get sizes
      
        // 1. get array data stored in sizes_id of the pattern = [1,2,3]
       $sizesExplode = $rows[$i]['sizes_id'];
        $sizes_id_array = explode( ',', $sizesExplode );
//        print_r($sizes_id_array);
        
               // 2. Loop through array to get each pattern_for id
       for ($k = 0; $k < count($sizes_id_array); ++$k) {
    
        // 3. Get 'name' of where id = pattern_for_id
      
          $sizesQuery = "SELECT * from sizes WHERE id = $sizes_id_array[$k]";
          $sizesData= mysql_query($sizesQuery) or die(mysql_error());
 
         while($sizesRow = mysql_fetch_array( $sizesData)) {
           $sizes = $sizesRow['name'];
          echo $sizes . ' ';
 
          }  
       }