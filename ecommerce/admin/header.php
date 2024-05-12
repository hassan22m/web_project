<?php
// Start session if not already started
session_start();
}
?>
<?php   include('../server/connection.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin login</title>
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
    <header
      class="navbar sticky-top bg-dark flex-md-nowrap p-2 shadow"
      data-bs-theme="dark"
    >
      <a
        class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white"
        href="#"
        >ByteStack</a
      >
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
        <?php if(isset($_SESSION['admin_logged_in'])){ ?>
          <a class="btn btn-outline-light" type="button" href="logout.php?logout=1">Logout</a>
          <?php } ?>
        </li>
      </ul>
    </header>
