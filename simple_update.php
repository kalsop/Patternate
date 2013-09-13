<?php

	require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output


?><html>
<head>
<title>Update a Record in MySQL Database</title>
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

$sizesID = implode(',', $_POST['sizes_id']);
$patternForID = implode(',', $_POST['pattern_for_id']);
$garmentTypeID = implode(',', $_POST['garment_type_id']);
$fabricsID = implode(',', $_POST['fabric_id']);
$necklinesID = implode(',', $_POST['neckline_id']);
$sleevesID = implode(',', $_POST['sleeve_id']);
$stylesID = implode(',', $_POST['styles_id']);



$sql = "UPDATE patterns SET pattern_number = $patternNumber, pattern_company_id = $patternCompany, sizes_id = '$sizesID', pattern_for_id = '$patternForID', garment_type_id = '$garmentTypeID', fabric_id = '$fabricsID', neckline_id = '$necklinesID', sleeve_id = '$sleevesID', styles_id = '$stylesID' WHERE id = $patternID" ;
echo $sql;

mysql_select_db('patternate-scratch');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
echo "Updated data successfully\n";
mysql_close($conn);
}
else
{
    
    
      // Get selected pattern
	  
  	$query = "SELECT * FROM patterns where id=1";
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
    $garmentTypeExplode = $rows[0]['garment_type_id'];
    $garmentType_id_array = explode( ',', $garmentTypeExplode );
    $patternForExplode = $rows[0]['pattern_for_id'];
    $pattern_for_id_array = explode( ',', $patternForExplode );
    $fabricExplode = $rows[0]['fabric_id'];
    $fabric_id_array = explode( ',', $fabricExplode );
    $necklineExplode = $rows[0]['neckline_id'];
    $neckline_id_array = explode( ',', $necklineExplode );
    $sleeveExplode = $rows[0]['sleeve_id'];
    $sleeve_id_array = explode( ',', $sleeveExplode );
    $styleExplode = $rows[0]['styles_id'];
    $style_id_array = explode( ',', $styleExplode );
    $patternURL = $rows[0]['url'];
    $mainImage = $rows[0]['main_image'];
    $lineDrawing = $rows[0]['line_drawing'];
    $separateCupSizes= $rows[0]['separate_cup_sizes'];
    	  ?>
	  
	  
	  <form action="<?php $_PHP_SELF ?>" method="post">
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
      <fieldset>
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
                   
             
                       
                       
                       echo '<input type="checkbox" name="sizes_id[]" value="' . $sizesID . '" id="' . $sizesID . '"';

                       // Pre-select existing sizes
                       // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                       // 2. Cycle through the array and check when printing each size from the available size list
                       // 3. If the size ID is in the array, then check the check box 
                        
                        for ($n=0;$n<count($sizes_id_array);++$n) {
                            if ($sizes_id_array[$n] == $sizesID) {
                                echo 'checked ';
                            } 
                        }
                        
                        echo '>';
                        
                        echo '<label for="' . $sizesID . '">';
                     
                       echo $sizesName;
                       
                       echo '</label>';

                    }
                    ?>
                </fieldset>
                
                <fieldset>
                <legend>Garment type</legend>
        
        <?php
  
  
        // Get garment types
    
        $getGarmentTypeQuery = "SELECT * FROM garment_type order by name ASC";
                      $getGarmentTypeResult= mysql_query($getGarmentTypeQuery) or die(mysql_error());
                    
                       while ($getGarmentTypeRow = mysql_fetch_assoc($getGarmentTypeResult)) { 
                       $getGarmentTypeRows[] = $getGarmentTypeRow; 
                     } 
                   
                     for($m=0;$m<count($getGarmentTypeRows);$m++) { 
                     
                       $garmentTypeID = $getGarmentTypeRows[$m]['id'];
                       $garmentTypeName = $getGarmentTypeRows[$m]['name'];
                       $garmentTypeSlug = $getGarmentTypeRows[$m]['slug'];
             
                       
                       
                       echo '<input type="checkbox" name="garment_type_id[]" value="' . $garmentTypeID . '" id="' . $garmentTypeSlug . '"';

                       // Pre-select existing sizes
                       // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                       // 2. Cycle through the array and check when printing each size from the available size list
                       // 3. If the size ID is in the array, then check the check box 
                        
                        for ($n=0;$n<count($garmentType_id_array);++$n) {
                            if ($garmentType_id_array[$n] == $garmentTypeID) {
                                echo 'checked ';
                            } 
                        }
                        
                        echo '>';
                        echo '<label for="' . $garmentTypeSlug . '">';
                     
                       echo $garmentTypeName;
                       
                       echo '</label>';

                    }
                
                
                  
                
                      
  
  
      ?>
      </fieldset>
      
      
      <fieldset>
      <legend>Pattern for</legend>
      
      
      <?php 
      
      // Get pattern for
    
        $getPatternForQuery = "SELECT * FROM pattern_for order by name ASC";
                      $getPatternForResult= mysql_query($getPatternForQuery) or die(mysql_error());
                    
                       while ($getPatternForRow = mysql_fetch_assoc($getPatternForResult)) { 
                       $getPatternForRows[] = $getPatternForRow; 
                     } 
                   
                     for($o=0;$o<count($getPatternForRows);$o++) { 
                     
                       $patternForID = $getPatternForRows[$o]['id'];
                       $patternForName = $getPatternForRows[$o]['name'];
                       $patternForSlug = $getPatternForRows[$o]['slug'];
             
                      
                       
                       echo '<input type="checkbox" name="pattern_for_id[]" value="' . $patternForID . '" id="' . $patternForSlug . '"';

                       // Pre-select existing sizes
                       // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                       // 2. Cycle through the array and check when printing each size from the available size list
                       // 3. If the size ID is in the array, then check the check box 
                        
                        for ($p=0;$p<count($pattern_for_id_array);++$p) {
                            if ($pattern_for_id_array[$p] == $patternForID) {
                                echo 'checked ';
                            } else {
                                echo 'djsklj ';
                            } 
                        }
                        
                        echo '>';
                         echo '<label for="' . $patternForSlug . '">';
                     
                       echo $patternForName;
                       
                       echo '</label>';

                    }
                    ?>
                </fieldset>
                
                <fieldset>
                    
            <legend>Fabric</legend>
      
      <?php 
      
      // Get fabric
    
        $getFabricQuery = "SELECT * FROM fabrics order by name ASC";
                      $getFabricResult= mysql_query($getFabricQuery) or die(mysql_error());
                    
                       while ($getFabricRow = mysql_fetch_assoc($getFabricResult)) { 
                       $getFabricRows[] = $getFabricRow; 
                     } 
                   
                     for($q=0;$q<count($getFabricRows);$q++) { 
                     
                       $fabricID = $getFabricRows[$q]['id'];
                       $fabricName = $getFabricRows[$q]['name'];
                       $fabricSlug = $getFabricRows[$q]['slug'];
             
                      
                       
                       echo '<input type="checkbox" name="fabric_id[]" value="' . $fabricID . '" id="' . $fabricSlug . '"';

                       // Pre-select existing sizes
                       // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                       // 2. Cycle through the array and check when printing each size from the available size list
                       // 3. If the size ID is in the array, then check the check box 
                        
                        for ($r=0;$r<count($fabric_id_array);++$r) {
                            if ($fabric_id_array[$r] == $fabricID) {
                                echo 'checked ';
                            } else {
                                echo 'djsklj ';
                            } 
                        }
                        
                        echo '>';
                         echo '<label for="' . $fabricSlug . '">';
                     
                       echo $fabricName;
                       
                       echo '</label>';

                    }
                    ?>
                    </fieldset>
      
      
      
      <fieldset>
        <legend>Neckline</legend>
        
       <?php  // Get necklines
    
        $getNecklineQuery = "SELECT * FROM neckline order by name ASC";
                      $getNecklineResult= mysql_query($getNecklineQuery) or die(mysql_error());
                    
                       while ($getNecklineRow = mysql_fetch_assoc($getNecklineResult)) { 
                       $getNecklineRows[] = $getNecklineRow; 
                     } 
                   
                     for($s=0;$s<count($getNecklineRows);$s++) { 
                     
                       $necklineID = $getNecklineRows[$s]['id'];
                       $necklineName = $getNecklineRows[$s]['name'];
                       $necklineSlug = $getNecklineRows[$s]['slug'];
             
                      
                       
                       echo '<input type="checkbox" name="neckline_id[]" value="' . $necklineID . '" id="' . $necklineSlug . '"';

                       // Pre-select existing sizes
                       // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                       // 2. Cycle through the array and check when printing each size from the available size list
                       // 3. If the size ID is in the array, then check the check box 
                        
                        for ($t=0;$t<count($neckline_id_array);++$t) {
                            if ($neckline_id_array[$t] == $necklineID) {
                                echo 'checked ';
                            } else {
                                echo 'djsklj ';
                            } 
                        }
                        
                        echo '>';
                         echo '<label for="' . $necklineSlug . '">';
                     
                       echo $necklineName;
                       
                       echo '</label>';

                    }
                    ?>
        
        
    </fieldset>
      
      
      
             <fieldset>
        <legend>Sleeves</legend>
        
        <?php  // Get sleeves
    
        $getSleeveQuery = "SELECT * FROM sleeve order by name ASC";
                      $getSleeveResult= mysql_query($getSleeveQuery) or die(mysql_error());
                    
                       while ($getSleeveRow = mysql_fetch_assoc($getSleeveResult)) { 
                       $getSleeveRows[] = $getSleeveRow; 
                     } 
                   
                     for($s=0;$s<count($getSleeveRows);$s++) { 
                     
                       $sleeveID = $getSleeveRows[$s]['id'];
                       $sleeveName = $getSleeveRows[$s]['name'];
                       $sleeveSlug = $getSleeveRows[$s]['slug'];
             
                      
                       
                       echo '<input type="checkbox" name="sleeve_id[]" value="' . $sleeveID . '" id="' . $sleeveSlug . '"';

                       // Pre-select existing sizes
                       // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                       // 2. Cycle through the array and check when printing each size from the available size list
                       // 3. If the size ID is in the array, then check the check box 
                        
                        for ($t=0;$t<count($sleeve_id_array);++$t) {
                            if ($sleeve_id_array[$t] == $sleeveID) {
                                echo 'checked ';
                            } else {
                                echo 'djsklj ';
                            } 
                        }
                        
                        echo '>';
                         echo '<label for="' . $sleeveSlug . '">';
                     
                       echo $sleeveName;
                       
                       echo '</label>';

                    }
                    ?>
                    
                    </fieldset>
                    
                    <fieldset>
                    <legend>Styles</legend>
                           <?php  // Get styles
    
        $getStyleQuery = "SELECT * FROM styles order by name ASC";
                      $getStyleResult= mysql_query($getStyleQuery) or die(mysql_error());
                    
                       while ($getStyleRow = mysql_fetch_assoc($getStyleResult)) { 
                       $getStyleRows[] = $getStyleRow; 
                     } 
                   
                     for($s=0;$s<count($getStyleRows);$s++) { 
                     
                       $styleID = $getStyleRows[$s]['id'];
                       $styleName = $getStyleRows[$s]['name'];
                       $styleSlug = $getStyleRows[$s]['slug'];
             
                      
                       
                       echo '<input type="checkbox" name="styles_id[]" value="' . $styleID . '" id="' . $styleSlug . '"';

                       // Pre-select existing sizes
                       // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                       // 2. Cycle through the array and check when printing each size from the available size list
                       // 3. If the size ID is in the array, then check the check box 
                        
                        for ($t=0;$t<count($style_id_array);++$t) {
                            if ($style_id_array[$t] == $styleID) {
                                echo 'checked ';
                            } else {
                                echo 'djsklj ';
                            } 
                        }
                        
                        echo '>';
                         echo '<label for="' . $styleSlug . '">';
                     
                       echo $styleName;
                       
                       echo '</label>';

                    }
                    ?>
                    </fieldset>
                    
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
 

<?php
}
?>
</body>
</html>