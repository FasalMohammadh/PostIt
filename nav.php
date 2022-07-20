<?php
if (session_status()>0) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <img class="navbar-brand" src="otherRes/Brand.png">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <?php
        if (!empty($_SESSION['email'])) {
          //nav for logged user
            ?>
          <div class="nav-item m-2 position-relative">
            <input placeholder="Search" type="text" name="search" class="form-control form-control-sm search"
              onkeyup="showUsers()" style="min-width: 300px;" />
            <div class="boxSearch text-center position-absolute rounded">
            </div>
          </div>
          <div class="btn-group nav-item m-2">
            <a class="btn btn-sm btn-primary" href="settings.php">
              <span class="bi bi-sliders"></span>
              Settings
            </a>
            <a class="btn btn-sm btn-primary" href="Home.php">
              <span class="bi bi-list"></span>
              Feeds
            </a>
            <a class="btn btn-sm btn-primary"
              href="profile.php?id=<?php echo $_SESSION['email']; ?>">
              <span class="bi bi-person-circle"></span>
              Profile
            </a>
            <a class="btn btn-sm btn-danger" href="otherRes/logout.php">
              <span class="bi bi-box-arrow-left"></span>
              Logout
            </a>
          </div>

          <?php
        } else {

          //nav for non logged user
            ?>
          <div class="btn-group nav-item m-2">
            <a class="btn btn-primary" href="Signup.php">
              <span class="bi bi-box-arrow-in-right"></span> Signup
            </a>
            <a class="btn btn-primary" href="Login.php">
              <span class="bi bi-box-arrow-right"></span> Login
            </a>
          </div>
          <?php
        }
     ?>
        </div>
      </div>
  </nav>
  <style type="text/css">
    .navbar .bi {
      font-size: 20px;
    }

    .boxSearch {
      height: 0;
      transition: height 0.25s ease-in-out;
      overflow-y: auto;
      background-color: #fff;
      width: 100%;
      z-index: 2;
    }

    .search:focus+.boxSearch {
      height: 150px;
      border: 1px solid #bfbfbf;
    }
  </style>
  <script type="text/javascript">
    function showUsers() {
      //ajax will send each key entered in the email box when user email matches with database this will load the profile picture in login page
      let keys = document.getElementsByName('search')[0].value;
      let box = document.getElementsByClassName('boxSearch')[0];
      box.innerHTML = "";
      if (keys.length > 0) {
        $.ajax({
          type: "POST",
          data: {
            keys: keys
          },
          url: "otherRes/showUsers.php",
        }).done(function(res) {
          
          if (res == "empty") {
            box.innerText = `No results found`;
          } else {
            res = JSON.parse(res);
            res.forEach(item => {
              box.innerHTML += (`
      <div class="singlePerson p-1 d-flex justify-content-between align-items-center">
        <a class="text-decoration-none text-black" href="profile.php?id=` + item.email + `">
          <img src="` + item.profile_pic_path + `" class="rounded-circle border " width="40px" height="40px">
          ` + item.fullname + `
        </a>
      </div>`);
            });
          }

        }).fail(function() {
          box.innerText = `Something went wrong`;
        });
      }
    }
  </script>

</body>

</html>