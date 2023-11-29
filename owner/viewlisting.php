<?php
include('sidebar.php');
   $listing_id = $_GET['listing_id'];
   $currentMonth = date('m');
$currentYear = date('Y');

$sql1 = "SELECT 
            CASE WHEN MONTH(a.date_of_application) IN (1,2,3,4,5,6) THEN 'First Half' ELSE 'Second Half' END AS semi_annual_period,
            COUNT(*) AS total,
            SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS approved,
            SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN a.status = 'renter' THEN 1 ELSE 0 END) AS renter,
            l.n_bedroom
        FROM application a
        LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
        LEFT JOIN credentials c ON t.user_id = c.user_id
        LEFT JOIN listing l ON l.listing_id = a.listing_id
        LEFT JOIN payment p ON a.application_id = p.application_id
        WHERE l.listing_id = '$listing_id' 
        AND a.status IN ('approved', 'rejected', 'renter')
        GROUP BY semi_annual_period
        ORDER BY semi_annual_period";

$result1 = mysqli_query($conn, $sql1);

// Check if the query was successful
if ($result1) {
    // Initialize overall success count to zero
    $overall_success_count = 0;

    // Initialize first half success count to zero
    $first_half_success_count = 0;

    // Initialize n_bedroom variable
    $noofbedroom = 0;

    // Fetch the result as an associative array
    while ($row1 = mysqli_fetch_assoc($result1)) {
        // Access the 'approved' column from the result
        $approved_count = $row1['approved'];

        // Add the approved count to the overall success count
        $overall_success_count += $approved_count;

        // Check if it's the first half and update the first half success coun
        if ($row1['semi_annual_period'] == 'First Half') {
            $first_half_success_count = $approved_count;
        }

        // Update the n_bedroom variable
        $noofbedroom = $row1['n_bedroom'];
    }

    // Calculate forecast based on the first half success count
 
    $previousforecast = (0.8 * $first_half_success_count) + (0.2 * $first_half_success_count);
       $forecast = (0.8 * $overall_success_count) + (0.2 * $overall_success_count);
    // Calculate occupancy rate
    $occupancy_rate = ($overall_success_count / $noofbedroom) * 100;

    // Output the results
 
} 



?>
<?php
if (isset($_POST['update_listing'])) {
    $listing_id = $_POST['listing_id'];
    $listing_name = $_POST['dormitory_name'];
    $description = $_POST['description'];
    $no_bed = $_POST['no_bed'];
    $no_bath = $_POST['no_bath'];
    $status = $_POST['status'];

    // Update the listing
    $updateListingSql = "UPDATE listing 
    SET listing_name = ?, description = ?, n_bedroom = ?, n_bathroom = ?, status = ? 
    WHERE listing_id = ?";
    $updateListingStmt = $conn->prepare($updateListingSql);
    $updateListingStmt->bind_param(
        "ssissi",
        $listing_name,
        $description,
        $no_bed,
        $no_bath,
        $status,
        $listing_id
    );

    if (!$updateListingStmt->execute()) {
        echo "Error updating listing: " . $updateListingStmt->error;
    }

    // Update amenities
    $selectedAmenities = isset($_POST['amenities']) ? $_POST['amenities'] : [];
    $deleteAmenitiesSql = "DELETE FROM amenities WHERE listing_id = ?";
    $deleteAmenitiesStmt = $conn->prepare($deleteAmenitiesSql);
    $deleteAmenitiesStmt->bind_param("i", $listing_id);
    $deleteAmenitiesStmt->execute();

    foreach ($selectedAmenities as $amenity) {
        $amenitySql = "INSERT INTO amenities (listing_id, amenity) VALUES (?, ?)";
        $amenityStmt = $conn->prepare($amenitySql);
        $amenityStmt->bind_param("is", $listing_id, $amenity);
        $amenityStmt->execute();
    }

    // Close statements
    $updateListingStmt->close();
    $deleteAmenitiesStmt->close();

    // Redirect to the updated listing page or any other page as needed
    header("Location:index.php ");

}
// SELECT LISTING

$sql = "SELECT * FROM listing 
JOIN amenities ON listing.listing_id = amenities.listing_id where listing.listing_id = '$listing_id'";
$result = $conn->query($sql);
$rating = "";
$rating_count = "";
if ($result->num_rows > 0) {
    /// Review ///
    while ($row = $result->fetch_assoc()) {
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
        /// Review ///
        $listing_id = $row["listing_id"];
        $owner_id = $row["owner_id"];
        $listing_name = $row["listing_name"];
        $address1 = $row["address1"];
        $address2 = $row["address2"];
        $address3 = $row["address3"];
        $address4 = $row["address4"];
        $description = $row["description"];
        $rentprice = $row["rentprice"];
        $reservationfee = $row["reservationfee"];
        $image_url = $row["image_url"];
        $gender_req = $row["gender_req"];
        $created_at = $row["created_at"];
        $updated_at = $row["updated_at"];
        $status = $row["status"];
        $isVerify = $row["isVerify"];
 
          $status = $row["status"];
        $n_bedroom = $row["n_bedroom"];
        $n_bathroom = $row["n_bathroom"];
        $house_rules = $row["house_rules"];
        $lat = $row["lat"];
        $lng = $row["lng"];
        $fullAddress = $address1 . ", " . $address2 . ", " . $address3 . ", " . $address4;
        
    }
} else {
    echo "0 results";
}

