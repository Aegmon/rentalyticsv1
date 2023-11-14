<?php

include('sidebar.php');
 
if (isset($_POST['rentnow'])) {
    // Retrieve the listing_id from the POST data
    $listing_id = $_POST['listing_id'];
    

    // Prepare and execute the SQL statement for updating the application status
    $sql = "INSERT INTO `application`(`tenant_id`, `listing_id`) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("ii", $id, $listing_id);
     $stmt->execute();
    header('location: renter.php');
      

}
if (isset($_POST['togo'])) {
    // Retrieve the listing_id from the POST data
    $listing_id = $_POST['listing_id'];
    

    $sql = "DELETE FROM `togo` WHERE listing_id = ?";
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $listing_id);
     $stmt->execute();
    header('location: index.php');
      

}
?>

     <div class="contents">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="shop-breadcrumb">
                <div class="breadcrumb-main">
                  <h4 class="text-capitalize breadcrumb-title">Places</h4>
                  <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Places</li>
                      </ol>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 mb-xxl-50 mb-30">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="search-style-2 global-shadow ">
                    <form action="http://demo.dashboardmarket.com/" class="d-flex align-items-center">
                      <div class="job-search">
                        <img src="img/svg/search.svg" alt="search" class="svg">
                        <input class="form-control border-0 box-shadow-none" type="search" placeholder="Search Place....." aria-label="Search">
                      </div>
                      <div class="location-search">
                        <img src="img/svg/map-pin.svg" alt="map-pin" class="svg">
                        <input class="form-control border-0 box-shadow-none" type="search" placeholder="Location" aria-label="Search">
                      </div>
                      <button class="btn btn-dark"><img src="img/svg/search.svg" alt="search" class="svg">search</button>
                    </form>
                  
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="products_page product_page--grid mb-30">
          <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="columns-1 col-lg-8 col-sm-10 mb-lg-0 mb-30">
          <div class="widget mb-lg-30">
            <div class="widget-header-title px-20 py-15">
              <h6 class="d-flex align-content-center fw-500">
                <img src="img/svg/sliders.svg" alt="sliders" class="svg">
                <span>Filters</span>
              </h6>
            </div>
            <div class="category_sidebar">
    
              <aside class="product-sidebar-widget mb-30">
                <div class="widget_title" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" role="button" aria-expanded="true">
                  <h6>Category</h6>
                </div>
                <div class="card border-0 shadow-none multi-collapse mt-10 collapse" id="multiCollapseExample2">
                  <div class="product-category limit-list-item">
                 <ul>
                 <li>
        <a href="#">
            <div class="w-100">
                <span class="fs-14 color-gray">all type<span class="item-numbers"></span></span>
            </div>
        </a>
    </li>
    <li>
        <a href="?category=Apartment">
            <div class="w-100">
                <span class="fs-14 color-gray">Apartment<span class="item-numbers"></span></span>
            </div>
        </a>
    </li>
    <li>
        <a href="?category=bedspace">
            <div class="w-100">
                <span class="fs-14 color-gray">Bed Space<span class="item-numbers"></span></span>
            </div>
        </a>
    </li>
    <li>
        <a href="?category=Dormitory">
            <div class="w-100">
                <span class="fs-14 color-gray">Dormitory<span class="item-numbers"></span></span>
            </div>
        </a>
    </li>
    <li>
        <a href="?category=boarding_house">
            <div class="w-100">
                <span class="fs-14 color-gray">Boarding House<span class="item-numbers"></span></span>
            </div>
        </a>
    </li>
