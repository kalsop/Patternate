<?php

	require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output


?>
<html>
    <head>
        <title>Edit pattern</title>
    </head>
    <body>
    <p><a href="list.php">All patterns</a></p>

<?php

    if(isset($_GET['pattern'])) {
        $patternID = $_GET['pattern'];
	    // Get selected pattern
	  
  	    $query = "SELECT * FROM patterns where id=$patternID";
        $result= mysql_query($query) or die(mysql_error());
    
    
        while ($row = mysql_fetch_assoc($result)) { 
            $rows[] = $row; 
        } 
   
        // Set selected pattern variables for later use
        $patternID = $rows[0]['id'];
        $patternNumber = $rows[0]['pattern_number'];
        $patternCompanyID = $rows[0]['pattern_company_id'];
        $patternCollection = $rows[0]['pattern_collection_id'];
    
        $patternURL = $rows[0]['url'];
        $mainImage = $rows[0]['main_image'];
        $lineDrawing = $rows[0]['line_drawing'];
        $separateCupSizes= $rows[0]['separate_cup_sizes'];
        $releaseDate= $rows[0]['release_date'];
        $url = $rows[0]['url'];
        $mainImage = $rows[0]['main_image'];
        $lineDrawing = $rows[0]['line_drawing'];
} 
?>
	  
    <h1>

<?php 
    
    if(isset($_GET['pattern'])) {
        $patternCompanyQuery = "SELECT * from pattern_company WHERE id = $patternCompanyID";
        $patternCompanyData= mysql_query($patternCompanyQuery) or die(mysql_error());
 
        while($row = mysql_fetch_array( $patternCompanyData)) {
            $patternCompany = $row['name'];
            echo $patternCompany . ' ' . $patternNumber;
        }
    } else {
        echo "Add new pattern";
    }
    

?>
        
    </h1>
	  
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
        
        // print name of parent pattern company  
        echo '<li><input type="radio" name="pattern_company" value="' . $getPatternCompaniesID . '" id="' . $getPatternCompaniesSlug . '"';
           
        if ($getPatternCompaniesID == $patternCompanyID) {
            echo 'checked ';
        } 
           
        echo '>';
        echo '<label for="' . $getPatternCompaniesSlug . '">';
        echo $getPatternCompaniesName;
        echo '</label>';
        
        // find any child collections   
        $getPatternCompaniesCollectionQuery = "SELECT * FROM collection WHERE pattern_company_id = $getPatternCompaniesID";
        $getPatternCompaniesCollectionResult = mysql_query($getPatternCompaniesCollectionQuery) or die(mysql_error());
        
        if ($getPatternCompaniesCollectionResult !== NULL) { 
           echo '<ul>';
         while ($getPatternCompaniesCollectionRow = mysql_fetch_assoc($getPatternCompaniesCollectionResult)) { 
               $getPatternCompaniesCollectionRows[] = $getPatternCompaniesCollectionRow; 
           } 
         
           for($z=0;$z<count($getPatternCompaniesCollectionRows);$z++) { 
               
               $getPatternCompaniesCollectionID = $getPatternCompaniesCollectionRows[$z]['id'];
               $getPatternCompaniesCollectionName = $getPatternCompaniesCollectionRows[$z]['name'];
               $getPatternCompaniesCollectionSlug = $getPatternCompaniesCollectionRows[$z]['slug'] . '-' . $getPatternCompaniesSlug;
               $getPatternCompaniesCollectionParentID = $getPatternCompaniesCollectionRows[$z]['pattern_company_id'];
               
              
               if ($getPatternCompaniesCollectionParentID == $getPatternCompaniesID) {
               
               echo '<li class="collection"><input type="checkbox" name="pattern_collection" value="' . $getPatternCompaniesCollectionID . '" id="' . $getPatternCompaniesCollectionSlug . '"';
               // Add check for existing collection 
               if ($getPatternCompaniesCollectionID == $patternCollection) {
            echo 'checked ';
        } 
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
           echo '</ul>';
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
      
      include 'includes/get-elements-check-selected.inc'; 
     

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
                    
                   <label for="url">Pattern URL</label>
      <input type="text" id="url" name="url" value="<?php echo $url; ?>">
      <label for="mainImage">Main image</label>
      <input type="text" id="mainImage" name="main_image" value="<?php echo $mainImage; ?>">
      <label for="lineDrawing">Line drawing</label>
      <input type="text" id="lineDrawing" name="line_drawing" value="<?php echo $lineDrawing; ?>">
      </fieldset>
      
      <fieldset>
                    <legend>Separate cup sizes</legend>
                    
                   
      <input type="checkbox" id="separateCupSizes" name="separate_cup_sizes" <?php  if ($separateCupSizes == on) {
                                echo 'checked ';
                            }  ?> >
                            <label for="separateCupSizes">Separate cup sizes</label>
     
      </fieldset>
      
      <fieldset>
          <legend>Release date</legend>
          <label for="releaseDate">Release date</label>
          <input type="date" name="release_date" id="releaseDate" value="<?php if(isset($_GET['pattern'])) {echo $releaseDate;}?>">
    </fieldset>
          
      
      
      
      
      
      
     
      
      
      
      
      
      
      
      
      <input type="hidden" name="pattern_id" id="pattern_id" value="<?php if(isset($_GET['pattern'])) {echo $patternID;} else {echo "add";} ?>">
      <input type="submit" id="<?php if(isset($_GET['pattern'])) {echo "update";} else {echo "add";} ?>" name="<?php if(isset($_GET['pattern'])) {echo "update";} else {echo "add";} ?>" value="<?php if(isset($_GET['pattern'])) {echo "Update";} else {echo "Add";} ?>">
    </form>
 


</body>
</html>