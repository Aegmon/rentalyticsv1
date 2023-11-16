<?php

include('sidebar.php');
 

if (isset($_POST['addtogo'])) {
    // Retrieve the listing_id and tenant_id from the POST data
    $listing_id = $_POST['listing_id'];

    
    // Check if the record already exists
    $check_sql = "SELECT * FROM `togo` WHERE `tenant_id` = ? AND `listing_id` = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $id, $listing_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    // If a record is found, display an alert and don't insert again
    if ($check_result->num_rows > 0) {
        echo '<script>alert("Already added to togo.");</script>';
    } else {
        // Prepare and execute the SQL statement for updating the application status
        $insert_sql = "INSERT INTO `togo`(`tenant_id`, `listing_id`) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ii", $id, $listing_id);
        $insert_stmt->execute();
        echo '<script>window.location.href = "togo.php";</script>';
    }
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
                   <form action="" method="POST" class="d-flex align-items-center">
  <div class="job-search">
    <img src="img/svg/search.svg" alt="search" class="svg">
    <input class="form-control border-0 box-shadow-none" type="search" name="place_search" placeholder="Search Place....." aria-label="Search">
  </div>
  <div class="location-search">
    <img src="img/svg/map-pin.svg" alt="map-pin" class="svg">
      <select  class="form-control border-0 box-shadow-none"  id="barangay" name="location_search" required>
    <option value="" selected disabled>Select Barangay</option>
    <option value="Aguso">Aguso</option>
    <option value="Alvindia">Alvindia</option>
    <option value="Amucao">Amucao</option>
    <option value="Armenia">Armenia</option>
    <option value="Asturias">Asturias</option>
    <option value="Atioc">Atioc</option>
    <option value="Balanti">Balanti</option>
    <option value="Balete">Balete</option>
    <option value="Balibago I">Balibago I</option>
    <option value="Balibago II">Balibago II</option>
    <option value="Balingcanaway">Balingcanaway</option>
    <option value="Banaba">Banaba</option>
    <option value="Bantog">Banteg</option>
    <option value="Baras-baras">Baras-baras</option>
    <option value="Batang-batang">Batang-batang</option>
    <option value="Binauganan">Binauganan</option>
    <option value="Bora">Bora</option>
    <option value="Buenavista">Buenavista</option>
    <option value="Buhilit">Buhilit</option>
    <option value="Burot">Burot</option>
    <option value="Calingcuan">Calingcuan</option>
    <option value="Capehan">Capehan</option>
    <option value="Carangian">Carangian</option>
    <option value="Care">Care</option>
    <option value="Central">Central</option>
    <option value="Culipat">Culipat</option>
    <option value="Cut-cut I">Cut-cut I</option>
    <option value="Cut-cut II">Cut-cut II</option>
    <option value="Dalayap">Dalayap</option>
    <option value="Dela Paz">Dela Paz</option>
    <option value="Dolores">Dolores</option>
    <option value="Laoang">Laoang</option>
    <option value="Ligtasan">Ligtasan</option>
    <option value="Lourdes">Lourdes</option>
    <option value="Mabini">Mabini</option>
    <option value="Maligaya">Maligaya</option>
    <option value="Maliwalo">Maliwalo</option>
    <option value="Mapalacsiao">Mapalacsiao</option>
    <option value="Mapalad">Mapalad</option>
    <option value="Matatalaib">Matatalaib</option>
    <option value="Paraiso">Paraiso</option>
    <option value="Poblacion">Poblacion</option>
    <option value="Salapungan">Salapungan</option>
    <option value="San Carlos">San Carlos</option>
    <option value="San Francisco">San Francisco</option>
    <option value="San Isidro">San Isidro</option>
    <option value="San Jose">San Jose</option>
    <option value="San Jose de Urquico">San Jose de Urquico</option>
    <option value="San Juan Bautista (formerly Matadero)">San Juan Bautista (formerly Matadero)</option>
    <option value="San Juan de Mata (formerly Malatiki)">San Juan de Mata (formerly Malatiki)</option>
    <option value="San Luis">San Luis</option>
    <option value="San Manuel">San Manuel</option>
    <option value="San Miguel">San Miguel</option>
    <option value="San Nicolas">San Nicolas</option>
    <option value="San Pablo">San Pablo</option>
    <option value="San Pascual">San Pascual</option>
    <option value="San Rafael">San Rafael</option>
    <option value="San Roque">San Roque</option>
    <option value="San Sebastian">San Sebastian</option>
    <option value="San Vicente">San Vicente</option>
    <option value="Santa Cruz">Santa Cruz</option>
    <option value="Santa Maria">Santa Maria</option>
    <option value="Santo Cristo">Santo Cristo</option>
    <option value="Santo Domingo">Santo Domingo</option>
    <option value="Santo Niño">Santo Niño</option>
    <option value="Sapang Maragul">Sapang Maragul</option>
    <option value="Sapang Tagalog">Sapang Tagalog</option>
    <option value="Sepung Calzada (Panampunan)">Sepung Calzada (Panampunan)</option>
    <option value="Sinait">Sinait</option>
    <option value="Suizo">Suizo</option>
    <option value="Tariji">Tariji</option>
    <option value="Tibag">Tibag</option>
    <option value="Tibagan">Tibagan</option>
    <option value="Trinidad">Trinidad</option>
    <option value="Ungot">Ungot</option>
    <option value="Villa Bacolor">Villa Bacolor</option>
