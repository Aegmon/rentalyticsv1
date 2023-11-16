<?php
include('sidebar.php');

?>
<?php


if (isset($_POST['add_dormitory'])) {
    $dormitory_name = $_POST['dormitory_name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $monthly_rent = $_POST['monthly_rent'];
    $down_payment = $_POST['down_payment'];
    $status = $_POST['status'];


    // Image Upload
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to the server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert the data into the database
            $sql = "INSERT INTO listing (listing_name,owner_id, location, description, monthly_rent, down_payment, status, image_url) 
            VALUES ('$dormitory_name', '$location', '$location', '$description', '$monthly_rent', '$down_payment', '$status',  '$fileName')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
    }

  
}
if (isset($_POST['update_listing'])) {
    $listing_id = $_POST['listing_id'];
    $dormitory_name = $_POST['dormitory_name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $monthly_rent = $_POST['monthly_rent'];
    $down_payment = $_POST['down_payment'];

    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir =  "../uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $sql = "UPDATE listing SET listing_name='$dormitory_name', location='$location', description='$description', monthly_rent='$monthly_rent', down_payment='$down_payment', image_url='".basename($_FILES["file"]["name"])."' WHERE listing_id=$listing_id";
    } else {
        $sql = "UPDATE listing SET listing_name='$dormitory_name', location='$location', description='$description', monthly_rent='$monthly_rent', down_payment='$down_payment' WHERE listing_id=$listing_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
if (isset($_POST['delete_listing'])) {
    $listing_id = $_POST['listing_id'];

    // Update the status to inactive
    $sql = "UPDATE listing SET status='inactive' WHERE listing_id=$listing_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>
    <div class="contents">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="breadcrumb-main user-member justify-content-sm-between ">
                <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                  <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                    <h4 class="text-capitalize fw-500 breadcrumb-title">Listing</h4>
                    <span class="sub-title ms-sm-25 ps-sm-25">Home</span>
                  </div>
                  <form action="http://demo.dashboardmarket.com/" class="d-flex align-items-center user-member__form my-sm-0 my-2">
                    <img src="img/svg/search.svg" alt="search" class="svg">
                    <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Search by Name" aria-label="Search">
                  </form>
                </div>
                <div class="action-btn">
                  <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal" data-bs-target="#new-member">
                    <i class="las la-plus fs-16"></i>Listing</a>
                  <div class="modal fade new-member " id="new-member" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content  radius-xl">
                        <div class="modal-header">
                          <h6 class="modal-title fw-500" id="staticBackdropLabel">Create Listing</h6>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="img/svg/x.svg" alt="x" class="svg">
                          </button>
                        </div>
                      <div class="modal-body">
    <div class="new-member-modal">
      <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="new-member-modal">
            <div class="form-group mb-20">
                <input type="text" class="form-control" name="dormitory_name" placeholder=" Name">
            </div>
            <div class="form-group mb-20">
                <input type="text" class="form-control" name="location" placeholder="Location">
            </div>
            <div class="form-group mb-20">
                <textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
            </div>
            <div class="form-group mb-20">
                <input type="number" class="form-control" name="monthly_rent" placeholder="Rent Price">
            </div>
            <div class="form-group mb-20">
                <input type="hidden" class="form-control" name="down_payment" value="0"placeholder="Down Payment">
            </div>
         
            <div class="form-group mb-20">
               <div class="dm-upload">
<div class="dm-upload-avatar media-import dropzone-md-s">
<p class="color-light mt-0 fs-14">Drop files here to upload</p>
</div>
<div class="avatar-up">
<input type="file" name="file" class="upload-avatar-input">
</div>
</div>
            </div>
            <div class="button-group d-flex pt-25">
                <button type="submit" name="add_dormitory" class="btn btn-primary btn-default btn-squared text-capitalize">Add New Listing</button>
                <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</form>

    </div>
</div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
         <?php
$sql = "SELECT * FROM listing WHERE status = 'active' AND owner_id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '
                <div class="col-md-6 col-sm-12 mb-25">
                  <div class="media  py-30  ps-30 pe-20 bg-white radius-xl users-list ">
                   <a href="viewlisting.php?listing_id='.$row["listing_id"].'">
                    <img class=" me-20 rounded-circle wh-80 bg-opacity-primary  " src="../uploads/'.$row["image_url"].'" alt="Generic placeholder image">
                    </a>
                    <div class="media-body d-xl-flex users-list-body">
                      <div class="flex-1 pe-xl-30 users-list-body__title">
                        <h6 class="mt-0 fw-500">'.$row["listing_name"].'</h6>
                        <span>'.$row["location"].'</span>
                        <p class="mb-0">'.$row["description"].'</p>
                        <div class="users-list-body__bottom">
                               <span ><span class="fw-600">Price:</span>
                          <span><span class="fw-600">₱'.$row["monthly_rent"].'</span></span>
                   
                        </div>
                      </div>
                      <div class="users-list__button mt-xl-0 mt-15">
                        <button class="btn btn-primary btn-default btn-squared text-capitalize px-20 mb-10 global-shadow" data-bs-toggle="modal" data-bs-target="#editModal'.$row["listing_id"].'">Edit
                        </button>
                        
                  <form action="" method="post">
    <input type="hidden" name="listing_id" value="'.$row["listing_id"].'">
    <button type="submit" name="delete_listing" class="border text-capitalize px-25 color-gray transparent shadow2 follow my-xl-0 radius-md">
        Delete
    </button>
    
</form>


                      </div>
                    </div>
                  </div>
                </div>

               
        
<div class="modal fade" id="editModal'.$row["listing_id"].'" tabindex="-1" aria-labelledby="editModal'.$row["listing_id"].'Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal'.$row["listing_id"].'Label">Edit Listing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="new-member-modal">
                        <input type="hidden" name="listing_id" value="'.$row["listing_id"].'">
                        <div class="form-group mb-20">
                            <input type="text" class="form-control" name="dormitory_name" value="'.$row["listing_name"].'" placeholder="Name">
                        </div>
                        <div class="form-group mb-20">
                            <input type="text" class="form-control" name="location" value="'.$row["location"].'" placeholder="Location">
                        </div>
                        <div class="form-group mb-20">
                            <textarea class="form-control" name="description" rows="3" placeholder="Description">'.$row["description"].'</textarea>
                        </div>
                        <div class="form-group mb-20">
                            <input type="number" class="form-control" name="monthly_rent" value="'.$row["monthly_rent"].'" placeholder="Monthly Rent">
                        </div>
                        <div class="form-group mb-20">
                            <input type="hidden" class="form-control" name="down_payment" value="'.$row["down_payment"].'" placeholder="Down Payment">
                        </div>
                        <div class="form-group mb-20">
                            <div class="dm-upload">
                                <div class="dm-upload-avatar media-import dropzone-md-s">
                                    <p class="color-light mt-0 fs-14">Drop files here to upload</p>
                                </div>
                                <div class="avatar-up">
                                    <input type="file" name="file" class="upload-avatar-input">
                                </div>
                            </div>
                        </div>
                        <div class="button-group d-flex pt-25">
                            <button type="submit" name="update_listing" class="btn btn-primary btn-default btn-squared text-capitalize">Update Listing</button>
                            <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


             ';
    }
} else {
    echo "0 results";
}
$conn->close();
?>




            
          </div>
        </div>
      </div>
      <footer class="footer-wrapper">
        <div class="footer-wrapper__inside">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <div class="footer-copyright">
                  <p><span>© 2023</span><a href="#">Sovware</a>
                  </p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="footer-menu text-end">
                  <ul>
                    <li>
                      <a href="#">About</a>
                    </li>
                    <li>
                      <a href="#">Team</a>
                    </li>
                    <li>
                      <a href="#">Contact</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
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
    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>
    <div class="customizer-wrapper">
      <div class="customizer">
        <div class="customizer__head">
          <h4 class="customizer__title">Customizer</h4>
          <span class="customizer__sub-title">Customize your overview page layout</span>
          <a href="#" class="customizer-close">
            <img class="svg" src="img/svg/x2.svg" alt>
          </a>
        </div>
        <div class="customizer__body">
          <div class="customizer__single">
            <h4>Layout Type</h4>
            <ul class="customizer-list d-flex layout">
              <li class="customizer-list__item">
                <a href="http://demo.dashboardmarket.com/hexadash-html/ltr" class="active">
                  <img src="img/ltr.png" alt>
                  <i class="fa fa-check-circle"></i>
                </a>
              </li>
              <li class="customizer-list__item">
                <a href="http://demo.dashboardmarket.com/hexadash-html/rtl">
                  <img src="img/rtl.png" alt>
                  <i class="fa fa-check-circle"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="customizer__single">
            <h4>Sidebar Type</h4>
            <ul class="customizer-list d-flex l_sidebar">
              <li class="customizer-list__item">
                <a href="#" data-layout="light" class="dark-mode-toggle active">
                  <img src="img/light.png" alt>
                  <i class="fa fa-check-circle"></i>
                </a>
              </li>
              <li class="customizer-list__item">
                <a href="#" data-layout="dark" class="dark-mode-toggle">
                  <img src="img/dark.png" alt>
                  <i class="fa fa-check-circle"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="customizer__single">
            <h4>Navbar Type</h4>
            <ul class="customizer-list d-flex l_navbar">
              <li class="customizer-list__item">
                <a href="#" data-layout="side" class="active">
                  <img src="img/side.png" alt>
                  <i class="fa fa-check-circle"></i>
                </a>
              </li>
              <li class="customizer-list__item top">
                <a href="#" data-layout="top">
                  <img src="img/top.png" alt>
                  <i class="fa fa-check-circle"></i>
                </a>
              </li>
              <li class="colors"></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgYKHZB_QKKLWfIRaYPCadza3nhTAbv7c"></script>
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
  </body>

  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/users-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:03:59 GMT -->
</html>