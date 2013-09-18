<?php

	require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output


?><html>
<head>
<title>Update a Record in MySQL Database</title>
</head>
<body>


                    
<?php 
    






function getElementsCheckSelected($element) {
		
		
	$columnName = $element . '_id';


      $elementExplode = $rows[0][$columnName];
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
                                                           $elementSlug = $getElementcRows[$q]['slug'];
                                                 
                                                          
                                                           
                                                           echo '<input type="checkbox" name="' . $columnName . '[]" value="' . $elementID . '" id="' . $elementSlug . '"';
                                              
                                                           // Pre-select existing sizes
                                                           // 1. Get array of sizes from the selected pattern - ($sizesExplode)
                                                           // 2. Cycle through the array and check when printing each size from the available size list
                                                           // 3. If the size ID is in the array, then check the check box 
                                                            
                                                          
                                                                                  for ($t=0;$t<count($element_id_array);++$t) {
                            if ($element_id_array[$t] == $elementID) {
                                echo 'checked ';
                            } else {
                                echo 'djsklj ';
                            } 
                        }
                                                          
                                                          
                                                          
                                                            
                                                            echo '>';
                                                             echo '<label for="' . $elementSlug . '">';
                                                         
                                                           echo $elementName;
                                                           
                                                           echo '</label>';
                                              
                                                        }   
		
		
		
		
		
	}

$elements = array('fabric', 'garment_type', 'size', 'pattern_for');
for ($e=0;$e<count($elements);++$e) {

   getElementsCheckSelected($elements[$e]) ;                     
}

                    ?>










</body>
</html>