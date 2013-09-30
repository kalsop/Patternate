<?php
    function getPatternNameById($pattern_company_id) {
        $patternCompanyQuery = "SELECT * from pattern_company WHERE id = $pattern_company_id";
        $patternCompanyData = mysql_query($patternCompanyQuery) or die(mysql_error());
        $patternCompanyArray = mysql_fetch_array( $patternCompanyData);
        return $patternCompanyArray['name'];
    }
    
        function getPatternCompanySlugById($pattern_company_id) {
        $patternCompanyQuery = "SELECT * from pattern_company WHERE id = $pattern_company_id";
        $patternCompanyData = mysql_query($patternCompanyQuery) or die(mysql_error());
        $patternCompanyArray = mysql_fetch_array( $patternCompanyData);
        return $patternCompanyArray['slug'];
    }

?>