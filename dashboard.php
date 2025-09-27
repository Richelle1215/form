<?php
session_start();
include 'db_connection.php'; // Connection file mo

// Check kung naka-login
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit();
}

// Kunin ang info ng user
$email = $_SESSION['email'];
$query = "SELECT full_name, mobile_number, email, date_registered FROM users WHERE email = '$email'";
$result = pg_query($conn_string, $query);

if ($result && pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <style>
        /* Styles mo dito (kagaya nung sa binigay mo) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #0b0c2a;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            overflow: hidden;
            position: relative;
        }

        /* Circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, #7f5af0aa, transparent 70%);
            z-index: 0;
            filter: blur(60px);
        }

        .circle1 {
            width: 250px;
            height: 250px;
            top: -80px;
            left: -80px;
        }

        .circle2 {
            width: 300px;
            height: 300px;
            bottom: -100px;
            right: -100px;
        }

        .circle3 {
            width: 200px;
            height: 200px;
            bottom: 100px;
            left: -50px;
            background: radial-gradient(circle, #5f39f0aa, transparent 70%);
        }

        .circle4 {
            width: 150px;
            height: 150px;
            top: 50px;
            right: 50px;
            background: radial-gradient(circle, #5f39f0aa, transparent 70%);
        }

        /* Container */
        .container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 50px 35px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 1200px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
            text-align: center;
        }

        h2 {
            margin-bottom: 30px;
            font-size: 2.2em;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        th {
            font-weight: bold;
            color: #ccc;
        }

        .logout-link {
            display: inline-block;
            margin-top: 15px;
            color: #7f5af0;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-link:hover {
            text-decoration: underline;
            color: #5f39f0;
        }
    </style>
    
</head>

<body>

    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="circle circle3"></div>
    <div class="circle circle4"></div>

    <div class="container">
        <h2>Welcome,
            <?php echo $user['full_name']; ?>!
        </h2>

        <table>
            <tr>
                <th>Full Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Date Registered</th>
            </tr>
            <tr>
                <td>
                    <?php echo $user['full_name']; ?>
                </td>
                <td>
                    <?php echo $user['mobile_number']; ?>
                </td>
                <td>
                    <?php echo $user['email']; ?>
                </td>
                <td>
                    <?php echo $user['date_registered']; ?>
                </td>
            </tr>
        </table>

        <a href="logout.php" class="logout-link">Logout</a>
        
    </div>

</body>

</html>
