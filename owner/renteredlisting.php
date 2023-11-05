<?php
include('sidebar.php');

if (isset($_POST['endstay'])) {
    $listing_id = $_POST['listing_id'];

    // Update the listing status
    $listingsql = "UPDATE listing SET status = ? WHERE listing_id = ?";
    $listingstmt = $conn->prepare($listingsql);
    $status_rented = 'active'; // Make sure this status matches the one in your database
    $listingstmt->bind_param("si", $status_rented, $listing_id);
    $listingstmt->execute();

    // // Update the application status
    // $sql = "UPDATE application SET status = ?, date_of_application = NOW() WHERE listing_id = ?";
    // $stmt = $conn->prepare($sql);
    // $status = 'renter';
    // $stmt->bind_param("si", $status, $listing_id);
    // $stmt->execute();
}


?>

      <div class="contents">
        <div class="crm demo6 mb-25">
          <div class="container-fluid">
            <div class="row ">
              <div class="col-lg-12">
                <div class="breadcrumb-main">
                  <h4 class="text-capitalize breadcrumb-title">Rented Listing</h4>
                  <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rented Listing</li>
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
                    <h4 class="text-capitalize fw-500 breadcrumb-title">Rented Listing</h4>
                    <span class="sub-title ms-sm-25 ps-sm-25">Home</span>
                  </div>
                  
                  <form action="http://demo.dashboardmarket.com/" class="d-flex align-items-center user-member__form my-sm-0 my-2">
                    <img src="img/svg/search.svg" alt="search" class="svg">
                    <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Search by Name" aria-label="Search">
                  </form>
                </div>
                
               
              </div>
            </div>
          </div>
        


               <div class="row">
         <?php
$sql = "SELECT * FROM listing WHERE status = 'rented'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo '<div class="col-md-6 col-sm-12 mb-25">
        <div class="media py-30 ps-30 pe-20 bg-white radius-xl users-list"> 
           <a href="viewlisting.php?listing_id='.$row["listing_id"].'">
        <img class="me-20 rounded-circle wh-80 bg-opacity-primary image-hover-effect" src="../uploads/'.$row["image_url"].'" alt="Generic placeholder image">
      </a>
            <div class="media-body d-xl-flex users-list-body">
                <div class="flex-1 pe-xl-30 users-list-body__title">
                    <h6 class="mt-0 fw-500">'.$row["listing_name"].'</h6>
                    <span>'.$row["address3"].','.$row["address4"].'</span>
                    <p class="mb-0">'.$row["description"].'</p>
                    <div class="users-list-body__bottom">
                        <span><span class="fw-600">Price:</span>
                        <span><span class="fw-600">₱'.$row["rentprice"].'</span></span>
                             <span class="ms-15"><span class="fw-600">₱'.$row["reservationfee"].' </span>Reservation Fee</span>
                    </div>
                    
                </div>
                <div class="users-list__button mt-xl-0 mt-15">
                    <form action="" method="post">
                        <input type="hidden" name="listing_id" value="'.$row["listing_id"].'">
                        <button type="submit" name="endstay" class="btn btn-primary btn-default btn-squared text-capitalize px-20 mb-10 global-shadow">Active</button>
                    </form>
                </div>
            </div>
        </div>';
    if ($row["isVerify"] == 'Verify') {
        echo '<span class="bg-opacity-success color-success rounded-pill userDatatable-content-status active">Verify</span>';
    } else {
        echo '<span class="bg-opacity-danger color-danger rounded-pill userDatatable-content-status active">Unverified</span>';
    }
echo '</div>';




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