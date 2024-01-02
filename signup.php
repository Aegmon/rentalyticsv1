<?php
include('connection.php');

if (isset($_POST['submit'])) {
    // Gather form data
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $userType = $_POST['userType'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists
    $check_email_query = "SELECT COUNT(*) as count FROM credentials WHERE email = '$email'";
    $result = $conn->query($check_email_query);
    
    $row = $result->fetch_assoc();
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: "Registration Success!",
            text: "Please Wait for Account Verification.",
            icon: "success"
        });
    });
</script>';
    $email_count = $row['count'];

    if ($email_count > 0) {
        // Email already exists, display JavaScript alert
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Email Already Exist!",
                text: "Please Check your Email",
                icon: "info"
            });
        });
    </script>';
    } else {
     
        // Insert into credentials table
        $sql_credentials = "INSERT INTO credentials (email, password, user_type) VALUES ('$email', '$password', '$userType')";

        if ($conn->query($sql_credentials) === TRUE) {
            $user_id = $conn->insert_id;
            header('Location: index.php');
            
        // Check if the file was uploaded without errors
        if (isset($_FILES['idPicture']) && $_FILES['idPicture']['error'] === UPLOAD_ERR_OK && ($userType === "owner" || $userType === "tenant")) {
            $id_file_name = $_FILES['idPicture']['name'];
            $id_file_tmp = $_FILES['idPicture']['tmp_name'];
            $id_file_destination = 'uploads/' . $id_file_name;

            if (move_uploaded_file($id_file_tmp, $id_file_destination)) {
                // Insert into the respective table based on user type
                if ($userType === "owner") {
                    $profile_pic_name = $_FILES['profile_pic']['name'];
                    $profile_pic_tmp = $_FILES['profile_pic']['tmp_name'];
                    $profile_pic_destination = 'uploads/' . $profile_pic_name;

                    if (move_uploaded_file($profile_pic_tmp, $profile_pic_destination)) {
                        $sql_owner = "INSERT INTO owner (user_id, name, birthdate, gender,contactNumber, id_picture, profile_pic) VALUES ('$user_id', '$name', '$birthdate', '$gender','$contactNumber', '$id_file_name', '$profile_pic_name')";
                        if ($conn->query($sql_owner) !== TRUE) {
                            echo "Error: " . $sql_owner . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error uploading profile picture.";
                    }
                } elseif ($userType === "tenant") {
                    $profile_pic_name = $_FILES['profile_pic']['name'];
                    $profile_pic_tmp = $_FILES['profile_pic']['tmp_name'];
                    $profile_pic_destination = 'uploads/' . $profile_pic_name;

                    if (move_uploaded_file($profile_pic_tmp, $profile_pic_destination)) {
                        $sql_tenant = "INSERT INTO tenant (user_id, name, birthdate, gender, contactNumber,id_picture, profile_pic) VALUES ('$user_id', '$name', '$birthdate', '$gender','$contactNumber', '$id_file_name', '$profile_pic_name')";
                        if ($conn->query($sql_tenant) !== TRUE) {
                            echo "Error: " . $sql_tenant . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error uploading profile picture.";
                    }
                }
            } else {
                echo "Error uploading ID picture.";
            }
        } elseif ($userType === "owner") {
            echo "Error uploading ID picture. Please try again.";
        } elseif ($userType === "tenant") {
            // For tenants without ID picture upload
            $profile_pic_name = $_FILES['profile_pic']['name'];
            $profile_pic_tmp = $_FILES['profile_pic']['tmp_name'];
            $profile_pic_destination = 'uploads/' . $profile_pic_name;

            if (move_uploaded_file($profile_pic_tmp, $profile_pic_destination)) {
                $sql_tenant = "INSERT INTO tenant (user_id, name, birthdate, gender,contactNumber,id_picture,profile_pic) VALUES ('$user_id', '$name', '$birthdate', '$gender','$contactNumber', '$id_file_name','$profile_pic_name')";
                if ($conn->query($sql_tenant) !== TRUE) {
                    echo "Error: " . $sql_tenant . "<br>" . $conn->error;
                }
            } else {
                echo "Error uploading profile picture.";
            }
        }
      } else {
            // Display JavaScript alert for SQL error
            echo "<script>alert('Error: " . $sql_credentials . "\\n" . $conn->error . "');</script>";
        }
    }

    $conn->close();
    exit();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.min.css">
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
  <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" >
  <!-- onsubmit="sendEmail()"-->
    <div class="card-body">
        <div class="edit-profile__body">
            <div class="edit-profile__body">
                <div class="form-group mb-20">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Full Name" id="username" required>
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
                    <label for="contactNumber">Contact Number</label>
                    <input type="number" class="form-control" name="contactNumber" placeholder="0909209...">
                </div>

                <div class="form-group mb-20">
                    <label for="userType">User Type</label>
                    <select class="form-control" name="userType" >
                  <!-- id="userTypeSelect" -->
                        <option value="tenant">Renter</option>
                              <option value="owner">Owner</option>
                    </select>
                </div>

                <div id="idPictureUpload" class="form-group mb-20" >
                  <!-- style="display:none;" -->
                    <label for="idPicture">Upload ID Picture</label>
                    <input type="file" class="form-control" name="idPicture" accept="image/*">
                </div>
               <div class="form-group mb-20">
                      <label for="idPicture">Upload Profile Picture</label>
                     <input type="file" class="form-control" name="profile_pic" accept="image/*">
                </div>
                <div class="form-group mb-20">
                    <label for="email">Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="name@example.com" id="email" required>
                </div>
         

<!-- Your existing password input field -->
<div class="form-group mb-15">
  <label for="password">Password</label>
  <div class="position-relative">
    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
  </div>
</div>
    <div id="password-strength-message" class="mb-15"></div>
                <div class="admin-condition">
                    <div class="checkbox-theme-default custom-checkbox">
                        <input class="checkbox" type="checkbox" id="admin-1" required>
                        <label for="admin-1">
                            <span class="checkbox-text">Creating an account means you’re okay with our
                                <a href="#"  data-bs-toggle="modal" data-bs-target="#exampleModalLong" class="color-primary">
                                  Terms of Service and Privacy Policy</a> 
                           
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
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">TERMS OF SERVICE AND PRIVACY POLICIES</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<p ><strong>TERMS OF SERVICE</strong></p>
<p style="text-indent: 50px;">RENTALYTICS' major goal is to give Tarlac City's renters and landlords a single forum for 
communication and business dealings. The Tarlac Tourism Office will manage the system.</p>
<p>By using RENTALYTICS, you agree to the following Terms of Service:</p>
<ul style="list-style-type: none;">
  <li style="text-indent: 30px;">• You must be at least 18 years old to use RENTALYTICS.</li>
  <li style="text-indent: 30px;">• You must provide accurate and up-to-date information about yourself.</li>
  <li style="text-indent: 30px;">• You must not use RENTALYTICS for illegal or unauthorized purposes.</li>
  <li style="text-indent: 30px;">• You must not use RENTALYTICS to harass or bully other users.</li>
  <li style="text-indent: 30px;">• You must not post or transmit any content that is offensive, harmful, or discriminatory.</li>
</ul>
<p class="mt-5"><strong>Privacy Policy</strong></p>

<p style="text-indent: 50px;">	When you use the service, RENTALYTICS records information about you, including your name, email address, and 
contact details. We employ this data to both deliver the service you've requested and enhance it. Except as required to deliver
 the service, we never sell or otherwise disclose the information that you supply to us.</p>

<p style="text-indent: 50px;">We take measures to protect against unauthorized access, use, and disclosure of your information and 
we treat it with confidentiality. You have the right to seek access to your information and the correction 
of any errors. Additionally, you have the option to ask us to remove your data.</p>

<p class="mt-5"><strong>Changes to Terms of Service and Privacy Policy</strong></p>
<p style="text-indent: 50px;">We may change the Terms of Service and Privacy Policy from time to time. You will be notified of any
changes by email or by posting the changes on the RENTALYTICS website.</p>
<p style="text-indent: 50px;">By continuing to use RENTALYTICS after changes have been made to the Terms of Service and Privacy Policy, you agree to the new terms.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>

             
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
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.all.min.js"></script>
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
    <script>
    const userTypeSelect = document.getElementById('userTypeSelect');
    const idPictureUpload = document.getElementById('idPictureUpload');

    userTypeSelect.addEventListener('change', function () {
        if (userTypeSelect.value === 'owner') {
            idPictureUpload.style.display = 'block';
        } else {
            idPictureUpload.style.display = 'none';
        }
    });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('password').addEventListener('input', function() {
      validatePasswordStrength(this.value);
    });
  });

  function validatePasswordStrength(password) {
    // Password strength criteria
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

    // Check if the password meets the criteria
    if (strongRegex.test(password)) {
      document.getElementById('password-strength-message').innerText = 'Password strength: Strong';
      document.getElementById('password-strength-message').style.color = 'green';
    } else {
      document.getElementById('password-strength-message').innerText = 'Password strength: Weak (at least 8 characters, one uppercase letter, one lowercase letter, one number, and one special character)';
      document.getElementById('password-strength-message').style.color = 'red';
    }
  }
</script>
<!-- B320693378489E984BC26F3731436011F7D9 -->
<script>
  function validateForm() {
            var password = document.getElementById("password").value;
            // Check password strength (add your own criteria)
            if (password.length < 8) {
              Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Password must be at least 8 characters long',
                });
                return false;
            }

            // Add more password strength criteria as needed

            return true;
        }

        
</script>
      
  </body>
<!-- <script>
  function sendEmail(){
    Email.send({
          Host : "smtp.elasticemail.com",
          Username : "rentalyticstarlac@gmail.com",
          Password : "B320693378489E984BC26F3731436011F7D9",
          To  : "rentalyticstarlac@gmail.com",
          From : "ptptplinkwifi@gmail.com",
          Subject : "Rentalytics Registration",
          Body : "Welcome to Rentalytics"
        }).then(
          message => alert(message)
        );
  }
</script> -->
  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:06:10 GMT -->
</html>