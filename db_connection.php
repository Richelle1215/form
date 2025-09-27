<?php
// db_connection.php

$conn_string= pg_connect("host=localhost port=5432 dbname=Registration user=postgres password=MENDEZ");



if (!$conn_string) {
    die("Connection failed: " . pg_last_error());
}
?>