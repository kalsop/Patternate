<?php

	require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output


?><html>
<head>
<title>Update a Record in MySQL Database</title>
</head>
<body>

<?php






    if(isset($_GET['pattern']))
$patternID = $_GET['pattern'];
	
    
      // Get selected pattern
	  
  	$query = "SELECT * FROM patterns where id=$patternID";
    $result= mysql_query($query) or die(mysql_error());
    
    
    while ($row = mysql_fetch_assoc($result)) { 
     $rows[] = $row; 
    } 
   
    // Set selected pattern varaibles for later use
    $patternID = $rows[0]['id'];
    $patternNumber = $rows[0]['pattern_number'];
    $patternCompanyID = $rows[0]['pattern_company_id'];
    
    $patternURL = $rows[0]['url'];
    $mainImage = $rows[0]['main_image'];
    $lineDrawing = $rows[0]['line_drawing'];
    $separateCupSizes= $rows[0]['separate_cup_sizes'];
    	  ?>
	  
	  <h1>
	  <?php 
	          $patternCompanyQuery = "SELECT * from pattern_company WHERE id = $patternCompanyID";
        $patternCompanyData= mysql_query($patternCompanyQuery) or die(mysql_error());
 
        while($row = mysql_fetch_array( $patternCompanyData)) {
          $patternCompany = $row['name'];
          echo $patternCompany . ' ' . $patternNumber;
          
      
        } ?></h1>
	  <form action="list.php" method="post">
    <fieldset>
	    <legend>Pattern company and collection</legend>
        <ul class="patternCompanies">
	    <?php
  
      // Get list of pattern companies
    
    	$getPatternCompaniesQuery = "SELECT * FROM pattern_company";
      $getPatternCompaniesResult= mysql_query($getPatternCompaniesQuery) or die(mysql_error());
    
       while ($getPatternCompaniesRow = mysql_fetch_assoc($getPatternCompaniesResult)) { 
       $getPatternCompaniesRows[] = $getPatternCompaniesRow; 
     } 
   
     for($i=0;$i<count($getPatternCompaniesRows);$i++) { 
     
     
     
     
       $getPatternCompaniesID = $getPatternCompaniesRows[$i]['id'];
       $getPatternCompaniesName = $getPatternCompaniesRows[$i]['name'];
       $getPatternCompaniesSlug = $getPatternCompaniesRows[$i]['slug'];
           
           echo '<li><input type="radio" name="pattern_company" value="' . $getPatternCompaniesID . '" id="' . $getPatternCompaniesSlug . '"';
           if ($getPatternCompaniesID == $patternCompanyID) {
               echo 'checked ';
           } 
           echo '>';
           echo '<label for="' . $getPatternCompaniesSlug . '">';
           echo $getPatternCompaniesName;
           echo '</label>';
           
           $getPatternCompaniesCollectionQuery = "SELECT * FROM collection WHERE pattern_company_id = $getPatternCompaniesID";
           $getPatternCompaniesCollectionResult= mysql_query($getPatternCompaniesCollectionQuery) or die(mysql_error());
           
           
           while ($getPatternCompaniesCollectionRow = mysql_fetch_assoc($getPatternCompaniesCollectionResult)) { 
               $getPatternCompaniesCollectionRows[] = $getPatternCompaniesCollectionRow; 
           } 
         
           for($z=0;$z<count($getPatternCompaniesCollectionRows);$z++) { 
               
               $getPatternCompaniesCollectionID = $getPatternCompaniesCollectionRows[$z]['id'];
               $getPatternCompaniesCollectionName = $getPatternCompaniesCollectionRows[$z]['name'];
               $getPatternCompaniesCollectionSlug = $getPatternCompaniesCollectionRows[$z]['slug'] . '-' . $getPatternCompaniesSlug;
               $getPatternCompaniesCollectionParentID = $getPatternCompaniesCollectionRows[$z]['pattern_company_id'];
               
              
               if ($getPatternCompaniesCollectionParentID == $getPatternCompaniesID) {
               
               echo '<li class="collection"><input type="radio" name="' . $getPatternCompaniesSlug . '" value="' . $getPatternCompaniesCollectionID . '" id="' . $getPatternCompaniesCollectionSlug . '"';
               echo '>';
               echo '<label for="' . $getPatternCompaniesCollectionSlug . '">';
               echo $getPatternCompaniesCollectionName;
               echo '</label></li>';
            }
            
              
               
       
               // echo '<input type="checkbox" value="' . $getPatternCompaniesCollectionID . '" id="' . $getPatternCompaniesCollectionSlug . '"';
               //                echo '>';
               //                echo '<label for="' . $getPatternCompaniesCollectionSlug . '">';
               //                echo $getPatternCompaniesCollectionName;
               //                echo '</label>';
           
           
           }
          
          
       
   }
  

       ?>
