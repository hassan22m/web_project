<?php include('header.php');?>
<?php
  if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
    exit;
  }
?>

<?php 
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

    $total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page ; 
    $previous_page = $page_no-1;
    $next_page = $page_no+1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //get all orders
    $stmt2 = $conn->prepare("SELECT * FROM products limit $offset,$total_records_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();

?>

    <div class="container-fluid">
      <div class="row">
        
      <?php include('sidemenu.php');?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
          >
            <h1 class="h2">Dashboard</h1>
            
          </div class="mx-auto container">
          <h2>Create Product</h2>
            <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php" >
                    <p style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];}?></p>

                    <div class="form-group mt-2">
                        <label >Title</label>
                        <input type="text" class="form-control" id="product_name"  name="product_name" placeholder="Title" required>
                    </div>

                    <div class="form-group mt-2">
                        <label >Description</label>
                        <input type="text" class="form-control" id="product_description"  name="description" placeholder="Description" required>
                    </div>

                    <div class="form-group mt-2">
                        <label>Price</label>
                        <input type="text" class="form-control" id="product_price"  name="price" placeholder="Price" required>
                    </div>
                    
                    <div class="form-group mt-2">
                        <label >Special Offer</label>
                        <input type="number" class="form-control" id="product_offer"  name="special_offer" placeholder="Sale %" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="create-category">Category</label>
                        <select class="form-control" id="create-category"  name="category" required>
                            <option value="" disabled>Select Category</option>
                            <option value="Laptops" selected>Laptops</option>
                            <option value="Monitors">Monitors</option>
                            <option value="Headsets">Headsets</option>
                            <option value="Mouses">Mouses</option>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label >Color</label>
                        <input type="text" class="form-control" id="product_color"  name="color" placeholder="Color" required>
                    </div>

                    <div class="form-group mt-2">
                        <label >Image 1</label>
                        <input type="file" class="form-control" id="product_image1"  name="image1" placeholder="image 1" required>
                    </div>
                    <div class="form-group mt-2">
                        <label >Image 2</label>
                        <input type="file" class="form-control" id="product_image1"  name="image2" placeholder="image 2" required>
                    </div>
                    <div class="form-group mt-2">
                        <label >Image 3</label>
                        <input type="file" class="form-control" id="product_image1"  name="image3" placeholder="image 3" required>
                    </div>
                    <div class="form-group mt-2">
                        <label >Image 4</label>
                        <input type="file" class="form-control" id="product_image1"  name="image4" placeholder="image 4" required>
                    </div>


                    <div class="form-group mt-3 "> 
                        <input type="submit" class="btn btn-primary" style="width:100px;" id="create-btn" name="create_product" value="Create">
                    </div> 
                </form>
          <div>

            
            
          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
