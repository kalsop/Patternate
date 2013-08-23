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
  
  	$query = "SELECT * FROM patterns where id = 1";
    $result= mysql_query($query) or die(mysql_error());
    
     while ($row = mysql_fetch_assoc($result)) { 
     $rows[] = $row; 
   } 


 
 $garment_type_id = $rows[0]['garment_type_id'];
        $pattern_company_id = $rows[0]['pattern_company_id'];
        
        
        
        echo $$garment_type_id
   
  

?>
    
 

	  
	</body>
</html>