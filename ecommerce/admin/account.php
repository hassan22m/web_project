<?php include ('header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header("location:login.php");
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
            <h1 class="h2">Admin Account</h1>
          </div>

          <div class="container">
                <p>ID: <?php echo $_SESSION['admin_id'];?></p>
                <p>Name: <?php echo $_SESSION['admin_name'];?></p>
                <p>Email: <?php echo $_SESSION['admin_email'];?></p>
            </div>
          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
