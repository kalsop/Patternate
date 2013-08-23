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
	  
	  //Get selected pattern
	  

  
  	$query = "SELECT * FROM patterns where id=7";
    $result= mysql_query($query) or die(mysql_error());
    
    
    while ($row = mysql_fetch_assoc($result)) { 
     $rows[] = $row; 
   } 
   
   $patternID = $rows[0]['id'];
   $patternNumber = $rows[0]['pattern_number'];
   $patternCompanyID = $rows[0]['pattern_company_id'];

	  
	  
	  
	  ?>
	  
	  <label>Pattern company</label>
	  <select>
	  <?php
  
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
     
     if ($patternCompanyID == $id ) {
       echo 'selected ';
     } 
     
     echo '>';
     echo $name;
     echo '</option>';
     
     }


  

?>

    </select>
 

	  
	</body>
</html>