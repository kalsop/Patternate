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
      <!--  <script src="js/autoSuggestv14/jquery.autoSuggest-original.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="js/autoSuggestv14/autoSuggest.css" /> -->
        <style type="text/css">

        </style>
        
        
        
        
        
    </head>
    <body>
    
    
        <script type="text/javascript">
		    $(document).ready(function() {
		        
function filterPatterns(e) {
    if(e) {
        e.preventDefault();
    }
    
  var keys = $('.as-values').val().split(',');
  var patterns = $('.pattern');
  for (var i=0; i<patterns.length; i++) {
    var show = true;
    for (var j=0; j<keys.length; j++) {
        if(keys[j] && keys[j].length) {
            if (!$(patterns[i]).hasClass(keys[j])) {
             show = false;
          }
        }       
    }
    $(patterns[i]).toggle(show);
  }
}
  
    $('.as-values').on('change',filterPatterns);
		        
	$('input[type=submit]').click(filterPatterns);	        
		        
		        
		        
		        
		        
			    var data = {items: [
<?php


     
$filterElements = array('pattern_company', 'collection');


for ($f=0;$f<count($filterElements);++$f) {
    $getFilterElementQuery = "SELECT * FROM $filterElements[$f] order by id ASC";
    $getFilterElementResult= mysql_query($getFilterElementQuery) or die(mysql_error());
   
                     
    while ($getFilterElementRow = mysql_fetch_assoc($getFilterElementResult)) {         
        $getFilterElementRows[] = $getFilterElementRow; 
} 
                                                        
    for ($e=0;$e<count($getFilterElementRows);++$e) {
         
        $slug = $getFilterElementRows[$e]['slug'];
        $name = $getFilterElementRows[$e]['name'];
        echo '{element:"' . $filterElements[$f] . '", value:"' . $slug . '", name: "' . $name . '"}, ';


    }
    unset($getFilterElementRows);
    $getFilterElementRows = array();
}

?>
    		        
		        ]};
		        $("input[type=text]").autoSuggest(data.items, {selectedItemProp: "name", searchObjProps: "name"});

 
		        });
	        
		        
		        </script>
				

        
        <h1>
            <a href="#" class="hide">Patternate</a>
        </h1>
        
        <form>
					<label for="searchTerms">What's your style?</label>
					<input type="text" id="searchTerms" />
					<input type="submit"  />
				</form>

        
        
        <?php 

          $query = "SELECT * FROM patterns ORDER BY id ASC LIMIT 30";
          $result= mysql_query($query) or die(mysql_error());  

          while ($row = mysql_fetch_assoc($result)) { 
            $rows[] = $row; 
              
           } 

           
        for($i=0;$i<count($rows);$i++) {     
            
            // Establish variables
            $id = $rows[$i]['id'];
            //$garment_type_id = $rows[$i]['garment_type_id'];
            //$garment_type_id_array = explode( ',', $garment_type_id );
            $pattern_company_id = $rows[$i]['pattern_company_id'];
            $patternCompany = getPatternCompanyNameById($pattern_company_id);
            
            
            $pattern_collection_id = $rows[$i]['pattern_collection_id'];
            if ($pattern_collection_id !== '') {
                $patternCollection = getPatternCollectionNameById($pattern_collection_id);
            }
            
            $patternNumber = $rows[$i]['pattern_number'];
            $mainImage = $rows[$i]['main_image'];
            $lineDrawing = $rows[$i]['line_drawing'];


        ?>
        <div class="pattern <?php 
        
        




      
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
                
            </div>
        </div><!-- pattern -->
        <?php } ?>
    </body>
</html>
