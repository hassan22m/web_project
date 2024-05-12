<?php include('layouts/header.php'); ?>
    <!-- home -->
    <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span>  This Season</h1>
            <p>Eshop offers the best products for the most affordable prices</p>
            <button>Shop Now</button>
        </div>
    </section>

    <!-- brands -->
    <section id="brand" class="container">
      <div class="row">
        <img class="img-fluid col-lg-2 col-md-4 col-sm-6" src="./assets/images/brand2.png"/>
        <img class="img-fluid col-lg-2 col-md-4 col-sm-6" src="./assets/images/brand3.png"/>
        <img class="img-fluid col-lg-2 col-md-4 col-sm-6" src="./assets/images/brand1.png"/>
        <img class="img-fluid col-lg-2 col-md-4 col-sm-6" src="./assets/images/brand5.png"/>   
        <img class="img-fluid col-lg-2 col-md-4 col-sm-6" src="./assets/images/brand6.png"/>    
        <img class="img-fluid col-lg-2 col-md-4 col-sm-6" src="./assets/images/brand4.png"/>     
      </div>
    </section>


    <!--New-->
    <section id="new" class="w-100">
      <div class="row p-0 m-0">
        <!--one-->
        <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
          <img class="img-fluid" src="assets/images/gp65_1.png">
          <div class="details">
            <h2>Extereamly Awesome Laptops</h2>
            
          </div>
        </div>
        <!--tow-->
        <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
          <img class="img-fluid" src="assets/images/headset4.png">
          <div class="details">
            <h2>Extereamly Awesome Headesets</h2>
            
          </div>
        </div>
        
        <!--three-->
        <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
          <img class="img-fluid" src="assets/images/g241_1.png">
          <div class="details">
            <h2>Extereamly Awesome Monitors</h2>
          
          </div>
        </div>
        <!--four-->
        <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
          <img class="img-fluid" src="assets/images/pro-x-superlight-black-gallery-1.png">
          <div class="details">
            <h2>Extereamly Awesome Mouses</h2>
            
          </div>
        </div>
      </div>
    </section>

    <!--Featured-->
    <section id="featured" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Laptops</h3>
        <hr class="mx-auto">
        <p>Here you can check out our featured laptops</p>
      </div>
      <div class="row mx-auto container-fluid">
        <?php include('server/get_featured_products.php'); ?>
        <?php while($row = $featured_products->fetch_assoc()){ ?>
      
        <div  class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image'];?>">
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name'];?></h5> 
          <h4 class="p-price">$ <?php echo $row['product_price'];?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
        </div>

        <?php } ?>
      </div>
    
      
      
    </section>
    <!--banner-->
    <section id="banner" class="my-5 py-5">
      <div class="container">
        <h4>MID SEASON'S SALE</h4>
        <h1>New Laptops </h1>
        <button class="text-uppercase">shop now</button>
      </div>
    </section>

    <!--Monitors-->
    <section id="featured" class="my-5 ">
      <div class="container text-center mt-5 py-5">
        <h3>Monitors</h3>
        <hr class="mx-auto">
        <p>Here you can check out our amazing monitors</p>
      </div>
      <div class="row mx-auto container-fluid">
          <?php include('server/get_monitors.php');?>
          <?php while($row = $monitors_products->fetch_assoc()){?>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image']?>">
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']?></h5>
          <h4 class="p-price">$ <?php echo $row['product_price']?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
        </div>
        <?php } ?>
      </div>
      
      
      
    </section>

    <!--mouses-->
    <section id="featured" class="my-5 ">
      <div class="container text-center mt-5 py-5">
        <h3>Mouses</h3>
        <hr class="mx-auto">
        <p>Here you can check out our amazing mouses</p>
      </div>
      <div class="row mx-auto container-fluid">
          <?php include('server/get_mouses.php');?>
          <?php while($row = $mouses_products->fetch_assoc()){?>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image']?>">
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']?></h5>
          <h4 class="p-price">$<?php echo $row['product_price']?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
        </div>

        <?php } ?>
      </div>
    </section>

    <!--headsets-->
    <section id="featured" class="my-5 ">
      <div class="container text-center mt-5 py-5">
        <h3>Headsets</h3>
        <hr class="mx-auto">
        <p>Here you can check out our amazing headsets</p>
      </div>
      <div class="row mx-auto container-fluid">
          <?php include('server/get_headsets.php');?>
          <?php while($row = $headsets_products->fetch_assoc()){?>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image']?>">
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']?></h5>
          <h4 class="p-price">$<?php echo $row['product_price']?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
        </div>
        <?php } ?>
      </div>
    </section>

<?php include('layouts/footer.php'); ?>


