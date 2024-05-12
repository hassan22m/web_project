<?php 
session_start();
include('connection.php');

//check if the user is logged in to make order 
if(!isset($_SESSION['logged_in'])){
    header("location: ../checkout.php?message=please login/register to place an oreder");
    exit; 
}

if(isset($_POST['Place_order'])){

    //get user info & store in db
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid" ; // order placed but not paied
    $user_id = $_SESSION['user_id'] ; // the user id when login 
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders(order_cost,order_status,user_id,user_phone,
    user_city,user_address,order_date)
    VALUES (?,?,?,?,?,?,?);");
    // i integer s string
    $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,
    $phone,$city,$address,$order_date);
    
    if(!$stmt->execute()){
        header("location:index.php");
        exit;
    }
    //bring the stored order_id from the db
    $order_id = $stmt->insert_id;  
    echo $order_id; 

    //get products from cart (session)
    //issue new order store order info in db (orders table)
    //store each single item in order_items db

    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key] ; //reutrn products array
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_price = $product['product_price'];
        $product_image = $product['product_image'];
        $product_quantity = $product['product_quantity'];

        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,
        product_name,product_image,product_price,product_quantity,user_id,order_date) 
        VALUES (?,?,?,?,?,?,?,?);");

        $stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,
        $product_image,$product_price,$product_quantity,$user_id,$order_date);

        $stmt1->execute();

    }
    
    //remove everything from cart --> until payment done
    unset($_SESSION['cart']);
    unset($_SESSION['quantity']);
    //the basket code need to be updated also 

    //inform the user whther everything is ok or not
    //payment page 
    header('location: ../payment.php?order_status="Order placed successfully"'); 
}



?>


