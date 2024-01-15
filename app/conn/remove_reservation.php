<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_reservation'])) {
    $reservation_id = isset($_POST['reservation_id']) ? $_POST['reservation_id'] : null;
    

    if (is_numeric($reservation_id)) {

        $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = :reservation_id");
        $stmt->bindParam(':reservation_id', $reservation_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /fujiro/fujiro/app/reservations.php");
        exit();
    }

}
