<?php
session_start();
if (!(isset($_SESSION['admin']))) {
    header("Location:Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Admin Panel</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      <img class="navbar-brand" src="otherRes/Brand.png" />

      <button
        class="btn btn-link btn-sm text-white order-1 order-sm-0"
        id="sidebarToggle"
        href="#"
      >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="userDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
        </li>
      </ul>
    </nav>

    <div id="wrapper">
      <!------------------ Sidebar ----------------->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Admin</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user.php">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>User</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="posts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Post</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="otherRes/logoutAdmin.php">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a
          >
        </li>
      </ul>

      <div id="content-wrapper">
        <div
          class="
            m-2
            border-2 border
            d-flex
            justify-content-around
            align-items-center
            p-3
          "

          style="background-color: #F7D8BA; border-radius:10px";
        >
          <span class="fas fa-user-circle fa-10x"></span>
          <div>
            <h3 class="card-title">Total Users</h3>
            <?php
                include "otherRes/connection.php";
                  $query="SELECT COUNT(*) as userCount FROM Users";
                  $res=mysqli_query($con,$query);
                  $rec=mysqli_fetch_array($res);
                ?>
            <h3 class="text-center"><?php echo $rec["userCount"]?></h3>
          </div>
        </div>

        <div
          class="
            m-2
            border-2 border
            d-flex
            justify-content-around
            align-items-center
            p-3
          "
          style="background-color: #ACDDDE; border-radius:10px";
        >
         <i class="fas fa-solid fa-bars fa-10x"></i>
          <div>
            <h3 class="card-title">Total Posts</h3>
            <?php
                include "otherRes/connection.php";
                  $query="SELECT COUNT(*) as postCount FROM Posts";
                  $res=mysqli_query($con,$query);
                  $rec=mysqli_fetch_array($res);
                ?>
            <h3 class="text-center"><?php echo $rec["postCount"]?></h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </body>
</html>
