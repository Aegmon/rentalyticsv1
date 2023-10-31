<?php
include('sidebar.php');
   $listing_id = $_GET['listing_id'];
?>
<?php
if (isset($_POST['add'])) {
    $type = $_POST['type'];
    $gender = $_POST['gender'];
    $price = $_POST['price'];
    $reservation = $_POST['reservation'];
    $name = $_POST['name'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $address4 = $_POST['address4'];
    $desc = $_POST['desc'];
    $no_bed = $_POST['no_bed'];
    $no_bath = $_POST['no_bath'];
    $house_rules = $_POST['house_rules'];
   $lat = $_POST['lat'];
      $lng = $_POST['lng'];
    $sql = "INSERT INTO listing (listing_name, address1, address2, address3, address4, description, n_bedroom, n_bathroom, house_rules, rentprice, reservationfee, owner_id, gender_req,lat,lng) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssissssisss",
        $name,
        $address1,
        $address2,
        $address3,
        $address4,
        $desc,
        $no_bed,
        $no_bath,
        $house_rules,
        $price,
        $reservation,
        $id,
        $gender,
          $lat,
        $lng
    );

    if ($stmt->execute()) {
        $last_id = $stmt->insert_id;
        if (!empty($_POST['amenities'])) {
            foreach ($_POST['amenities'] as $amenity) {
                $amenitySql = "INSERT INTO amenities (listing_id, amenity) VALUES (?, ?)";
                $amenityStmt = $conn->prepare($amenitySql);
                $amenityStmt->bind_param("is", $last_id, $amenity);
                $amenityStmt->execute();
                $amenityStmt->close();
            }
        }

         if (!empty($_FILES['images']['name'])) {
        // Handle image upload
        $targetDir = "../uploads/";
        $fileName11 = basename($_FILES["images"]["name"]);
        $targetFilePath =  $targetDir.$fileName11;

        if (move_uploaded_file($_FILES["images"]["tmp_name"], $targetFilePath)) {
            // File successfully uploaded
            $image_sql = "UPDATE listing SET image_url=? WHERE listing_id=?";
            $imageStmt = $conn->prepare($image_sql);
            $imageStmt->bind_param("si", $targetFilePath, $last_id);
            if (!$imageStmt->execute()) {
                echo "Error updating record: " . $imageStmt->error;
            }
            $imageStmt->close();
        } else {
            // Failed to upload file
            echo "Failed to upload image file";
        }
    }

    if (!empty($_FILES['documents']['name'])) {
        // Handle document upload
        $titleOfDocument = $_POST['titleOfDocument'];
        $file = $_FILES['documents'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];

        // Read the file data
        $fileData = file_get_contents($fileTmpName);

        $document_sql = "UPDATE listing SET data=?, mime=?, title=?, name=? WHERE listing_id=?";
        $documentStmt = $conn->prepare($document_sql);
        $documentStmt->bind_param("ssssi", $fileData, $fileType, $titleOfDocument, $fileName, $last_id);

        if ($documentStmt->execute()) {
            // File data inserted successfully
            echo "File data inserted successfully";
        } else {
            // Error inserting file data
            echo "Error inserting file data: " . $documentStmt->error;
        }
        $documentStmt->close();
    }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
// SELECT LISTING

$sql = "SELECT * FROM listing where listing_id = '$listing_id'";
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
        $mime = $row["mime"];
        $data = $row["data"];
        $title = $row["title"];
        $name = $row["name"];
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
                  <div class="col-lg-5">
                    <div class="product-item__image">
                      <div class="wrap-gallery-article carousel slide carousel-fade" id="carouselExampleCaptions" data-bs-ride="carousel">
                        <div>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img class="img-fluid d-flex bg-opacity-primary " src="../uploads/<?php echo $image_url;?>" alt="Card image cap" title>
                            </div>
                            <div class="carousel-item">
                              <img class="img-fluid d-flex bg-opacity-primary" src="../uploads/<?php echo $image_url;?>" alt="Card image cap" title>
                            </div>
                            <div class="carousel-item">
                              <img class="img-fluid d-flex bg-opacity-primary" src="../uploads/<?php echo $image_url;?>"alt="Card image cap" title>
                            </div>
                          </div>
                        </div>
                        <div class="overflow-hidden">
                          <ul class="reset-ul d-flex flex-wrap list-thumb-gallery">
                            <li>
                              <a href="#" class="thumbnail active" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1">
                                <img class="img-fluid d-flex" src="../uploads/<?php echo $image_url;?>" alt>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="thumbnail " data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2">
                                <img class="img-fluid d-flex"  src="../uploads/<?php echo $image_url;?>" alt>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="thumbnail " data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3">
                                <img class="img-fluid d-flex" src="../uploads/<?php echo $image_url;?>"alt>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" col-lg-7">
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
                          ₱     <?php echo $rentprice;?></span>
                          <div class="d-flex align-items-center mb-2">
                           
                            <span class="product-discount">Reservation Fee : ₱     <?php echo $reservationfee;?></span>
                          </div>
                          <p class=" product-deatils-pera"><?php echo $description;?></p>
                          <div class="product-details__availability">
                            <div class="title">
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
                              <span class="stock"> <?php echo  $n_bedroom;?></span>
                            </div>
                             <div class="title">
                              <p>Bath Rooms:</p>
                              <span class="stock"> <?php echo  $n_bathroom;?></span>
                            </div>
                            <div class="title">
                              <p>Address:</p>
                              <span class="free"> <?php echo  $fullAddress;?></span>
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
                              <button class="btn btn-primary btn-default btn-squared border-0 me-10 my-sm-0 my-2">Edit</button>
                           
                             
                             
                            </div>
                           
                          </div>
                    </div>
                  </div>
                  
                </div>
<hr>
<div style="text-align: center; margin-bottom: 5px;">
    <span style="background-color: #ffffff; padding: 0 10px;">
        <h3 style="display: inline;">Feedback And Rating</h3>
    </span>
</div>
<hr>
 <div class="row">
        
    <div class="col-xxl-4 col-md-6 mb-25">
       <div class="card">
              <div class="user-group px-30 pt-30 pb-25 radius-xl">
                <div class="border-bottom">
                  <div class="media user-group-media d-flex justify-content-between">
                    <div class="media-body d-flex align-items-center">
                      <img class="me-20 wh-70 rounded-circle bg-opacity-primary" src="img/ugl1.png" alt="author">
                      <div>
                  
                          <h6 class="mt-0  fw-500">Juan Dela Cruz</h6>
                       
                        <p class="fs-13 color-light mb-0">San Francisco, Tarlac</p>
                      </div>
                    </div>
                    <div class="mt-n15">
                    
                    </div>
                  </div>
               
                    <p class="mt-15">Lorem ipsum dolor amet, consetetur sadipscing elitr sed diam nonumy eirmod dolor ame.</p>
              
               
                </div>
                      <div class="stars-rating  align-items-center">
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
   
    </div>
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
<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 15.4755, lng: 120.5963},
          zoom: 13
        });
        var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29),
      draggable: true // Make the marker draggable
    });
   marker.addListener('dragend', function() {
      var latLng = marker.getPosition();
      document.getElementById("latitude").value = latLng.lat();
      document.getElementById("longitude").value = latLng.lng();
    });

        var input = document.getElementById('search-box');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
          marker.setVisible(false);
         // Get the place object
