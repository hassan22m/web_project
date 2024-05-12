<?php
    include ('connection.php'); // get the connection 

    $stmt = $conn->prepare("SELECT * FROM products limit 4"); //prepared statment of the query
    $stmt->execute(); //execute the statment 
    $featured_products = $stmt->get_result();
    //this code will reterun an array from products table 
?>
