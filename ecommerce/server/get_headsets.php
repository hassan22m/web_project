<?php
    include ('connection.php');

    $stmt = $conn->prepare("SELECT * FROM products where product_category='Headsets' limit 4"); 
    $stmt->execute(); 
    $headsets_products = $stmt->get_result(); // this should return an array

?>