</ul>

                  </div>
                </div>
              </aside>
              <aside class="product-sidebar-widget mb-30">
    <div class="widget_title" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" role="button" aria-expanded="true">
        <h6>Bed Rooms</h6>
    </div>
    <div class="card border-0 shadow-none multi-collapse mt-10 collapse" id="multiCollapseExample3">
        <div class="product-brands limit-list-item">
            <ul>
                <li>
                    <div class="checkbox-theme-default custom-checkbox">
                        <form method="POST" action="">
                            <input class="checkbox" type="checkbox" id="check-1" name="n_bedroom" value="1" onchange="this.form.submit()" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['n_bedroom']) && $_POST['n_bedroom'] == '1') echo 'checked'; ?>>
                            <label for="check-1">
                                <span class="checkbox-text">
                                    1
                                    <span class="item-numbers"></span>
                                </span>
                            </label>
                        </form>
                    </div>
                </li>
                <li>
                    <div class="checkbox-theme-default custom-checkbox">
                        <form method="POST" action="">
                            <input class="checkbox" type="checkbox" id="check-2" name="n_bedroom" value="2" onchange="this.form.submit()" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['n_bedroom']) && $_POST['n_bedroom'] == '2') echo 'checked'; ?>>
                            <label for="check-2">
                                <span class="checkbox-text">
                                    2
                                    <span class="item-numbers"></span>
                                </span>
                            </label>
                        </form>
                    </div>
                </li>
                <li>
                    <div class="checkbox-theme-default custom-checkbox">
                        <form method="POST" action="">
                            <input class="checkbox" type="checkbox" id="check-3" name="n_bedroom" value="3" onchange="this.form.submit()" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['n_bedroom']) && $_POST['n_bedroom'] == '3') echo 'checked'; ?>>
                            <label for="check-3">
                                <span class="checkbox-text">
                                    3
                                    <span class="item-numbers"></span>
                                </span>
                            </label>
                        </form>
                    </div>
                </li>
                <li>
                    <div class="checkbox-theme-default custom-checkbox">
                        <form method="POST" action="">
                            <input class="checkbox" type="checkbox" id="check-4" name="n_bedroom" value="5" onchange="this.form.submit()" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['n_bedroom']) && $_POST['n_bedroom'] == '5') echo 'checked'; ?>>
                            <label for="check-4">
                                <span class="checkbox-text">
                                    5
                                    <span class="item-numbers"></span>
                                </span>
                            </label>
                        </form>
                    </div>
                </li>
                <li>
                    <div class="checkbox-theme-default custom-checkbox">
                        <form method="POST" action="">
                            <input class="checkbox" type="checkbox" id="check-5" name="n_bedroom" value="5+" onchange="this.form.submit()" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['n_bedroom']) && $_POST['n_bedroom'] == '5+') echo 'checked'; ?>>
                            <label for="check-5">
                                <span class="checkbox-text">
                                    5+
                                    <span class="item-numbers"></span>
                                </span>
                            </label>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>

                  <aside class="product-sidebar-widget mb-30">
                <div class="widget_title" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" role="button" aria-expanded="true">
                  <h6>Bath Rooms</h6>
                </div>
                <div class="card border-0 shadow-none multi-collapse mt-10 collapse " id="multiCollapseExample3">
                  <div class="product-brands limit-list-item">
                    <ul>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="check-1">
                          <label for="check-1">
                            <span class="checkbox-text">
1
<span class="item-numbers"></span>
                            </span>
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="check-2">
                          <label for="check-2">
                            <span class="checkbox-text">
2
<span class="item-numbers"></span>
                            </span>
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="check-3">
                          <label for="check-3">
                            <span class="checkbox-text">
3
<span class="item-numbers"></span>
                            </span>
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="check-4">
                          <label for="check-4">
                            <span class="checkbox-text">
5
<span class="item-numbers"></span>
                            </span>
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="check-5">
                          <label for="check-5">
                            <span class="checkbox-text">
5+
<span class="item-numbers"></span>
                            </span>
                          </label>
                        </div>
                      </li>
                 
                    </ul>
                  </div>
                </div>
              </aside>
              <aside class="product-sidebar-widget">
                <div class="widget_title" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample4" role="button" aria-expanded="true">
                  <h6>Ratings</h6>
                </div>
                <div class="card border-0 shadow-none multi-collapse mt-10 collapse " id="multiCollapseExample4">
                  <div class="product-ratings">
                    <ul>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="rating-1">
                          <label for="rating-1">
                            <span class="stars-rating d-flex align-items-center">
