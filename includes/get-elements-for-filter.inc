 <?php
 function getElementsForFilter($facetInfo,$patternRow) {
		$element = $facetInfo[0];
		$friendlyName = $facetInfo[1];
	
	  $columnName = $element . '_id';

    $elementExplode = $patternRow[$columnName];
    $element_id_array = explode( ',', $elementExplode );
      
      
      
      // Get element
    
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
                                                            
                                                          
                                                                               
                                                          
                                                          
                                                            
                                                            echo '>';
                                                             echo '<label for="' . $elementSlug . '">';
                                                         
                                                           echo $elementName;
                                                           
                                                           echo '</label>';
                                                           
                                              
                                                        }   
		
	
		
		
		
		
	}
	?>