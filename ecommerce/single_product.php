<?php
  include('layouts/header.php');  
  include ('server/connection.php');
  if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products where product_id = ? "); 
    $stmt->bind_param("i",$product_id);
    $stmt->execute(); 
    $product = $stmt->get_result(); // this should return an array 
  }else{
    header('location:index.php');
  }
?>

    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">
          <?php while($row = $product->fetch_assoc()){ ?>

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img id="mainImg" class="img-fluid w-100 pb-1" src="assets/images/<?php echo $row['product_image']; ?>">
                <div class="small-img-group">
                  <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                  </div>
                  <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image2']; ?>" width="100%" class="small-img">
                  </div>
                  <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image3']; ?>" width="100%" class="small-img">
                  </div>
                  <div class="small-img-col">
                    <img src="assets/images/<?php echo $row['product_image4'] ;?>" width="100%" class="small-img">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12">
                <h6><?php echo $row['product_category']; ?></h6>
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h3><?php echo $row['product_price']; ?> $</h3>
                <form method = "POST" action="cart.php" >
                  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                  <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                  <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                  <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                  <input type="number" name="product_quantity" value="1"/>
                  <button class="buy-btn " name="add_to_cart" type="submit">Add To Cart</button>
                </form>
                  <h4 class="mt-5 mb-5">Product details</h4>
                  <span><?php echo $row['product_description'] ;?></span>
              </div>
            <?php } ?>
        </div>
    </section>

    <!--related products-->
    <section id="related-products" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Related products</h3>
        <hr class="mx-auto">
      </div>
      <div class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/1.jpg">
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name">Msi Laptops</h5>
          <h4 class="p-price">$1240</h4>
          <button class="buy-btn">Buy Now</button>
        </div>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/2.jpg">
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name">ٌRazer Laptops</h5>
          <h4 class="p-price">$1450</h4>
          <button class="buy-btn">Buy Now</button>
        </div>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/3.jpg">
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name">ROG Laptops</h5>
          <h4 class="p-price">$1320</h4>
          <button class="buy-btn">Buy Now</button>
        </div>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/4.jpg">
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name">Predator Laptops</h5>
          <h4 class="p-price">$1570</h4>
          <button class="buy-btn">Buy Now</button>
        </div>
      </div>
      
      
      
    </section>

    

    
    <script>
      var mainImg = document.getElementById("mainImg");
      var smallImg = document.getElementsByClassName("small-img");

      for(let i=0;i<4;i++){
          smallImg[i].onclick = function(){
          mainImg.src = smallImg[i].src; 
        }
      }
    </script>
<?php include('layouts/footer.php');?>