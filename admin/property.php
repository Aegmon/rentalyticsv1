<?php
include('sidebar.php');

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

    $titleOfDocument = $_POST['document'];

    // File upload handling
    $file = $_FILES['uploadDocuments'];
    $fileName1 = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileType1 = $file['type'];

    // Read the file data
    $fileData = file_get_contents($fileTmpName);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to the server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert the data into the database
            $sql = "INSERT INTO listing (listing_name,owner_id, location, description, monthly_rent, down_payment, status, image_url,mime, data, title, name) 
            VALUES ('$dormitory_name', '$location', '$location', '$description', '$monthly_rent', '$down_payment', '$status',  '$fileName',  '$fileType1','$fileData','$titleOfDocument','$fileName1')";

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

?>

      <div class="contents">
        <div class="crm demo6 mb-25">
          <div class="container-fluid">
            <div class="row ">
              <div class="col-lg-12">
                <div class="breadcrumb-main">
                  <h4 class="text-capitalize breadcrumb-title">Property</h4>
                  <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Property</li>
                      </ol>
                    </nav>
                  </div>
                </div>
              </div>
           
     
     
              
           <div class="row">
            <div class="col-lg-12">
              <div class="breadcrumb-main user-member justify-content-sm-between ">
                <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                  <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                    <h4 class="text-capitalize fw-500 breadcrumb-title">Property</h4>
                    <span class="sub-title ms-sm-25 ps-sm-25">Home</span>
                  </div>
<!--                   
                  <form action="http://demo.dashboardmarket.com/" class="d-flex align-items-center user-member__form my-sm-0 my-2">
                    <img src="img/svg/search.svg" alt="search" class="svg">
                    <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Search by Name" aria-label="Search">
                  </form> -->
                </div>
                
                <div class="action-btn">
                  <!-- <a href="addlisting.php" class="btn px-15 btn-primary">
                    <i class="las la-plus fs-16"></i>Listing</a> -->
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
    <label>Images:</label>
    <div class="dm-upload-avatar media-import dropzone-md-s">
        <p class="color-light mt-0 fs-14">Drop image files here to upload</p>
    </div>
    <div class="avatar-up">
        <input type="file" name="file[]" class="upload-avatar-input" multiple accept="image/*">
    </div>
</div>

            </div>
            <div class="form-group mb-20">
                <div class="dm-upload">
               
                    <input type="text" name="document_title" class="form-control" placeholder="Enter Document Title">
                </div>
                <div class="dm-upload">
                    <label>Document:</label>
                    <div class="dm-upload-avatar media-import dropzone-md-s">
                        <p class="color-light mt-0 fs-14">Drop files here to upload</p>
                    </div>
                    <div class="avatar-up">
                        <input type="file" name="document" class="upload-avatar-input">
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
$sql = "SELECT * FROM listing ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    echo '
        
    <div  class="col-md-6 col-sm-12 mb-20 image-hover-effect">
     
        <div class="media py-30 ps-30 pe-20 bg-white radius-xl users-list"> 
    
        <img class="me-20 rounded-circle wh-80 bg-opacity-primary " src="../uploads/'.$row["image_url"].'" alt="Generic placeholder image">
   
            <div class="media-body d-xl-flex users-list-body">
                <div class="flex-1 pe-xl-30 users-list-body__title">
                    <h6 class="mt-0 fw-500">'.$row["listing_name"].'</h6>
                    <span>'.$row["address3"].','.$row["address4"].'</span>
                    
                    <p class="mb-0">'.$row["description"].'</p>
                    <div class="users-list-body__bottom">
                        <span><span class="fw-600">Monthly Price:</span>
                        <span><span class="fw-600">₱'.$row["rentprice"].'</span></span>
                        <br>
                  <span class="fw-600"> Reservation Fee: </span>₱'.$row["reservationfee"].'
                    </div>
                    
                </div>
                <div class="users-list__button mt-xl-0 mt-15">
                    <a  href="viewlisting.php?listing_id='.$row["listing_id"].'"class="btn btn-secondary btn-default btn-squared text-capitalize px-20 mt-5 global-shadow">View Place</a>
                  <!---added po delete button--->
                    <form action="" method="post">
                        <input type="hidden" name="listing_id" value="'.$row["listing_id"].'">
                        
                    </form>
                </div>
            </div>
        </div>';
    if ($row["isVerify"] == 'Verify') {
        echo '<span class="bg-opacity-success color-success rounded-pill userDatatable-content-status active fs-6">Verify</span>';
    } else {
        echo '<span class="bg-opacity-danger color-danger rounded-pill userDatatable-content-status active fs-6">Unverified</span>';
    }
    
echo ' </div>  ';




    }
} else {
    echo "0 results";
}
$conn->close();
?>




            
          </div>
        
           
             
              
            </div>
          </div>
        </div>
      </div>
      <footer class="footer-wrapper">
        <div class="footer-wrapper__inside">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <div class="footer-copyright">
                  <!-- <p><span>© 2023</span><a href="#">Sovware</a> -->
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

  
</html>