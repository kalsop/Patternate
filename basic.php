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
  
  	$query = "SELECT * FROM patterns ORDER BY id DESC";
    $result= mysql_query($query) or die(mysql_error());
    
    
    while ($row = mysql_fetch_assoc($result)) { 
     $rows[] = $row; 
   } 

?>
    
    <ul>
    
    <?php

     for($i=0;$i<count($rows);$i++) {         
        
        echo '<li>';
      
        // Establish variables
        $id = $rows[$i]['id'];
        echo $id . ' ';
        $garment_type_id = $rows[$i]['garment_type_id'];
        $pattern_company_id = $rows[$i]['pattern_company_id'];

      
        // Get pattern company name
        include 'includes/get-pattern-company.inc';  
      
        // Get pattern number
        $patternNumber = $rows[$i]['pattern_number'];
        echo $patternNumber;
        
        // Get pattern name
        include 'includes/get-pattern-name.inc';         
      
        // Get garment type
        include 'includes/get-garment-type.inc';   
      
        // Get pattern for 
        include 'includes/get-pattern-for.inc';     
       
        // Get sizes
        include 'includes/get-sizes.inc';
        
        // Get fabric
        include 'includes/get-fabric.inc';

      
       echo '</li>';
       
      
      
      }

    
    
    ?>
  </ul>
      

	  
	</body>
</html>