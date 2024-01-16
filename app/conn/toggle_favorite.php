<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['hotel_id'])) {
    $hotel_id = $_GET['hotel_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($user_id) {
        // Toggle is_favorite column in hotels table
        $stmt = $pdo->prepare("UPDATE hotels SET is_favorite = NOT is_favorite WHERE hotel_id = :hotel_id");
        $stmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

// Redirect back to the previous page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();