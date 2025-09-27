<?php
session_start();
session_unset();    // Clear lahat ng session variables
session_destroy();  // End session
header('Location: login.html'); // Balik sa login page
exit();
?>
