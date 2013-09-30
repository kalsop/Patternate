<?php

    require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output
    include 'includes/get-pattern-collection.inc'; 
    include 'includes/get-pattern-company.inc';
    include 'includes/get-pattern-element-classes.inc';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" media="all" href="css/view.css">
        <title>Patternate</title>
        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/autoSuggestv14/jquery.autoSuggest.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="js/autoSuggestv14/autoSuggest.css" />
        <style type="text/css">

        </style>
        
        
        
        
        
    </head>
    <body>
    
    
        <script type="text/javascript">
		    $(document).ready(function() {
		        
		        $(".hide").click(function() {
                        $(".pattern").hide();
						$(".vogue-patterns").show();
                    });
		        
		        <!-- take the value of the input.as-values and show only that class -->
		        <!--1. input will be in form of value1,value2 -->
		        <!--2. strip following ',' from value and transfrom into array of individual values -->
		        <!--3. show only patterns that have value 1 AND value 2 -->
		        
		        
		        
		        
			    var data = {items: [
<?php
				
// Need to do some work to stop each element being re-queried with the next
//
//     

//TO DO: pattern number
// echo '{element:"pattern_number", value:"' . $patternNumber . '", name: "' . $patternNumber . '"}, ';

     
$filterElements = array('fabric', 'garment_type', 'pattern_for', 'style', 'sleeve', 'neckline', 'pattern_company', 'collection');

for ($f=0;$f<count($filterElements);++$f) {
     mysql_free_result($getFilterElementResult);
    $getFilterElementQuery = "SELECT * FROM $filterElements[$f] order by name ASC";
    $getFilterElementResult= mysql_query($getFilterElementQuery) or die(mysql_error());
      
                     
    while ($getFilterElementRow = mysql_fetch_assoc($getFilterElementResult)) { 
        
        $getFilterElementRows[] = $getFilterElementRow; 
            
	
    } 
                                                         
    for ($e=0;$e<count($getFilterElementRows);++$e) {
         
        $slug = $getFilterElementRows[$e]['slug'];
        $name = $getFilterElementRows[$e]['name'];
        echo '{element:"' . $filterElements[$f] . '", value:"' . $slug . '", name: "' . $name . '"}, ';
       

    }
    
}

?>
    		        
		        ]};
		        $("input[type=text]").autoSuggest(data.items, {selectedItemProp: "name", searchObjProps: "name"});
		        
		        });
		        
		        
		        <!-- On click, hide all patterns except those with the selected class -->
		        
		        
		        
		        
		        
		        
		        </script>
					

        
        <h1>
            <a href="#" class="hide">Patternate</a>
        </h1>
        
        <form>
					<label for="searchTerms">What's your style?</label>
					<input type="text" id="searchTerms" />
					<input type="submit" />
				</form>

        
        
        <?php 

          $query = "SELECT * FROM patterns ORDER BY id ASC";
          $result= mysql_query($query) or die(mysql_error());  

          while ($row = mysql_fetch_assoc($result)) { 
            $rows[] = $row; 
              
           } 

           
        for($i=0;$i<count($rows);$i++) {     
            
            // Establish variables
            $id = $rows[$i]['id'];
            $garment_type_id = $rows[$i]['garment_type_id'];
            $garment_type_id_array = explode( ',', $garment_type_id );
            $style_id = $rows[$i]['style_id'];
            $style_id_array = explode( ',', $style_id );
            $sleeve_id = $rows[$i]['sleeve_id'];
            $sleeve_id_array = explode( ',', $sleeve_id );
            $neckline_id = $rows[$i]['neckline_id'];
            $neckline_id_array = explode( ',', $neckline_id );
            $size_id = $rows[$i]['size_id'];
            $size_id_array = explode( ',', $size_id );
            $fabric_id = $rows[$i]['fabric_id'];
            $fabric_id_array = explode( ',', $fabric_id );
            $pattern_company_id = $rows[$i]['pattern_company_id'];
            $patternCompany = getPatternCompanyNameById($pattern_company_id);
            
            
            $pattern_collection_id = $rows[$i]['pattern_collection_id'];
            if ($pattern_collection_id !== '') {
                $patternCollection = getPatternCollectionNameById($pattern_collection_id);
            }
            
            $patternNumber = $rows[$i]['pattern_number'];
            $patternName = $rows[$i]['pattern_name'];
            $mainImage = $rows[$i]['main_image'];


        ?>
        <div class="pattern <?php 
        
        



$patternElements = array(
    array('neckline', $neckline_id_array),
    array('style', $style_id_array), 
    array('size', $size_id_array),
   array('sleeve', $sleeve_id_array),
   array('garment_type', $garment_type_id_array),
    array('fabric', $fabric_id_array)
      
);
      
//  For every row in the array of elements ($patternElements) ...
    
    for ($e=0;$e<count($patternElements);++$e) {
        getPatternElementClasses($patternElements[$e]) ;                     
      }
      
  echo getPatternCompanySlugById($pattern_company_id);
  echo ' ';
  echo $patternNumber;  
  echo ' ';
echo $patternName;
         // Declare the array containing all the element name and the IDs stored against each element for the pattern
   
   
   
        
        
        ?>">
        
        
        
        
        
        
            <a href="view-single.php?id=<?php echo $id; ?>"><img src="<?php echo $mainImage; ?>" class="envelopeFront" alt=""></a>
            <div class="meta">
                <h2>
                    <!--<form method="post" action="view-single.php"><input type="hidden" id="id" name="id" value="<?php echo $id; ?>"><input type="submit"></form>--><a href="view-single.php?id=<?php echo $id; ?>"><?php 
                            echo $patternCompany . ' ' . $patternNumber;
                            
                            if ($pattern_collection_id !== '') {
                                echo  '<span class="designer">(' . $patternCollection . ')</span> '; 
                                }
                            
                            
                            ?></a> 
                </h2>
                <?php 
                    echo '<span class="garment">';
                    include 'includes/get-garment-type.inc';
                    echo '</span>';
                    ?>
            </div>
        </div><!-- pattern -->
        <?php } ?>
    </body>
</html>