</select>
  </div>
  <button type="submit" class="btn btn-dark">
    <img src="img/svg/search.svg" alt="search" class="svg">Search
  </button>
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
    <div class="widget_title nocollapse">
        <h6>Price Range</h6>
    </div>
    <form method="POST" action="">
        <div class="card border-0 shadow-none mt-10">
            <div class="product-price-ranges">
                <div id="price-range" class="mb-0">
                    <div class="section price">
                        <div class="input-group">
                            <input type="text" class="form-control" name="min_price" placeholder="Min Price" style="border: none; background-color: transparent; outline: none;">
                            <input type="text" class="form-control" name="max_price" placeholder="Max Price" style="border: none; background-color: transparent; outline: none;">
                            <button type="submit" class="btn btn-default btn-squared color-light btn-outline-light ms-lg-0 ms-0 me-2 mb-lg-10">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</aside>




              <aside class="product-sidebar-widget mb-30">
                <div class="widget_title" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" role="button" aria-expanded="true">
                  <h6>Category</h6>
                </div>
                <div class="card border-0 shadow-none multi-collapse mt-10 collapse" id="multiCollapseExample2">
                  <div class="product-category limit-list-item">
                 <ul>
                 <li>
        <a href="?category=alltype">
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
  <div class="widget_title" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3-bedroom" role="button" aria-expanded="true">
    <h6>Bedrooms</h6>
  </div>
  <div class="card border-0 shadow-none multi-collapse mt-10 collapse" id="multiCollapseExample3-bedroom">
    <div class="product-brands limit-list-item">
      <form method="POST" action="">
        <ul>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bedroom-check-1" name="n_bedroom" value="1" onchange="this.form.submit()">
              <label for="bedroom-check-1">
                <span class="checkbox-text">
                  1
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bedroom-check-2" name="n_bedroom" value="2" onchange="this.form.submit()">
              <label for="bedroom-check-2">
                <span class="checkbox-text">
                  2
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bedroom-check-3" name="n_bedroom" value="3" onchange="this.form.submit()">
              <label for="bedroom-check-3">
                <span class="checkbox-text">
                  3
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bedroom-check-4" name="n_bedroom" value="4" onchange="this.form.submit()">
              <label for="bedroom-check-4">
                <span class="checkbox-text">
                  4
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bedroom-check-5" name="n_bedroom" value="5" onchange="this.form.submit()">
              <label for="bedroom-check-5">
                <span class="checkbox-text">
                  5
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
        </ul>
      </form>
    </div>
  </div>
