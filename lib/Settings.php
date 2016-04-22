<?php

define('IS_CACHE_ENABLED', true);

$hostname = "localhost";
$user = "root";
$password = "girnar";
$database = "test";
$con = mysql_connect($hostname, $user, $password);
if (!$con) {
    die("Opps some thing went wrong");
} else {
    mysql_select_db($database, $con);
}

/*
 * get results from query 
 */
function getResult($query) {
    $query = mysql_query($query);
    $new_array = '';
    while ( $row = mysql_fetch_assoc($query) ) {
        $new_array[] = $row;
    }
    return $new_array;
}


?>