<?php
    function getPatternCollectionNameById($pattern_collection_id) {
        $patternCollectionQuery = "SELECT * from collection WHERE id = $pattern_collection_id";
        $patternCollectionData = mysql_query($patternCollectionQuery) or die(mysql_error());
        $patternCollectionArray = mysql_fetch_array( $patternCollectionData);
        return $patternCollectionArray['name'];
    }
    

?>