</aside>

<aside class="product-sidebar-widget mb-30">
  <div class="widget_title" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3-bathroom" role="button" aria-expanded="true">
    <h6>Bathrooms</h6>
  </div>
  <div class="card border-0 shadow-none multi-collapse mt-10 collapse" id="multiCollapseExample3-bathroom">
    <div class="product-brands limit-list-item">
      <form method="POST" action="">
        <ul>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bathroom-check-1" name="n_bathroom" value="1" onchange="this.form.submit()">
              <label for="bathroom-check-1">
                <span class="checkbox-text">
                  1
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bathroom-check-2" name="n_bathroom" value="2" onchange="this.form.submit()">
              <label for="bathroom-check-2">
                <span class="checkbox-text">
                  2
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bathroom-check-3" name="n_bathroom" value="3" onchange="this.form.submit()">
              <label for="bathroom-check-3">
                <span class="checkbox-text">
                  3
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bathroom-check-4" name="n_bathroom" value="4" onchange="this.form.submit()">
              <label for="bathroom-check-4">
                <span class="checkbox-text">
                  4
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
          <li>
            <div class="checkbox-theme-default custom-checkbox">
              <input class="checkbox" type="checkbox" id="bathroom-check-5" name="n_bathroom" value="5" onchange="this.form.submit()">
              <label for="bathroom-check-5">
                <span class="checkbox-text">
                  5
                  <span class="item-numbers"></span>
                </span>
              </label>
            </div>
          </li>
        </ul>
      </form>
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
                <option value="01" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['select-search']) && $_POST['select-search'] == '01') echo 'selected'; ?>>All</option>
                <option value="02" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['select-search']) && $_POST['select-search'] == '02') echo 'selected'; ?>>Latest</option>
                <option value="03" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['select-search']) && $_POST['select-search'] == '03') echo 'selected'; ?>>Top Rated</option>
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

if (isset($_POST['min_price']) && isset($_POST['max_price'])) {
    // Get the min and max price values from the form
    $min_price = intval($_POST['min_price']);
    $max_price = intval($_POST['max_price']);
    
    // Ensure rentprice column is of numeric type in your database
    $sql .= " AND rentprice BETWEEN $min_price AND $max_price";

    // Insert data into cus_ref table for min and max price
    $sql_pre_min_price = "INSERT INTO cus_ref (keyword, count) VALUES ('Min Price: $min_price', 1) ON DUPLICATE KEY UPDATE count = count + 1";
    $sql_pre_max_price = "INSERT INTO cus_ref (keyword, count) VALUES ('Max Price: $max_price', 1) ON DUPLICATE KEY UPDATE count = count + 1";
    $conn->query($sql_pre_min_price);
    $conn->query($sql_pre_max_price);
}



// Other input values processing
$place_search = isset($_POST['place_search']) ? $_POST['place_search'] : null;
$location_search = isset($_POST['location_search']) ? $_POST['location_search'] : null;

// Add conditions based on other input values
if ($place_search) {
    $sql .= " AND (listing_name LIKE '%$place_search%' OR description LIKE '%$place_search%' OR gender_req LIKE '%$place_search%' OR house_rules LIKE '%$place_search%')";

    // Update or insert into cus_ref
    $keyword = $conn->real_escape_string($place_search);
    $sql_ref = "INSERT INTO cus_ref (keyword, count) VALUES ('$keyword', 1) ON DUPLICATE KEY UPDATE count = count + 1";
    $conn->query($sql_ref);
}

