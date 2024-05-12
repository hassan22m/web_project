<?php
include('layouts/header.php');

if (isset($_POST['add_to_cart'])){

    if(isset($_SESSION['cart'])){
      // if user has somthing in the cart
      //this will return the product ids in the cart.
      //check if the product has already been added or not
      if(! in_array($_POST['product_id'],array_column($_SESSION['cart'],"product_id"))){
              //if not then add it. 
              $product_id = $_POST['product_id'];
              $product_name = $_POST['product_name'];
              $product_price = $_POST['product_price'];
              $product_image = $_POST['product_image'];
              $product_quantity = $_POST['product_quantity'];

              $product_array = array(
                                'product_id' => $product_id,
                                'product_name' => $product_name,
                                'product_price' => $product_price,
                                'product_image' => $product_image,
                                'product_quantity' => $product_quantity
              );
              //creating session that will store array that has product array which store
              //product information 
              $_SESSION['cart'][$product_id] = $product_array ; 
    }
      else{
      echo '<script>alert("Product is already in the cart")</script>';
      //echo '<script>window.location="index.php"</script>';
      }
    }
    else{
      //first product 
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      $product_array = array(
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_price' => $product_price,
                        'product_image' => $product_image,
                        'product_quantity' => $product_quantity
      );
      //creating session that will store array that has product array which store
      //product information 
      $_SESSION['cart'][$product_id] = $product_array ; 
    }
    // calculate the total when product is added to the cart 
    CalculateTotalCart();
  }
// remove product from the cart 
elseif(isset($_POST['remove_product'])){
  //var_dump($_SESSION['cart']); i have faced problem here 
  //i have used theis to debug the problem  
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  CalculateTotalCart();
}
elseif(isset($_POST['edit_quantity'])){
  // edit the quantity 
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];
  // get the product array from the session 
  $product_array = $_SESSION['cart'][$product_id]; 
  //update
  $product_array['product_quantity'] = $product_quantity;
  // send array again to the session
  $_SESSION['cart'][$product_id] = $product_array ; 

  CalculateTotalCart();
}
else
{
  //take the user to the home page 
  //header('location:index.php');
  //or do nothing 
}

function CalculateTotalCart(){

  $total = 0 ;
  $total_quantity = 0 ;
  foreach($_SESSION['cart'] as $key => $value){
    $product = $_SESSION['cart'][$key];
    $price = $product['product_price'];
    $quantity = $product['product_quantity'];
    $total = $total + ($price * $quantity) ; 
    //for the cart 
    $total_quantity = $total_quantity + $quantity; 
  }
  // store the total in session 
  $_SESSION['total'] = $total ; 
  $_SESSION['quantity'] = $total_quantity; 
} 

  

?>



      <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Proudct</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php if(isset($_SESSION['cart'])){ ?>
            <?php foreach($_SESSION['cart'] as $key => $value): ?>
            <tr>
              <td>
                  <div class="product-info">
                      <img src="assets/images/<?php echo $value['product_image']; ?>">
                      <div>
                          <p><?php echo $value['product_name']; ?></p>
                          <small><span>$</span><?php echo $value['product_price'] ;?></small>
                          <br>
                          <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>" />
                            <input type="submit" name="remove_product" class="remove-btn" value="Remove"/>
                          </form>
                      </div>
                  </div>
              </td>
              <td>
                  <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ;?>">
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>"/>
                    <input type="submit" name="edit_quantity" class="edit-btn" value="Edit"/>
                  </form>
                 
              </td>
              <td>
                    <span>$</span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
              </td>
          </tr>
          
          <?php endforeach; ?>

          <?php } ?>

        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <?php if(isset($_SESSION['cart'])){ ?>
                    <td>$ <?php echo $_SESSION['total']; ?></td>
                    <?php } ?>
                </tr>
            </table>
        </div>

        <div class="checkout-container"> 
          <form method = "POST" action="checkout.php">
            <input type="submit" class="btn checkout-btn" name="checkout" value="Checkout">
          </form>
        </div>

      </section>

<?php include('layouts/footer.php');?>