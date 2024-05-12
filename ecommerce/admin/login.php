<?php include('header.php');?>
<?php
include('../server/connection.php');
if(isset($_SESSION['admin_logged_in'])){
  header("location:index.php");//dashboard
  exit();
}
if(isset($_POST['login_btn'])){

  $email = $_POST['email'];
  $password = md5($_POST['password']); // to compare the hashed password in the db 

  $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins where admin_email=? AND admin_password=? limit 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
    $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
    $stmt->store_result();

    if($stmt->num_rows()==1){
      $stmt->fetch();
      $_SESSION['admin_id'] = $admin_id ; 
      $_SESSION['admin_name'] = $admin_name; 
      $_SESSION['admin_email'] = $admin_email; 
      $_SESSION['admin_logged_in'] = true; 
      header("location: index.php?login_success=logged in successfully");
    }
    else{
      header("location: login.php?error=could not verify your account");
    }
    
  }
  else{
    //error 
    header("location:login.php?error=something went wrong");
  }
}

?>


    <div class="container">
      <div class="row justify-content-center">
        <!-- Center the login form -->
        <form class="login-form col-12 col-md-6" method="POST" action="login.php" style="max-width: 320px; 
          margin: auto; margin-top: 160px; ">
          <!-- Adjust column width for responsiveness -->
          <h1 class="h3 mb-3 text-center">Log in</h1>

          <div class="form-floating my-3">
            <input
              type="email"
              class="form-control"
              id="floatingInput"
              placeholder="name@example.com"
              name="email"
            />
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating mt-3 my-3">
            <input
              type="password"
              class="form-control"
              id="floatingPassword"
              placeholder="Password"
              name="password"
            />
            <label for="floatingPassword">Password</label>
          </div>

          <button class="btn btn-primary w-100 py-2" type="submit" name="login_btn">
            Login
          </button>
        </form>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>