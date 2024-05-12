<?php
include('layouts/header.php');


include('server/connection.php');
//get the data from the form 
if (isset($_SESSION['logged_in'])){
  header("location: account.php");
  exit;
}
if (isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];
  //if passwords dosn't match 
  if($password !== $confirmPassword){
    header("location: register.php?error=passwords don't match");
  }
  //if password less than 8 chars 
  else if(strlen($password) < 8){
    header('location:register.php? error=password must be at least 8 charachters');
  }
  //if no errors 
  else{
    //check the email if stored in db prevoiusly 
    $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
    $stmt1->bind_param('s',$email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    if($num_rows !=0){
      header("location: register.php?error=user with this email already exists");
    }
    else{
      $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
      VALUES (?,?,?); ");

      //md5 to store the password in hashed form. 
      $stmt->bind_param('sss',$name,$email,md5($password));

      //if account created successfully 
      if($stmt->execute()){
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email ; 
        $_SESSION['user_name'] = $name; 
        $_SESSION['logged_in'] = true ; 
        header("location:account.php?register_success=You registered successfully");
      }
      //account not created 
      else{
        header("location: register.php?error=couldn't create an account");
      }
    }

    //store the information in session 
  }
  //if user registerd he will not be able to access the registration page
}



?> 


      
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="from-weight-bold">
                Register
            </h2>
            <hr class="mx-auto">
        </div>

        <div class="mx-auto container">
            <form id="register-form" method = "POST" action="register.php">
                <p style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];}?></p>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="register-name" 
                    name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="register-email" 
                    name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="">password</label>
                    <input type="password" class="form-control" id="register-password" 
                    name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="">confirm password</label>
                    <input type="password" class="form-control" id="register-confirm-password" 
                    name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" 
                    name = "register" value="Register">
                </div>
                <div class="form-group">
                    <a id="login-url" class="btn" href="./login.php">Do you have account? Login</a>
                </div>
            </form>
        </div>
        
      </section>


 <?php include('layouts/footer.php');?>