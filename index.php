<!DOCTYPE html>
<html lang="en">
<head>
  <title>i Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
  session_start();
  include_once("connection.php");
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">i.S</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Management</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=category_management">Category</a></li>
            <li><a class="dropdown-item" href="?page=product_management">Product</a></li>
          </ul>
        </li>  
        <li class="nav-item">
          <a class="nav-link" href="#About">About us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Contact">Contact</a>
        </li>  
        <?php
        if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
        ?>
        <li class="nav-item">
        <a class="nav-link" href="?page=update_member" id="btnUser"><i class="glyphicon glyphicon-user"></i> Hi, <?php echo $_SESSION['us'] ?></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="?page=logout" id="btnLogout" class="glyphicon glyphicon-log-out">LOGOUT <i class="bi bi-box-arrow-right"></i></a>
        </li>
        <?php
        } else {
        ?>
            <li class="nav-item">
              <a class="nav-link" href="?page=register" id="btnRegister">REGISTER&nbsp;<i class="bi bi-person-plus"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=login" id="btnLogin">LOGIN&nbsp;<i class="bi bi-box-arrow-in-right"></i></a>
            </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
  <?php
  if (isset(($_GET['page']))) {
        $page = $_GET['page'];
        if ($page == "register") {
          include_once("register.php");
        } elseif ($page == "login") {
          include_once("login.php");
        } elseif ($page == "logout") {
          include_once("logout.php");
        } elseif ($page == "update_member") {
          include_once("update_member.php");
        } elseif ($page == "category_management") {
          include_once("category_management.php");
        } elseif ($page == "add_category") {
          include_once("add_category.php");
        } elseif ($page == "update_category") {
          include_once("update_category.php");
        } elseif ($page == "product_management") {
          include_once("product_management.php");
        } elseif ($page == "add_product") {
          include_once("add_product.php");
        } elseif ($page == "update_product") {
          include_once("update_product.php");
        } 
    } 
  else {
    include("content.php");
  }
  ?>
  <footer>
    <div class="jumbotron text-center" style="margin-bottom:0">
        <p>
            This online store have been developed by Greenwich's Student.
        </p>
        <p>
        Copyright © 2022 Assignment <br>
        Copyright © images Apple
      </p>
    </div>
  </footer>
</body>

</html>