<span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="checkbox-text">
and up
<span class="item-numbers"></span>
                            </span>
                            </span>
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="rating-3">
                          <label for="rating-3">
                            <span class="stars-rating d-flex align-items-center">
<span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="checkbox-text">
and up
<span class="item-numbers"></span>
                            </span>
                            </span>
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="rating-4">
                          <label for="rating-4">
                            <span class="stars-rating d-flex align-items-center">
<span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="checkbox-text">
and up
<span class="item-numbers"></span>
                            </span>
                            </span>
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="rating-5">
                          <label for="rating-5">
                            <span class="stars-rating d-flex align-items-center">
<span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="checkbox-text">
and up
<span class="item-numbers"></span>
                            </span>
                            </span>
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox-theme-default custom-checkbox ">
                          <input class="checkbox" type="checkbox" id="rating-6">
                          <label for="rating-6">
                            <span class="stars-rating d-flex align-items-center">
<span class="star-icon las la-star active"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="star-icon las la-star inactive"></span>
                            <span class="checkbox-text">
and up
<span class="item-numbers"></span>
                            </span>
                            </span>
                          </label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </aside>
            </div>
          </div>
        </div>
        <div class="columns-2 col-lg-12">
  <div class="shop_products_top_filter">
    <div class="project-top-wrapper d-flex flex-wrap align-items-center">
      <div class="project-top-right d-flex flex-wrap align-items-center">
        <div class="project-category flex-wrap d-flex align-items-center">
          <p class="fs-14 color-gray text-capitalize">sort by:</p>
          <div class="project-tap">
            <div class="dm-select ">
         <form method="POST" action="">
    <select name="select-search" class="form-control" onchange="this.form.submit()">
        <option value="01" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['select-search'] == '01') echo 'selected'; ?>>All</option>
        <option value="02" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['select-search'] == '02') echo 'selected'; ?>>Latest</option>
        <option value="03" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['select-search'] == '03') echo 'selected'; ?>>Top Rated</option>
    </select>
