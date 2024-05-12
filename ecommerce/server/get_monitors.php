<?php
    include ('connection.php');

    $stmt = $conn->prepare("SELECT * FROM products where product_category='Monitors' limit 4"); 
    $stmt->execute(); 
    $monitors_products = $stmt->get_result(); // this should return an array

?>