<?php
include('db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = pg_escape_string($conn_string, $_POST["fullName"]);
    $mobileNumber = pg_escape_string($conn_string, $_POST["mobileNumber"]);
    $email = pg_escape_string($conn_string, $_POST["email"]);
    $query = "INSERT INTO users (full_name, mobile_number,email) 
        VALUES ('$fullName', '$mobileNumber', '$email');";
    $result = pg_query($conn_string, $query);

        if ($result) {
         echo "Registration successful!";
     } else {
        echo "Error: " . pg_last_error($conn_string);
     }
}
?>