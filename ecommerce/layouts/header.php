<?php 


// Start the session with HttpOnly cookie flag
ini_set('session.cookie_httponly', 1);
session_start();

// Set the session timeout period (in seconds)
$session_timeout = 1800; // 30 minutes

// Check if session variable for last activity time is set
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $session_timeout) {
    // Session has expired, destroy the session and redirect to login page
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id();

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Update the last activity time
$_SESSION['last_activity'] = time();
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
      <div class="container">
        <img class="logo" src="./assets/images/logo4.png">
        <h2 class="brand">ByteStack</h2>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">AboutUs</a>
            </li>  
            <li class="nav-item">
                <a class="nav-link" href="./cart.php"><i  class="fas fa-shopping-bag fa-lg">
                      <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){ ?>
                              <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                      <?php } ?>
                  </i>
                </a>
                
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./account.php"><i class="fas fa-user fa-lg"></i>
                </a>
            </li> 
        </div>
      </div>
    </nav>