var place = autocomplete.getPlace();

// Get the address components
var addressComponents = place.address_components;

// Initialize variables for the city, province, and barangay
var city = "";
var province = "";
var barangay = "";

// Iterate through the address components and extract the city, province, and barangay
for (var i = 0; i < addressComponents.length; i++) {
  if (addressComponents[i].types[0] == "locality") {
    city = addressComponents[i].long_name;
  } else if (addressComponents[i].types[0] == "administrative_area_level_2") {
    province = addressComponents[i].long_name;
  } else if (addressComponents[i].types[0] == "neighborhood") {
    barangay = addressComponents[i].long_name;
  }
}

// Display the city, province, and barangay in the HTML
document.getElementById("city").value = city;
document.getElementById("province").value = province;
document.getElementById("barangay").value = barangay;


          if (!place.geometry) {
            // Place was not found
            return;
          }

          // If the place has a geometry, then present it on a map
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          // Get the latitude and longitude of the marked place
          var latLng = marker.getPosition();

          // Display the latitude and longitude in the HTML
          document.getElementById("latitude").value = latLng.lat();
          document.getElementById("longitude").value = latLng.lng();
        });
      }
    </script>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        

        
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo6VqHn6BDlQ4PWMTPsHo1fDai1xQgHEQ&libraries=places&callback=initMap"
    async defer></script>








</body>
</html>