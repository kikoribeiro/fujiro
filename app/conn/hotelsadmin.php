<?php
require 'config.php';

function showHotelsAdmin() {

    global $pdo; 

    try {

        $stmt = $pdo->query("SELECT * FROM hotels");
        $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
    if ($hotels) {
        echo '<div id="hotelContainer" class="container mt-5">';
            foreach ($hotels as $hotel) {
                echo '<div class="card mb-4 hotel-card">';
                echo '<div class="row g-0">';
        
                echo '<div class="col-md-4">';
                echo '<img src="/fujiro/fujiro/assets/pexels-pixabay-258154.jpg" alt="' . $hotel['name'] . '" class="img-fluid rounded-start">';
                echo '</div>';
                
                echo '<div class="col-md-8">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title">' . $hotel['destination'] . '</h4>';
                echo '<h5 class="card-title">' . $hotel['name'] . '</h5>';
                echo '<p class="card-text">Address: ' . $hotel['address'] . '</p>';
                echo '<p class="card-text">City: ' . $hotel['city'] . '</p>';
                echo '<p class="card-text">Price: ' . $hotel['price'] . '€ / per night</p>';
                echo '<p class="card-text">Rating: ';
                for ($i = 1; $i <= $hotel['evaluation']; $i++) {
                    echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                }
                echo '</p>';
                echo '<a href="/fujiro/fujiro/app/admin_edit_hotel.php?hotel_id=' . $hotel['hotel_id'] . '" class="btn btn-warning">EDIT</a>';
                echo '<a href="/fujiro/fujiro/app/conn/admin_delete_hotel.php?hotel_id=' . $hotel['hotel_id'] . '" class="btn btn-danger">DELETE</a>';
                echo '</div>';
                echo '</div>';
                
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
                else {
                            echo '<p>No hotels found.</p>';
                        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
