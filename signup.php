<?php
// Make sure the 'connection.php' file path is correct
include('connection.php');

if (isset($_POST['submit'])) {
    // Gather form data
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $userType = $_POST['userType'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert into credentials table
    $sql_credentials = "INSERT INTO credentials (email, password, user_type) VALUES ('$email', '$password', '$userType')";

    if ($conn->query($sql_credentials) === TRUE) {
        $user_id = $conn->insert_id;

        // Insert into respective table based on user type
        if ($userType === "owner") {
            $sql_renter = "INSERT INTO owner (user_id, name, birthdate, gender) VALUES ('$user_id', '$name', '$birthdate', '$gender')";
            if ($conn->query($sql_renter) !== TRUE) {
                echo "Error: " . $sql_renter . "<br>" . $conn->error;
            }
        } elseif ($userType === "tenant") {
            $sql_tenant = "INSERT INTO tenant (user_id, name, birthdate, gender) VALUES ('$user_id', '$name', '$birthdate', '$gender')";
            if ($conn->query($sql_tenant) !== TRUE) {
                echo "Error: " . $sql_tenant . "<br>" . $conn->error;
            }
        }

        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql_credentials . "<br>" . $conn->error;
    }

    $conn->close();
}
?>




<!doctype html>
<html lang="en" dir="ltr">

  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:06:10 GMT -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentalytics</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/plugin.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="stylesheet" href="../../../unicons.iconscout.com/release/v3.0.0/css/line.css">
  </head>
  <body>
    <main class="main-content">
      <div class="admin">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
              <div class="edit-profile">
                <div class="edit-profile__logos">

                  <!-- <a href="index-2.html">
<img class="dark" src="img/logo-dark.png" alt>
<img class="light" src="img/logo-white.png" alt>
</a> -->
                </div>
                <div class="card border-0">
                  <div class="card-header">
                    <div class="edit-profile__title">
                      <h6>Sign Up Rentalytics</h6>
                    </div>
                  </div>
          <form action="" method="post">
    <div class="card-body">
        <div class="edit-profile__body">
            <div class="edit-profile__body">
                <div class="form-group mb-20">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group mb-20">
                    <label for="birthdate">Birthdate</label>
              <input type="date" class="form-control" name="birthdate" required max="<?php echo date('Y-m-d',strtotime('-18 years')); ?>">

                </div>
                <div class="form-group mb-20">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group mb-20">
                    <label for="userType">User Type</label>
                    <select class="form-control" name="userType">
                        <option value="owner">Owner</option>
                        <option value="tenant">Tenant</option>
                    </select>
                </div>
                <div class="form-group mb-20">
                    <label for="email">Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="name@example.com" required>
                </div>
                <div class="form-group mb-15">
                    <label for="password">Password</label>
                    <div class="position-relative">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="admin-condition">
                    <div class="checkbox-theme-default custom-checkbox">
                        <input class="checkbox" type="checkbox" id="admin-1" required>
                        <label for="admin-1">
                            <span class="checkbox-text">Creating an account means you’re okay with our
                                <a href="#" class="color-primary">Terms of Service</a> and
                                <a href="#" class="color-primary">Privacy Policy</a>
                                my preference</span>
                        </label>
                    </div>
                </div>
                <div class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn">
                        Create Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


             
                  <div class="admin-topbar">
                    <p class="mb-0">
                      Don't have an account?
                      <a href="index.php" class="color-primary">
                        Sign In
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
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
  </body>

  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:06:10 GMT -->
</html>