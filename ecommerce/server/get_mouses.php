<?php
    include ('connection.php');

    $stmt = $conn->prepare("SELECT * FROM products where product_category='Mouses' limit 4"); 
    $stmt->execute(); 
    $mouses_products = $stmt->get_result(); // this should return an array

?>