</form>

            </div>
          </div>
        </div>
        <div class="project-icon-selected content-center mt-lg-0 mt-25"></div>
      </div>
    </div>
  </div>
  <div class="row product-page-list">
    <?php
    $sql = "SELECT * FROM listing l 
    JOIN togo t on l.listing_id = t.listing_id WHERE t.tenant_id = '$id'";
    if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql .= " AND type = '$category'";
}
if (isset($_GET['n_bedroom'])) {
    $n_bedroom = $_GET['n_bedroom'];
    if ($n_bedroom === '5+') {
        $sql .= " AND n_bedroom >= 5";
    } else {
        $sql .= " AND n_bedroom = '$n_bedroom'";
    }
}
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['select-search'])) {
        if ($_POST['select-search'] == '02') {
            $sql .= " ORDER BY created_at DESC";
        } elseif ($_POST['select-search'] == '03') {
            $sql .= " AND listing_id IN (SELECT listing_id FROM review GROUP BY listing_id HAVING AVG(rating) >= 4)";
        }
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
      $listing_id = $row['listing_id'];
          $sql = "SELECT 
                    *, 
                    COUNT(*) AS review_count, 
                    AVG(rating) AS average_rating 
                FROM review 
                WHERE listing_id = '$listing_id'";
        $result_review = $conn->query($sql);
        if ($result_review->num_rows > 0) {
            while ($row_review = $result_review->fetch_assoc()) {
                $rating = $row_review['average_rating'];
                $rating_count = $row_review['review_count'];
            }
        } else {
            $rating = "No Rating Yet";
            $rating_count = "0";
        }
      ?>
      
                  <div class="col-12 mb-30 px-10">
                    <div class="card product product--list d-flex">
                      <div class="h-100">
                        <div class="card-body product-item ">
                          <div class="card-body product-item__image position-relative">
                            
                            <img  src="../uploads/<?php echo $row['image_url'];?>" alt="digital-chair">
                            
                          </div>
                          <div class="mx-4 p-10 d-flex flex-column">
                              <a href="#">
                                <h6 class="card-title"><?php echo $row['listing_name'];?></h6>
                              </a>
                              <p class="mb-0"><?php echo $row['description'];?></p>
                              
                            </div>
                          <div class="product-item__body  mt-0 position-relative" >
                            <div class="product-item__content text-capitalize ">
                              <div class="d-flex mb-2 flex-wrap">
                                <span class="text-dark ">₱ <?php echo $row['rentprice'];?></span>
                              
                              
                              </div>
                              <div class="stars-rating d-flex align-items-center flex-wrap">
                                  <?php
            $numStars = intval($rating); // Get the integer part of the rating
            $decimal = $rating - $numStars; // Get the decimal part

            for ($i = 0; $i < 5; $i++) {
                if ($i < $numStars) {
                    echo '<span class="star-icon las la-star active"></span>';
                } else {
                    if ($decimal > 0) {
                        echo '<span class="star-icon las la-star-half-alt active"></span>';
                        $decimal = 0; // Set the decimal part to 0 after using it
                    } else {
                        echo '<span class="star-icon las la-star"></span>';
                    }
                }
            }
        ?>
                                <span class="stars-rating__point"> <?php echo $rating == intval($rating) ? number_format($rating, 0) : number_format($rating, 1); ?></span>
                                <span class="stars-rating__review fs-6">
                                <span><?php echo $rating_count ?></span> Reviews</span>
                              </div>
                              <div class="product-item__button">
                                <form method="post">
                                  <input type ="hidden" name="listing_id" value="<?php echo $listing_id;?>">
                                  
                                <button type="submit" name="addtogo" class="btn btn-default btn-squared color-light btn-outline-light ms-lg-0 ms-0 me-2 mb-lg-10">
                                 Remove
                                </button>

                                </form>
                                 <a href="viewlisting.php?listing_id=<?php echo $listing_id;?>"class="btn btn-gray fs-6 text-white btn-default btn-squared border-0 ms-0">View place
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
<?php      }
    } else {
        echo "0 results";
    }
    ?>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="user-pagination">
        <div class="d-flex justify-content-md-end justify-content-center mt-1 mb-30">
          <nav class="dm-page ">
            <ul class="dm-pagination d-flex">
                            <li class="dm-pagination__item">
                              <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-left"></span></a>
                              <a href="#" class="dm-pagination__link"><span class="page-number">1</span></a>
                              <a href="#" class="dm-pagination__link active"><span class="page-number">2</span></a>
                              <a href="#" class="dm-pagination__link"><span class="page-number">3</span></a>
                              <a href="#" class="dm-pagination__link pagination-control"><span class="page-number">...</span></a>
                              <a href="#" class="dm-pagination__link"><span class="page-number">12</span></a>
                              <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-right"></span></a>
                              <a href="#" class="dm-pagination__option">
                              </a>
                            </li>
                            <li class="dm-pagination__item">
                              <div class="paging-option">
                                <select name="page-number" class="page-selection">
                                  <option value="20">20/page</option>
                                  <option value="40">40/page</option>
                                  <option value="60">60/page</option>
                                </select>
                              </div>
                            </li>
                          </ul>
                        </nav>
                      </div>
                    </div>
                  </div>
                </div>
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
                  <p><span>© 2023</span><a href="#">Rentalytics</a>
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

   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgYKHZB_QKKLWfIRaYPCadza3nhTAbv7c"></script>
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
  </body>

  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/product-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:06:13 GMT -->
</html>