?>

  <div class="contents">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="shop-breadcrumb">
                <div class="breadcrumb-main">
                  
                  <h4 class="text-capitalize breadcrumb-title">See Place</h4>
                  <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">See Place</li>
                      </ol>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="products mb-3">
          <div class="container-fluid">
            <div class="card product-details h-100 border-0">
              <div class="product-item p-sm-50 p-20">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="product-item__image">
                      <div class="wrap-gallery-article carousel slide carousel-fade" id="carouselExampleCaptions" data-bs-ride="carousel">
                        <div>
                        <?php
// Assuming $last_id contains the listing ID
$imageQuery = "SELECT image_url FROM images WHERE listing_id = ?";
$imageStmt = $conn->prepare($imageQuery);
$imageStmt->bind_param("i", $listing_id);
$imageStmt->execute();
$imageResult = $imageStmt->get_result();

$imageUrls = array();

while ($row = $imageResult->fetch_assoc()) {
    $imageUrls[] = $row['image_url'];
}

$imageStmt->close();
?>

<div class="carousel-inner">
    <?php foreach ($imageUrls as $index => $imageUrl): ?>
        <div class="carousel-item<?php echo $index === 0 ? ' active' : ''; ?>">
            <img class="img-fluid d-flex bg-opacity-primary" src="../uploads/<?php echo $imageUrl; ?>" alt="Card image cap" title="">
        </div>
    <?php endforeach; ?>
</div>

                        </div>
                        <div class="overflow-hidden">
                       <?php
// Assuming $last_id contains the listing ID
$imageQuery = "SELECT image_url FROM images WHERE listing_id = ?";
$imageStmt = $conn->prepare($imageQuery);
$imageStmt->bind_param("i", $listing_id);
$imageStmt->execute();
$imageResult = $imageStmt->get_result();

$imageUrls = array();

while ($row = $imageResult->fetch_assoc()) {
    $imageUrls[] = $row['image_url'];
}


?>

<ul class="reset-ul d-flex flex-wrap list-thumb-gallery">
    <?php foreach ($imageUrls as $index => $imageUrl): ?>
        <li>
            <a href="#" class="thumbnail<?php echo $index === 0 ? ' active' : ''; ?>" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $index; ?>" aria-label="Slide <?php echo $index + 1; ?>">
                <img class="img-fluid d-flex" src="../uploads/<?php echo $imageUrl; ?>" alt="">
            </a>
        </li>
    <?php endforeach; ?>
</ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" col-lg-4">
                    <div class=" b-normal-b mb-25 pb-sm-35 pb-15 mt-lg-0 mt-15">
                      <div class="product-item__body">
                        <div class="product-item__title">
                          <a href="#">
                            <h1 class="card-title">
                            <?php echo $listing_name;?>
                            </h1>
                          </a>
                        </div>
                        <div class="product-item__content text-capitalize">
                    <div class="product-item__content text-capitalize">
<div class="product-item__content text-capitalize">
    <div class="stars-rating d-flex align-items-center">
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
        <span class="stars-rating__point">
            <?php echo $rating == intval($rating) ? number_format($rating, 0) : number_format($rating, 1); ?>
        </span>
        <span class="stars-rating__review">
            <span><?php echo $rating_count ?></span> Reviews
        </span>
    </div>
</div>

</div>

                      
                          <span class="product-desc-price">
                        Monthly Price:  ₱     <?php echo $rentprice;?></span>
                          <div class="d-flex align-items-center mb-2">
                           
                            <span class="product-discount">Reservation Fee : ₱     <?php echo $reservationfee;?></span>
                          </div>
                          <p class=" product-deatils-pera"><?php echo $description;?></p>
                          <div class="product-details__availability">
                            <div class="title d-flex flex-column align-items-start" >
                              <p>Amenities: </p>
                           
                              <?php 
                              
$sql = "SELECT * FROM amenities where listing_id = '$listing_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
         ?>

   <span class="stock"><?php echo  $row["amenity"];?></span>
  <?php
    }
} else {
    echo "  No Amenities";
}
                              
