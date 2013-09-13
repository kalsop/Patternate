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
	  
	  
	  if(isset($_POST['update']))
{
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$patternID = $_POST['id'];
$patternNumber = $_POST['pattern_number'];
$patternCompany = $_POST['pattern_company'];

$sizesID = implode(',', $_POST['size_id']);
$patternForID = implode(',', $_POST['pattern_for_id']);
$garmentTypeID = implode(',', $_POST['garment_type_id']);
$fabricsID = implode(',', $_POST['fabric_id']);
$necklinesID = implode(',', $_POST['neckline_id']);
$sleevesID = implode(',', $_POST['sleeve_id']);
$stylesID = implode(',', $_POST['style_id']);



$sql = "UPDATE patterns SET pattern_number = $patternNumber, pattern_company_id = $patternCompany, size_id = '$sizesID', pattern_for_id = '$patternForID', garment_type_id = '$garmentTypeID', fabric_id = '$fabricsID', neckline_id = '$necklinesID', sleeve_id = '$sleevesID', style_id = '$stylesID' WHERE id = $patternID" ;


mysql_select_db('patternate-scratch');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
//echo "Updated data successfully\n";
//mysql_close($conn);
}


	  
	  
	  
	  
  
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
        //echo $id . ' ';
        $garment_type_id = $rows[$i]['garment_type_id'];
        $pattern_company_id = $rows[$i]['pattern_company_id'];

        echo "<a href='edit.php?pattern=" . $id . "'>";
        //echo "<input type='button' value='" . $id . "' />";
        // Get pattern company name
        include 'includes/get-pattern-company.inc';  
      
        // Get pattern number
        $patternNumber = $rows[$i]['pattern_number'];
        echo $patternNumber;
        
        // Get pattern name
        include 'includes/get-pattern-name.inc';   
        
        echo "</a>";      
      
        // Get garment type
        include 'includes/get-garment-type.inc';   
      
        // Get pattern for 
        include 'includes/get-pattern-for.inc';     


      
       echo '</li>';
       
      
      
      }
  

    
    
    ?>
  </ul>
      

	  
	</body>
</html>