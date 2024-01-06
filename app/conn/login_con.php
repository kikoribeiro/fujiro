<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Retrieve user from the database based on username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user['password_hash'])) {
        

        if ($user['admin'] == 1) {
            
            header("Location: admin_dashboard.php");
            exit();
        } else {
            
            header("Location: home.php");
            exit();
        }
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}
?>

