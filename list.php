<?php

	require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output
	include 'includes/get-pattern-collection.inc'; 
	include 'includes/get-pattern-company.inc'; 
	


?>
<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
	<link rel="stylesheet" type="text/css" media="all" href="css/list.css">
	</head>
	<body>
	  
	  <p><a href="edit.php">Add new pattern</a></p>
	  
	  
	  <?php
	  
	  
// Put this in to get-update.inc	  

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

$patternID = $_POST['pattern_id'];
$patternNumber = $_POST['pattern_number'];
$patternCompany = $_POST['pattern_company'];
$patternCollection = $_POST['pattern_collection'];
$sizesID = implode(',', $_POST['size_id']);
$patternForID = implode(',', $_POST['pattern_for_id']);
$garmentTypeID = implode(',', $_POST['garment_type_id']);
$fabricsID = implode(',', $_POST['fabric_id']);
$necklinesID = implode(',', $_POST['neckline_id']);
$sleevesID = implode(',', $_POST['sleeve_id']);
$stylesID = implode(',', $_POST['style_id']);
$separateCupSizes = $_POST['separate_cup_sizes'];
$releaseDate = $_POST['release_date'];
$url = $_POST['url'];
$mainImage = $_POST['main_image'];
$lineDrawing = $_POST['line_drawing'];


$sql = "UPDATE patterns SET pattern_number = '$patternNumber', pattern_company_id = '$patternCompany', pattern_collection_id = '$patternCollection', size_id = '$sizesID', pattern_for_id = '$patternForID', garment_type_id = '$garmentTypeID', fabric_id = '$fabricsID', neckline_id = '$necklinesID', sleeve_id = '$sleevesID', style_id = '$stylesID', separate_cup_sizes = '$separateCupSizes', release_date = '$releaseDate', url = '$url', main_image = '$mainImage', line_drawing = '$lineDrawing' WHERE id = $patternID" ;


mysql_select_db('patternate-scratch');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
//echo "Updated data successfully\n";
//mysql_close($conn);
}

// Put this in to get-new-pattern.inc


if(isset($_POST['add']))
{
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

//$patternID = $_POST['id'];
$patternNumber = $_POST['pattern_number'];
$patternCompany = $_POST['pattern_company'];
$patternCollection = $_POST['pattern_collection'];
$sizesID = implode(',', $_POST['size_id']);
$patternForID = implode(',', $_POST['pattern_for_id']);
$garmentTypeID = implode(',', $_POST['garment_type_id']);
$fabricsID = implode(',', $_POST['fabric_id']);
$necklinesID = implode(',', $_POST['neckline_id']);
$sleevesID = implode(',', $_POST['sleeve_id']);
$stylesID = implode(',', $_POST['style_id']);
$separateCupSizes = $_POST['separate_cup_sizes'];
$releaseDate = $_POST['release_date'];
$url = $_POST['url'];
$mainImage = $_POST['main_image'];
$lineDrawing = $_POST['line_drawing'];




$sql = "INSERT INTO patterns (pattern_number, pattern_company_id, pattern_collection_id, size_id, pattern_for_id, garment_type_id, fabric_id, neckline_id, sleeve_id, style_id, separate_cup_sizes, release_date, url, main_image, line_drawing) VALUES ('$patternNumber', '$patternCompany', '$patternCollection', '$sizesID', '$patternForID', '$garmentTypeID', '$fabricsID', '$necklinesID', '$sleevesID', '$stylesID', '$separateCupSizes', '$releaseDate', '$url', '$mainImage', '$lineDrawing')";
//echo $sql;


mysql_select_db('patternate-scratch');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not update add data: ' . mysql_error());
}
//echo "Updated data successfully\n";
//mysql_close($conn);
}

	  
	  
	  
	  
  
  	$query = "SELECT * FROM patterns ORDER BY id ASC";
    $result= mysql_query($query) or die(mysql_error());
    
    
    while ($row = mysql_fetch_assoc($result)) { 
     $rows[] = $row; 
   } 

?>
    
    <table>
        <tr>
            <th>Image</th>
            <th>Pattern</th>
            <th>Garment type</th>
            <th>Pattern for</th>
            
    
    <?php
    
    // need to add something to stop the loop failing if all fields aren't set - e.g. no garment type
    
    

     for($i=0;$i<count($rows);$i++) {         
        
        echo '<tr>';
      
        // Establish variables
        $id = $rows[$i]['id'];
        //echo $id . ' ';
        $garment_type_id = $rows[$i]['garment_type_id'];
        $pattern_company_id = $rows[$i]['pattern_company_id'];
        $pattern_collection_id = $rows[$i]['pattern_collection_id'];
        $mainImage = $rows[$i]['main_image'];
        
        
        // Get picture if exists
        
        
        echo "<td>";
        if ($mainImage !== '') {
            echo "<img src='" . $mainImage . "'>"; 
        } 
        echo "</td><td>";        
        

        echo "<a href='edit.php?pattern=" . $id . "'>";
        //echo "<input type='button' value='" . $id . "' />";
        // Get pattern company name
        echo getPatternCompanyNameById($pattern_company_id) . ' ';

        // Get pattern number
        $patternNumber = $rows[$i]['pattern_number'];
        echo $patternNumber . " ";


        // Get pattern collection if exists
        if ($pattern_collection_id !== '') {
            echo getPatternCollectionNameById($pattern_collection_id) . " "; 
        } 
        
        // Get pattern name if exists
        include 'includes/get-pattern-name.inc';   
        
        echo "</a></td>";      
        echo '<td>';
        // Get garment type
        include 'includes/get-garment-type.inc';   
        echo '</td><td>';
        
        // Get pattern for 
        include 'includes/get-pattern-for.inc';     

        echo '</td>';
      
       echo '</tr>';
       
      
      
      }
  

    
    
    ?>
  </table>
      

	  
	</body>
</html>