</fieldset>

      
      <!--<a href="">Add new pattern company</a>--> 
    
    <fieldset>
        <legend>Pattern number</legend>
      <label for="patternNumber">Pattern number</label>
      <input type="text" id="patternNumber" name="pattern_number" value="<?php echo $patternNumber; ?>">
      </fieldset>
      
                 
     <?php 
      
      
      function getElementsCheckSelected($facetInfo,$patternRow) {
		$element = $facetInfo[0];
		$friendlyName = $facetInfo[1];
		echo "<fieldset><legend>" . $friendlyName . "</legend>";
	$columnName = $element . '_id';


      $elementExplode = $patternRow[$columnName];
      $element_id_array = explode( ',', $elementExplode );
      
      
      
      // Get fabric
    
        $getElementQuery = "SELECT * FROM $element order by name ASC";
                      $getElementResult= mysql_query($getElementQuery) or die(mysql_error());
                      
                    
                    
                       while ($getElementRow = mysql_fetch_assoc($getElementResult)) { 
                                                           $getElementRows[] = $getElementRow; 
                                                         } 
                                                       
                                                         for($q=0;$q<count($getElementRows);$q++) { 
                                                         
                                                           $elementID = $getElementRows[$q]['id'];
                                                           $elementName = $getElementRows[$q]['name'];
                                                           $elementSlug = $getElementRows[$q]['slug'];
                                                 
                                                          
                                                           
    echo '<input type="checkbox" name="' . $columnName . '[]" value="' . $elementID . '" id="' . $elementSlug . '"';
                                              
                                                           // Pre-select existing sizes
                                                           // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                                                           // 2. Cycle through the array and check when printing each size from the available size list
                                                           // 3. If the size ID is in the array, then check the check box 
                                                            
                                                          
                                                                                  for ($t=0;$t<count($element_id_array);++$t) {
                            if ($element_id_array[$t] == $elementID) {
                                echo 'checked ';
                            } 
                        }
                                                          
                                                          
                                                          
                                                            
                                                            echo '>';
                                                             echo '<label for="' . $elementSlug . '">';
                                                         
                                                           echo $elementName;
                                                           
                                                           echo '</label>';
                                                           
                                              
                                                        }   
		
		echo "</fieldset>";
		
		
		
		
	}

$elements = array(
    array('fabric', 'Fabric'),
    array('garment_type', 'Garment Type'), 
    array('size', 'Size'),
    array('pattern_for', 'Pattern For'),
    array('style', 'Style'), 
    array('sleeve', 'Sleeve'),
    array('neckline', 'Neckline')    
      
);
for ($e=0;$e<count($elements);++$e) {
   getElementsCheckSelected($elements[$e],$rows[0]) ;                     
}

                    ?>
    
    
    
    
    
    
    
    
    
       
                    <fieldset>
                    <legend>Pattern images</legend>
                    
                   <label for="patternURL">Pattern URL</label>
      <input type="text" id="patternURL" name="pattern_url" value="<?php echo $patternURL; ?>">
      <label for="mainImage">Main image</label>
      <input type="text" id="mainImage" name="main_image" value="<?php echo $mainImage; ?>">
      <label for="lineDrawing">Line drawing</label>
      <input type="text" id="lineDrawing" name="line_drawing" value="<?php echo $lineDrawing; ?>">
      </fieldset>
      
      <fieldset>
                    <legend>Separate cup sizes</legend>
                    
                   
      <input type="checkbox" id="separateCupSizes" name="separate_cup_sizes" <?php  if ($separateCupSizes == 1) {
                                echo 'checked ';
                            } else {
                                echo 'djsklj ';
                            } ?> >
                            <label for="separateCupSizes">Separate cup sizes</label>
     
      </fieldset>
      
      
      
      
      
      
     
      
      
      
      
      
      
      
      
      <input type="hidden" name="id" id="id" value="<?php echo $patternID; ?>">
      <input type="submit" id="update" name="update" value="Update">
    </form>
 


</body>
</html>