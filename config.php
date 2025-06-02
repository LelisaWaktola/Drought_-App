<?php
$host = 'localhost';
$dbname = 'drought_db';
$username = 'root';
$password = '';

// Create connection
$db = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
