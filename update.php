<?php

	require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output


?>
<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
	</head>
	<body>
	  
	  <?php
	  
	  // Get selected pattern
	  
  	$query = "SELECT * FROM patterns where id=7";
    $result= mysql_query($query) or die(mysql_error());
    
    
    while ($row = mysql_fetch_assoc($result)) { 
     $rows[] = $row; 
    } 
   
    // Set selected pattern varaibles for later use
    $patternID = $rows[0]['id'];
    $patternNumber = $rows[0]['pattern_number'];
    $patternCompanyID = $rows[0]['pattern_company_id'];
    $sizesExplode = $rows[0]['sizes_id'];  
    $sizes_id_array = explode( ',', $sizesExplode );

	  
	  
	  
	  ?>
	  
	  <form action="update.php" method="post">
	    <label>Pattern company</label>
	    <select>
	    <?php
  
      // Get list of pattern companies
    
    	$getPatternCompaniesQuery = "SELECT * FROM pattern_company";
      $getPatternCompaniesResult= mysql_query($getPatternCompaniesQuery) or die(mysql_error());
    
       while ($getPatternCompaniesRow = mysql_fetch_assoc($getPatternCompaniesResult)) { 
       $getPatternCompaniesRows[] = $getPatternCompaniesRow; 
     } 
   
     for($i=0;$i<count($getPatternCompaniesRows);$i++) { 
     
     
     
     
       $id = $getPatternCompaniesRows[$i]['id'];
       $name = $getPatternCompaniesRows[$i]['name'];
     
       echo '<option value="';
     
       echo $id . '" ';
     
       // Pre-select existing pattern company
     
       if ($patternCompanyID == $id ) {
         echo 'selected ';
       } 
     
       echo '>';
       echo $name;
       echo '</option>';
     
       }


  

       ?>

      </select>
    
      <label for="patternNumber">Pattern number</label>
      <input type="text" id="patternNumber" value="<?php echo $patternNumber; ?>">
      
      <legend>Sizes</legend>
        
        <?php
  
      // Get list of sizes
    
        $getSizesQuery = "SELECT * FROM sizes order by name ASC";
                      $getSizesResult= mysql_query($getSizesQuery) or die(mysql_error());
                    
                       while ($getSizesRow = mysql_fetch_assoc($getSizesResult)) { 
                       $getSizesRows[] = $getSizesRow; 
                     } 
                   
                     for($j=0;$j<count($getSizesRows);$j++) { 
                     
                     
                     
                     
                       $sizesID = $getSizesRows[$j]['id'];
                       $sizesName = $getSizesRows[$j]['name'];
                       //echo $sizesID . " ";
                       //echo $sizesName . "   ";
                   
             
                       echo '<label for="' . $sizesID . '">';
                     
                       echo $sizesName;
                       
                       echo '</label>';
                       
                       echo '<input type="checkbox" value="' . $sizesID . '" id="' . $sizesID . '"';

                       // Pre-select existing sizes
                       // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                       // 2. Cycle through the array and check when printing each size from the available size list
                        
                        for ($n=0;$n<count($sizes_id_array);++$n) {
                            if ($sizes_id_array[$n] == $sizesID) {
                                echo 'checked ';
                            } 
                        }
                        
                        
                        // 3. If the size ID is in the array, then check the check box 
                       
                       echo '>';
                       
 
                       
                     

                        
                        
                        
                      // if ($sizesID == $id ) {
                    //     echo 'checked ';
                     //  } 
                     
                   //    echo '>';
                       
                     
                       }
                
                
                  
                
                       ?>
    
      <input type="submit" >
    </form>
 

	  
	</body>
</html>