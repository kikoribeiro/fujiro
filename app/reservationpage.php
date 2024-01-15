<?php
require 'conn/config.php';
require 'conn/require_login.php';


if (isset($_GET['hotel_id'])) {
    $_SESSION['hotel_id'] = $_GET['hotel_id'];
} else {
    header("Location: home.php");
    exit();
}

$hotel_id = isset($_GET['hotel_id']) ? $_GET['hotel_id'] : null;

if (!is_numeric($hotel_id)) {
    header("Location: hotels_page.php"); 
    exit();
}


$_SESSION['check_in'] = '2024-01-15'; 
$_SESSION['check_out'] = '2024-01-20';

$stmt = $pdo->prepare("SELECT name FROM hotels WHERE hotel_id = :hotel_id");
$stmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $hotel_name = $result['name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="http://example.com/favicon.png">
    <title>FUJIRO</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap');
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #353935;
            margin: 0;
        }
        h1,h2 {
            color: #435585;
            margin-bottom: 20px;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #363062;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #1c1744;
        }
     </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="fujiro">Fu<span style="color: #0056b3;">jiro</span></h1>
        <h2><?php echo htmlspecialchars($hotel_name); ?></h2>
        <form action="conn/reservation.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" readonly>

            <label for="check_in">Check-in:</label>
            <input type="date" id="check_in" name="check_in" required>

            <label for="check_out">Check-out:</label>
            <input type="date" id="check_out" name="check_out" required>

            <button type="submit" class="">Confirm Reservation</button>
        </form>
        <p style="text-align: center; margin-top: 20px;">
        <i class="bi bi-arrow-left"><a href="javascript:history.back()" style="text-decoration: none;">Go Back</a></i>
        </p>
    </div>
</body>

</html>
