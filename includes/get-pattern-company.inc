<?php
    function getPatternCompanyNameById($pattern_company_id) {
        $patternCompanyQuery = "SELECT * from pattern_company WHERE id = $pattern_company_id";
        $patternCompanyData = mysql_query($patternCompanyQuery) or die(mysql_error());
        $patternCompanyArray = mysql_fetch_array( $patternCompanyData);
        return $patternCompanyArray['name'];
    }
    

?>