?>
                          
                            </div>
                            
                              <div class="title">
                              <p>Bed Rooms:</p>
                              <span class="stock"><?php echo  $n_bedroom;?></span>
                            </div>
                             <div class="title">
                              <p>Bath Rooms:</p>
                              <span class="stock"><?php echo  $n_bathroom;?></span>
                            </div>
                            <div class="title">
                              <p>Address:</p>
                              <span class="free"><?php echo  $fullAddress;?></span>
                            </div>
                            <div class="title">
                        <p>House Rules:</p>
                        <span style="color:red;"><?php echo  $house_rules;?></span>
                      </div>
                  <div class="title">
    <p>For :</p>
    <span style="color:red;">
        <?php
            if ($gender_req === "Both") {
                echo "Male & Female";
            } elseif ($gender_req === "Male" || $gender_req === "Female") {
                echo $gender_req . " only";
            } else {
                echo $gender_req;
            }
        ?>
    </span>
</div>


                          </div>
                     
                        
                        </div>
                      </div>
                    </div>
                    <div class="product-details__availability">
                      <!-- <div class="title">
                        <p>Category:</p>
                        <span class="free">Furniture</span>
                      </div>
                      <div class="title">
                        <p>Tags:</p>
                        <span class="free"> Blue, Green, Light</span>
                      </div> -->
                        <div class="product-item__button mt-lg-30 mt-sm-25 mt-20 d-flex flex-wrap">
                            <div class=" d-flex flex-wrap product-item__action align-items-center">
                              <button class="btn btn-primary btn-default btn-squared border-0 me-10 my-sm-0 my-2" 
                              data-bs-toggle="modal" data-bs-target="#editModal<?php echo $listing_id;?>">Edit</button>
                           
                                <a href="reservation.php?listing_id=<?php echo $listing_id;?>"class="btn btn-secondary btn-default btn-squared border-0 me-10 my-sm-0 my-2">Reservation</a>
                             
                            </div>
                           
                                          <!-- MODAL -->




<div class="modal fade" id="editModal<?php echo $listing_id;?>" tabindex="-1" aria-labelledby="editModal<?php echo $listing_id;?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal'.$row["listing_id"].'Label">Edit Listing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="new-member-modal">
                        <input type="hidden" name="listing_id" value="<?php echo $listing_id;?>">
                        <div class="form-group mb-20">
                            <input type="text" class="form-control" name="dormitory_name" value="<?php echo $listing_name;?>" placeholder="Name">
                        </div>
                       
                        <div class="form-group mb-20">
                            <textarea class="form-control" name="description" rows="3" placeholder="Description"><?php echo $description;?></textarea>
                        </div>
                    <div class="row">
                  
                               <div class="col-md-12">
