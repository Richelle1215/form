<?php
session_start(); // Mahalagang simulan ang session sa simula

include('db_connection.php'); // Siguraduhing tama ang path sa iyong connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = pg_escape_string($conn_string, $_POST['email']);
    $fullName = pg_escape_string($conn_string, $_POST['fullName']);

    $query = "SELECT * FROM users WHERE email = '$email' AND full_name = '$fullName'";
    $result = pg_query($conn_string, $query);

    if (pg_num_rows($result) > 0) {
        // Matagumpay ang pag-login!

        // Kunin ang impormasyon ng user (maaaring kailangan mo pa ito sa dashboard)
        $user = pg_fetch_assoc($result);

        // Itakda ang mga session variables para maalala na naka-login ang user
        $_SESSION['email'] = $user['email'];
        $_SESSION['full_name'] = $user['full_name']; // Maaari mo ring i-store ang full name o user ID

        // I-redirect ang user sa dashboard.php
        header("Location: dashboard.php");
        exit(); // Mahalagang i-exit ang script pagkatapos mag-redirect
    } else {
        // Hindi nahanap ang user
        echo "No user found with this email and full name!";
        // Maaari mo ring i-redirect pabalik sa login form na may error message
        // header("Location: login.html?error=invalid_credentials");
        // exit();
    }
} else {
    // Kung direktang na-access ang file nang hindi nag-submit ng form
    header("Location: login.html"); // I-redirect sa login form
    exit();
}
?>