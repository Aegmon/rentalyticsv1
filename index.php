<?php
// Start the session
      session_start();

// Include the connection file
include('connection.php');

if (isset($_POST['login']) ) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM credentials WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            // Store user ID in session
      
            $_SESSION['user_id'] = $row['user_id'];

            if ($row['user_type'] == 'owner' ) {
           
if ($row['isVerify'] == '1') {
    header('Location: owner/index.php');
    exit(); 
} else {
  echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Please wait for verification",
                    text: "Please wait for the admin to verify your account.",
                    icon: "info"
                });
            });
        </script>';

}
    }
    elseif ($row['user_type'] == 'tenant') {
              if( $row['isVerify'] == '1'){
                header('Location: tenant/index.php');
              }else {
                echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            title: "Please wait for verification",
                            text: "Please wait for the admin to verify your account.",
                            icon: "info"
                        });
                    });
                </script>';
            
              }
            } 
            else {
             
              header('Location: admin/index.php');
            }
        }
    } 
    else{
      echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
          Swal.fire({
              title: "Wrong Email and Password",
              text: "Please Check your Email and Password.",
              icon: "info"
          });
      });
  </script>';

    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">

  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:06:10 GMT -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentalytics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="./sweetalert2.min.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <link rel="stylesheet" href="css/plugin.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="stylesheet" href="unicons.iconscout.com/release/v3.0.0/css/line.css">
    <!-- <script src="./sweetalert2.all.min.js"></script> -->
    

   
  </head>
  <body>
    <main class="main-content">
      <div class="admin">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
              <div class="edit-profile">


                <div class="card border-0">
                  <div class="card-header">
                    <div class="edit-profile__title">
                      <h6>Sign in Rentalytics</h6>
                    </div>
                  </div>
                 <form action="" method="post">
    <div class="card-body">
        <div class="edit-profile__body">
            <div class="form-group mb-25">
                <label for="username">Email Address</label>
                <input type="text" class="form-control" name="email" id="username" placeholder="name@example.com">
            </div>
            <div class="form-group mb-15">
                <label for="password-field">Password</label>
                <div class="position-relative">
                    <input id="password-field" type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="admin-condition">
               
                <a href="forget-password.html">Forgot password?</a>
            </div>
            <div class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                <button name="login" type="submit" class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn">
                    Sign in
                </button>
            </div>
        </div>
    </div>
</form>

                  <div class="admin-topbar">
                    <p class="mb-0">
                      Don't have an account?
                      <a href="signup.php" class="color-primary">
                        Sign up
                      </a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <div id="overlayer">
      <div class="loader-overlay">
        <div class="dm-spin-dots spin-lg">
          <span class="spin-dot badge-dot dot-primary"></span>
          <span class="spin-dot badge-dot dot-primary"></span>
          <span class="spin-dot badge-dot dot-primary"></span>
          <span class="spin-dot badge-dot dot-primary"></span>
        </div>
      </div>
    </div>
    <div class="enable-dark-mode dark-trigger">
      <ul>
        <li>
          <a href="#">
            <i class="uil uil-moon"></i>
          </a>
        </li>
      </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.all.min.js"></script>
    
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.all.min.js"></script>
  </body>

  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:06:10 GMT -->
</html>