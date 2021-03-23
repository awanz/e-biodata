<?php 

// database
$dbhost = "localhost";
$dbname = "ebiodata";
$dbuser = "root";
$dbpass = "";
$dbcharset = "utf8";

function base_url($page = null){
    $url = "http://localhost/e-biodata/";
    $result = $url . $page;
    return $result;
}