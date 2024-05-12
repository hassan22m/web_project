<?php include('header.php');?>
<?php
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $stmt = $conn->prepare("SELECT * FROM products where product_id=?");
        $stmt->bind_param('i',$product_id);
        $stmt->execute();
        $products = $stmt->get_result(); 
    }else if(isset($_POST['edit_btn'])){

        $product_id = $_POST['product_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $color = $_POST['color'];
        $special_offer = $_POST['special_offer'];


        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?,product_price=?
        ,product_special_offer=?,product_color=?,product_category=? WHERE product_id=?");
        $stmt->bind_param('ssssssi',$title,$description,$price,$special_offer,$color,$category,$product_id);
        if($stmt->execute()){
            header("location: products.php?edit_success_message=Product has been updated successfully");
        }else{
            header("location: products.php?edit_failure_message=Error occured, try again");
        }
        
    }
    else{
        header('location:products.php');
        exit;
    }
 
?>


    <div class="container-fluid">
      <div class="row">
        
      <?php include('sidemenu.php');?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
          >
            <h1 class="h2">Dashboard</h1>
            
          </div>
          <!-- Your Dashboard content here -->
          <div>
            <h2>Edit Product</h2>
            <form id="edit-form" method="POST" action="edit_products.php" >
                <p style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];}?></p>
                <div class="form-group mt-2">
                <?php foreach($products as $product){ ?>

                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>">
                    <label for="edit-title">Title</label>
                    <input type="text" class="form-control" id="edit-title" value="<?php echo $product['product_name']; ?>" name="title" placeholder="Title" required>
                </div>
                <div class="form-group mt-2">
                    <label for="edit-description">Description</label>
                    <input type="text" class="form-control" id="edit-description" value="<?php  echo $product['product_description']; ?>" name="description" placeholder="Description" required>
                </div>
                <div class="form-group mt-2">
                    <label for="edit-price">Price</label>
                    <input type="text" class="form-control" id="edit-price" value="<?php echo $product['product_price']; ?>" name="price" placeholder="Price" required>
                </div>
                <div class="form-group mt-2">
                    <label for="edit-category">Category</label>
                    <select class="form-control" id="edit-category"  name="category" required>
                        <option value="" disabled>Select Category</option>
                        <option value="Laptops" selected>Laptops</option>
                        <option value="Monitors">Monitors</option>
                        <option value="Headsets">Headsets</option>
                        <option value="Mouses">Mouses</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="edit-color">Color</label>
                    <input type="text" class="form-control" id="edit-color" value="<?php echo $product['product_color']; ?>" name="color" placeholder="Color" required>
                </div>
                <div class="form-group mt-2">
                    <label for="edit-special-offer">Special Offer</label>
                    <input type="text" class="form-control" id="edit-special-offer" value="<?php echo $product['product_special_offer']; ?>" name="special_offer" placeholder="Sale %" required>
                </div>
                <div class="form-group mt-3 "> <!-- Added mt-3 for top margin -->
                    <input type="submit" class="btn btn-primary" style="width:100px;" id="edit-btn" name="edit_btn" value="Edit">
                </div>

                <?php } ?>
            </form>


          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
