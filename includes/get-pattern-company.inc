<?php

        $patternCompanyQuery = "SELECT * from pattern_company WHERE id = $pattern_company_id";
        $patternCompanyData= mysql_query($patternCompanyQuery) or die(mysql_error());
 
        while($row = mysql_fetch_array( $patternCompanyData)) {
          $patternCompany = $row['name'];
          echo $patternCompany;
      
        }



?>