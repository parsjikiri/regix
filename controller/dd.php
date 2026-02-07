<?php
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    die();
    echo "</pre>";
}

//to use function dd
//first include this file include --
//<?php include '../controller/dd.php'; 
//<?php dd($_SERVER);

$current_page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
