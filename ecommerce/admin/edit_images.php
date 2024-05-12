<?php include('header.php');?>
<?php
  if(isset($_GET['product_id'])){
    
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];

  }else{
    header('location:products.php');
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
            
          </div class="mx-auto container">
          <h2>Update Product images</h2>
            <form id="create-form" enctype="multipart/form-data" method="POST" action="update_images.php" >
                    <p style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];}?></p>

                    <input type="hidden"  name="product_id" value="<?php echo $product_id;?>">
                    <input type="hidden"  name="product_name" value="<?php echo $product_name;?>">

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
                        <input type="submit" class="btn btn-primary" style="width:100px;"  name="update_images" value="Update">
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