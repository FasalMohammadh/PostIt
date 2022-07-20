<?php
session_start();
if (!(isset($_SESSION['admin']))) {
    header("Location:Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin Panel</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

   <img class="navbar-brand" src="otherRes/Brand.png">

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
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
          <span>User</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Post</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="otherRes/logoutAdmin.php">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!--#############################DELETE pop up form (bootstrap modal)##############################################-->


        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Delete User Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="deleteUser.php" method="POST">
                <div class="modal-body">


                  <input type="hidden" name="delete_id" id="delete_id">

                  <h4> Do You want to Delete this Data ??</h4>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="Submit" name="deletedata" class="btn btn-primary">Yes !! Delete it.</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!--########################################################################################################################-->

        <div class="container">

          <?php
              $connection = mysqli_connect("localhost", "root", "", );
              $db = mysqli_select_db($connection, 'webGrp');

              $query = "SELECT * FROM Users";
              $query_run = mysqli_query($connection, $query);
              ?>


          <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">DOB</th>
                <th scope="col">Profile Pic</th>
                <th scope="col">Joind Date</th>
                <th scope="col">BIO</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <?php
                              if ($query_run) {
                                  foreach ($query_run as $row) {
                                      ?>
            <tbody>
              <tr>
                <td><?php echo $row['fullname'] ?>
                </td>
                <td><?php echo $row['email'] ?>
                </td>
                <td><?php echo $row['DOB'] ?>
                </td>
                <td><?php echo $row['profile_pic_path'] ?>
                </td>
                <td><?php echo $row['joinedDate'] ?>
                </td>
                <td><?php echo $row['bio'] ?>
                </td>
                <td>
                  <button type="button" class="btn btn-danger deletebtn">DELETE</button>

                </td>
              </tr>
            </tbody>

            <?php
                                  }
                              } else {
                                  echo "NO Record Found";
                              }
                                  ?>
          </table>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

  <!--################################################# DELETE PART STARTS HERE#################################################-->
  <script>
    $(document).ready(function() {
      $('.deletebtn').on('click', function() {

        $("#deletemodal").modal('show');


        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
          return $(this).text();
        }).get();

        $('#delete_id').val(data[1]);

      });
    });
  </script>
  <!--################################################# DELETE PART ENDS HERE###################################################-->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

</body>

</html>