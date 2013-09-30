<?php

	require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output
    include 'includes/get-pattern-collection.inc'; 
    include 'includes/get-pattern-company.inc';
    include 'includes/get-pattern-elements.inc';
?>



<?php

    

	    // Get selected pattern
	  
  	    $query = "SELECT * FROM patterns where id=10";

        $result= mysql_query($query) or die(mysql_error());
    
    
        while ($row = mysql_fetch_assoc($result)) { 
            $rows[] = $row; 
        } 
   
        // Set selected pattern variables for later use
        $patternID = $rows[0]['id'];
        $patternNumber = $rows[0]['pattern_number'];
        $pattern_company_id = $rows[0]['pattern_company_id'];
        $patternCompany = getPatternCompanyNameById($pattern_company_id);
        $patternCollection = $rows[0]['pattern_collection_id'];
    
        $patternURL = $rows[0]['url'];
        $mainImage = $rows[0]['main_image'];
        $lineDrawing = $rows[0]['line_drawing'];
        $separateCupSizes= $rows[0]['separate_cup_sizes'];
        $releaseDate= $rows[0]['release_date'];
        $url = $rows[0]['url'];
        $mainImage = $rows[0]['main_image'];
        $lineDrawing = $rows[0]['line_drawing'];
        $patternTitle = $patternCompany . ' ' . $patternNumber;
        $garment_type_id = $rows[0]['garment_type_id'];
        $garment_type_id_array = explode( ',', $garment_type_id );
        $style_id = $rows[0]['style_id'];
        $style_id_array = explode( ',', $style_id );
        $sleeve_id = $rows[0]['sleeve_id'];
        $sleeve_id_array = explode( ',', $sleeve_id );
        $neckline_id = $rows[0]['neckline_id'];
        $neckline_id_array = explode( ',', $neckline_id );
        $size_id = $rows[0]['size_id'];
        $size_id_array = explode( ',', $size_id );
        $fabric_id = $rows[0]['fabric_id'];
        $fabric_id_array = explode( ',', $fabric_id );

 
?>

<html>
    <head>
        <title><?php echo $patternTitle; ?></title>
    </head>
    <body>
 
	  
    <h1><?php echo $patternTitle; ?></h1>
	  
  
      
    <img src="<?php echo $mainImage; ?>" />
    
    <?php
    
    
    $patternElements = array(
    array('neckline', $neckline_id_array, 'Neckline'),
    array('style', $style_id_array, 'Style'), 
    array('size', $size_id_array, 'Sizes'),
    array('sleeve', $sleeve_id_array, 'Sleeves'),
    array('garment_type', $garment_type_id_array, 'Garment Type'),
    array('fabric', $fabric_id_array, 'Suitable fabrics')
      
);
      
//  For every row in the array of elements ($patternElements) ...
    
    for ($e=0;$e<count($patternElements);++$e) {
        getPatternElements($patternElements[$e]) ;                     
      }

    
  ?>
 


</body>
</html>