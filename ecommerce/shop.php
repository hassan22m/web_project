<?php
include('layouts/header.php');
include ('server/connection.php'); // get the connection 

//use the filter section 
if(isset($_POST['search'])){

  if(isset($_GET['page_no'])&& $_GET['page_no'] !=""){
    $page_no = $_GET['page_no'];
  }
  else{
    // the default page is 1  
    $page_no = 1;
  }
  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products where product_category=? AND product_price<=?");
  $stmt1->bind_param('si',$category,$price);
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  $total_records_per_page = 8;
  $offset = ($page_no-1) * $total_records_per_page ; 
  $previous_page = $page_no-1;
  $next_page = $page_no+1;
  $adjacents = "2";
  $total_no_of_pages = ceil($total_records/$total_records_per_page);

  //get all products
  $stmt2 = $conn->prepare("SELECT * FROM products where product_category=? AND product_price<=? limit $offset,$total_records_per_page");
  $stmt2->bind_param('si',$category,$price);
  $stmt2->execute();
  $products = $stmt2->get_result();

}
else{

    if(isset($_GET['page_no'])&& $_GET['page_no'] !=""){
      $page_no = $_GET['page_no'];
    }
    else{
      // the default page is 1  
      $page_no = 1;
    }
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    $total_records_per_page = 8;
    $offset = ($page_no-1) * $total_records_per_page ; 
    $previous_page = $page_no-1;
    $next_page = $page_no+1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //get all products
    $stmt2 = $conn->prepare("SELECT * FROM products limit $offset,$total_records_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();
  
}


?>
    <div class="container">
     <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12">
          <section id="search" class="my-5 py-5 ms-2">
            <div class="container mt-5 py-5">
              <p>Search products</p>
              <hr style="width:30px;">
            </div>
            <form action="shop.php" method="POST">
              <div class="row mx-auto container">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <p>Category</p>
                  <div class="form-check">
                    <input class="form-check-input" value="Laptops" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=="Laptops"){echo "checked";}?> >
                    <label class="form-check-label" for="flexRadioDefault1">Laptops</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" value="Monitors" type="radio" name="category" id="category_two" <?php if(isset($category) && $category=="Monitors"){echo "checked";}?> >
                    <label class="form-check-label" for="flexRadioDefault2">Monitors</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" value="Mouses" type="radio" name="category" id="category_two" <?php if(isset($category) && $category=="Mouses"){echo "checked";}?> >
                    <label class="form-check-label" for="flexRadioDefault2">Mouses</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" value="Headsets" type="radio" name="category" id="category_two" <?php if(isset($category) && $category=="Headsets"){echo "checked";}?> >
                    <label class="form-check-label" for="flexRadioDefault2">Headsets</label>
                  </div>
                </div>
              </div>

              <div class="row mx-auto container mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <p>Price</p>
                  <input type="range" class="form-range w-100" name="price" value="<?php if(isset($price)){echo $price;}else{echo "200";}?>" min="1" max="3000" id="customRange2">
                  <div class="w-50">
                    <span style="float: left;">1</span>
                    <span style="float: right;">3000</span>
                  </div>
                </div>
              </div>

              <div class="form-group my-3 mx-3">
                <input type="submit" name="search" value="Search" class="btn btn-primary">
              </div>

            </form>
          </section>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12">
            <!--SHOP-->
          <section id="shop" class="my-5 py-5 ">
              <div class="container  mt-5 py-5">
                <h5>Our products</h5>
                <hr>
                <p>Here you can check out our productds</p>
              </div>

              <div class="row mx-auto container">
              <?php while ($row = $products->fetch_assoc()){ ?>
                <div onclick="window.location.href='single_product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12 mb-5 pb-4">
                  <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image'];?>">
                  <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                  </div>
                  <h5 class="p-name"><?php echo $row['product_name'];?></h5>
                  <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
                  <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']?>">Buy Now</a>
                </div>
                <?php }?>


                <nav aria-label="page navigation example" class="mx-auto">
                    <ul class="pagination mt-5 mx-auto">
                        <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
                          <a class="page-link" href="<?php if($page_no<=1){echo '#';}else{echo "?page_no".($page_no-1);}?>">Previous</a>
                        </li>

                        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                        <?php if($page_no>=3){ ?>
                          <li class="page-item"><a class="page-link" href="#">...</a></li>
                          <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no; ?></a></li>
                        <?php } ?>
                        <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';}?>">
                          <a class="page-link" href="<?php if($page_no>=$total_no_of_pages){echo '#';}else{echo "?page_no=".($page_no+1);}?>">Next</a>
                        </li>
                    </ul> 
                </nav>
              </div>
              
          </section>
        </div>
      </div>
   </div>

<?php include('layouts/footer.php');?>



