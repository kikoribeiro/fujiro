<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['hotel_id'])) {
    $hotel_id = $_GET['hotel_id'];

    // Delete hotel from the database
    $stmt = $pdo->prepare("DELETE FROM hotels WHERE hotel_id = :hotel_id");
    $stmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
    $stmt->execute();


    header("Location: /fujiro/fujiro/app/adminhome.php");
    exit();
}
