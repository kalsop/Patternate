<?php

    require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output
    include 'includes/get-pattern-collection.inc'; 
    include 'includes/get-pattern-company.inc';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
        <title>Patternate</title>
    </head>
    <body>
        <h1>
            Patternate
        </h1><?php 

          $query = "SELECT * FROM patterns ORDER BY id ASC";
          $result= mysql_query($query) or die(mysql_error());  

          while ($row = mysql_fetch_assoc($result)) { 
            $rows[] = $row; 
              
           } 

           
        for($i=0;$i<count($rows);$i++) {     
            
            // Establish variables
            $id = $rows[$i]['id'];
            $garment_type_id = $rows[$i]['garment_type_id'];
            $pattern_company_id = $rows[$i]['pattern_company_id'];
            $patternCompany = getPatternCompanyNameById($pattern_company_id);
            
            $pattern_collection_id = $rows[$i]['pattern_collection_id'];
            if ($pattern_collection_id !== '') {
                $patternCollection = getPatternCollectionNameById($pattern_collection_id);
            }
            
            $patternNumber = $rows[$i]['pattern_number'];
            $mainImage = $rows[$i]['main_image'];


        ?>
        <div class="pattern">
            <a href="#"><img src="%3C?php%20echo%20$mainImage%20?%3E" class="envelopeFront" alt=""></a>
            <div class="meta cf">
                <ul class="options">
                    <li>
                        <a href="">Pin it</a>
                    </li>
                    <li>
                        <a href="">Buy</a>
                    </li>
                </ul>
                <h2>
                    <a href=""><?php 
                        echo $patternCompany . ' ' . $patternNumber;
                        
                        if ($pattern_collection_id !== '') {
                            echo  '<span class="designer">(' . $patternCollection . ')</span> '; 
                            }
                        
                        
                        ?></a> <?php 
                        echo '<span class="garment">';
                        
                        include 'includes/get-garment-type.inc';
                        echo '</span>';
                        ?>
                </h2>
            </div>
        </div><!-- pattern -->
        <?php } ?>
    </body>
</html>