<div class="form-group mb-20">
    <label for="a9" class="il-gray fs-14 fw-500 align-center mb-10">Amenities</label>
    <div class="checkbox-list">
        <div class="checkbox-list__single mb-3">
            <div class="checkbox-group d-flex flex-wrap">

                <?php
                $sql = "SELECT * FROM amenities where listing_id = '$listing_id'";
                $result = $conn->query($sql);

                $amenitiesArray = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $amenitiesArray[] = $row["amenity"];
                    }
                } else {
                    echo "No Amenities";
                }

                $allAmenities = ["Internet", "Kitchen", "Bed", "Parking", "Pool", "Laundry Facilities"];

                foreach ($allAmenities as $amenity) {
                    $checked = in_array($amenity, $amenitiesArray) ? 'checked' : '';
                    echo '<div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                            <input class="checkbox" type="checkbox" id="check-grp-' . $amenity . '" name="amenities[]" value="' . $amenity . '" ' . $checked . '>
                            <label for="check-grp-' . $amenity . '">
                                <span class="checkbox-text">' . $amenity . '</span>
                            </label>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

                        
</div>
                   <div class="col-md-6">
                        <div class="form-group">
                          <label for="a9" class="il-gray fs-14 fw-500 align-center mb-10">Available Bedrooms</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15"name="no_bed" value="<?php echo $n_bedroom;?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="a9" class="il-gray fs-14 fw-500 align-center mb-10">Number of Bath Rooms</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15" name="no_bath"  value="<?php echo $n_bathroom;?>">
                        </div>
                      </div>
                        <div class="col-md-12">
                        <div class="form-group">
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Status</label>
           <select class="form-control ih-medium ip-light radius-xs b-light px-15" name="status">
    <option value="">Select Status</option>
    <option value="active" <?php echo isset($status) && $status === 'active' ? 'selected' : ''; ?>>Active</option>
    <option value="rented" <?php echo isset($status) && $status === 'rented' ? 'selected' : ''; ?>>Rented</option>
</select>


                        </div>
                      </div>
                    </div>

                        <div class="button-group d-flex pt-25">
                            <button type="submit" name="update_listing" class="btn btn-primary btn-default btn-squared text-capitalize">Update Listing</button>
                            <button type="button" class="btn btn-info btn-default btn-squared text-capitalize" data-bs-dismiss="modal">Cancel</button>
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
                   <div class=" col-lg-4">

  	            <div id="map" style="width: 100%; height: 50vh;margin-top:50px;"></div>



                       </div>
                </div>
                <hr>
<div style="text-align: center; margin-bottom: 1px;height:20px">
    <span style="background-color: #ffffff; padding: 0 10px;">
        <h3 style="display: inline;">Forcasting</h3>
    </span>
</div>
<hr>
 <div class="row">
      <div class="card">
         <div class="card-body">
<div class="text-center">
  Occupancy Rate 
  <strong><?php echo $occupancy_rate?> %</strong>
</div>
<div id="areaChartBasic1"></div>

          </div>
          </div>
  </div>
<hr>
<div style="text-align: center; margin-bottom: 5px;height:50px">
    <span style="background-color: #ffffff; padding: 0 10px;">
        <h3 style="display: inline;">Feedback And Rating</h3>
    </span>
</div>
<hr>
 <div class="row">
               <?php 
$sql = "SELECT * FROM review
JOIN tenant ON review.tenant_id = tenant.tenant_id where review.listing_id = '$listing_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
?>
    <div class="col-xxl-4 col-md-6 mb-25">
        <div class="card">
            <div class="user-group px-30 pt-30 pb-25 radius-xl">
                <div class="border-bottom">
                    <div class="media user-group-media d-flex justify-content-between">
                        <div class="media-body d-flex align-items-center">
                            <img class="me-20 wh-70 rounded-circle bg-opacity-primary" src="img/user.png" alt="author">
                            <div>
                                <h6 class="mt-0  fw-500"><?php echo $row['name']?></h6>
                            </div>
                        </div>
                        <div class="mt-n15"></div>
                    </div>
                    <p class="mt-15"><?php echo $row['feedback']?></p>
                </div>
                <div class="stars-rating align-items-center">
                    <?php
                        $rating = $row['rating']; // Get the rating from the row
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
                    <span class="stars-rating__point">
                        <?php echo $rating == intval($rating) ? number_format($rating, 0) : number_format($rating, 1); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php
    }
} else {
    echo "No Reviews Yet";
}
?>  

  
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
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/plugins.min.js"></script>
<script src="js/script.min.js"></script>


<script>
  document.getElementById('uploadInput').addEventListener('change', handleFileSelect, false);

  function handleFileSelect(event) {
    const files = event.target.files;
    const list = document.getElementById('imageList');
    list.innerHTML = '';
    for (let i = 0; i < Math.min(files.length, 5); i++) {
      const file = files[i];
      const listItem = document.createElement('li');
      const fileName = document.createElement('span');
      fileName.textContent = file.name;
      const deleteBtn = document.createElement('a');
      deleteBtn.className = 'btn-delete';
      deleteBtn.innerHTML = '<i class="la la-trash"></i>';
      deleteBtn.addEventListener('click', function () {
        listItem.remove();
      });
      listItem.appendChild(fileName);
      listItem.appendChild(deleteBtn);
      list.appendChild(listItem);
    }
  }
</script>

   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
<script>
    function initMap() {
        var center = { lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?> };

        var map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 16
        });

        var marker = new google.maps.Marker({
            position: center,
            map: map,
            animation: google.maps.Animation.BOUNCE
        });

        // Create a circle to represent the geofence
        var geofence = new google.maps.Circle({
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
            map: map,
            center: center,
            radius: 200 // 200 meters
        });
    }
</script>


     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo6VqHn6BDlQ4PWMTPsHo1fDai1xQgHEQ&libraries=places&callback=initMap"
    async defer></script>


<script>
    var options = {
        series: [{
            name: "Forecast Occupancy Rate",
            data: [<?php echo $previousforecast?>, <?php echo $forecast?>]
        }],
        chart: {
            type: 'area',
            height: 350,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth' // Changed to 'smooth' for a smoother curve
        },
        title: {
            text: 'Forecast Occupancy Rate ',
            align: 'left'
        },
       
        labels: ["july - Dec 2023", "jan - june 2024"],
        xaxis: {
            type: 'category', // Changed to 'category' since your labels are not timestamps
        },
        yaxis: {
            opposite: true
        },
        legend: {
            horizontalAlign: 'Right'
        }
    };

    // Ensure the container with ID "areaChartBasic1" exists
    var chartContainer = document.querySelector("#areaChartBasic1");
    
    if (chartContainer) {
        var chart = new ApexCharts(chartContainer, options);
        chart.render();
    } else {
        console.error("Chart container not found.");
    }
</script>






</body>
</html>