if ($location_search) {
    $sql .= " AND (address1 LIKE '%$location_search%' OR address2 LIKE '%$location_search%' OR address3 LIKE '%$location_search%' OR address4 LIKE '%$location_search%')";

    // Insert data into cus_ref table for location search
    $sql_pre_location = "INSERT INTO cus_ref (keyword, count) VALUES ('$location_search', 1) ON DUPLICATE KEY UPDATE count = count + 1";
    $conn->query($sql_pre_location);
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    if ($category !== 'alltype') {
        $sql .= " AND type = '$category'";
        // Insert data into cus_ref table for category
        $sql_pre_category = "INSERT INTO cus_ref (keyword, count) VALUES ('$category', 1) ON DUPLICATE KEY UPDATE count = count + 1";
        $conn->query($sql_pre_category);
    }
}
if (isset($_POST['n_bedroom'])) {
    $n_bedroom = $_POST['n_bedroom'];
    if ($n_bedroom === '5+') {
        $sql .= " AND n_bedroom >= 5";
        // Insert data into cus_pre table
        $sql_pre_bed = "INSERT INTO cus_ref (keyword, count) VALUES ('Bed (5+)', 1) ON DUPLICATE KEY UPDATE count = count + 1";
        $conn->query($sql_pre_bed);
    } else {
        $sql .= " AND n_bedroom = '$n_bedroom'";
        // Insert data into cus_pre table
        $sql_pre_bed = "INSERT INTO cus_ref (keyword, count) VALUES ('Bed ($n_bedroom)', 1) ON DUPLICATE KEY UPDATE count = count + 1";
        $conn->query($sql_pre_bed);
    }
}

if (isset($_POST['n_bathroom'])) {
    $n_bathroom = $_POST['n_bathroom'];
    if ($n_bathroom === '5+') {
        $sql .= " AND n_bathroom >= 5";
          $sql_pre_bed = "INSERT INTO cus_ref (keyword, count) VALUES ('Bathroom (5+)', 1) ON DUPLICATE KEY UPDATE count = count + 1";
        $conn->query($sql_pre_bed);
    } else {
        $sql .= " AND n_bathroom = '$n_bathroom'";
           $sql_pre_bed = "INSERT INTO cus_ref (keyword, count) VALUES ('Bathroom ($n_bathroom)', 1) ON DUPLICATE KEY UPDATE count = count + 1";
        $conn->query($sql_pre_bed);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['select-search'])) {
    $selectSearch = $_POST['select-search'];

    if ($selectSearch === '01') {
        // All
    } elseif ($selectSearch === '02') {
        $sql .= " ORDER BY created_at DESC";
    } elseif ($selectSearch === '03') {
        $sql .= " AND listing_id IN (SELECT listing_id FROM review GROUP BY listing_id HAVING AVG(rating) >= 4)";
    }
} else {
    // Set a default value if the key is not set
    $selectSearch = '01';
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
                          <div class="card-body product-item__image">
                            
                            <img  src="../uploads/<?php echo $row['image_url'];?>" alt="digital-chair" style="width:50%;">
                            
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
                                  
                                <button type="submit" name="addtogo" class="btn btn-default btn-squared color-light btn-outline-light ms-lg-0 ms-0 me-2 mb-lg-10"><img src="img/svg/send.svg" alt="shopping-bag" class="svg">
                                  Add To Go
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
    <script>
var priceSlider = jQuery(".price-slider");

priceSlider.slider({
    range: true,
    min: 0,
    max: 30000,
    values: [0, 2000],
    slide: function (t, s) {
        // Update the text of the price-value input field
        jQuery(".price-value").val("₱" + s.values[0] + " - ₱" + s.values[1]);

        // Update other elements if needed
        jQuery(".job-value").text(s.values[0] + " miles");
        jQuery(".job-value2").text(s.values[1] + " miles");
    }
});

// Initialize the input field value on page load
jQuery(".price-value").val("₱" + priceSlider.slider("values", 0) + " - ₱" + priceSlider.slider("values", 1));
jQuery(".job-value").text(priceSlider.slider("values", 0) + " miles");
jQuery(".job-value2").text(priceSlider.slider("values", 1) + " miles");

jQuery(document).on("click", ".qty-plus", function() {
    // Your click handler logic here
    // Ensure you are updating the value of the price slider as needed
});

</script>
  </body>

  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/product-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:06:13 GMT -->
</html>