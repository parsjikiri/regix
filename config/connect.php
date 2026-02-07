<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'regix_db';


$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connect failed: " . $conn->connect_error);
}
