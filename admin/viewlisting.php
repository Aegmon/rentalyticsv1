<?php
include('sidebar.php');
   $listing_id = $_GET['listing_id'];
?>
<?php


if (isset($_POST['verify'])) {

     $listingsql = "UPDATE listing SET isVerify = ? WHERE listing_id = ?";
    $listingstmt = $conn->prepare($listingsql);
    $status_rented = 'Verify'; // Make sure this status matches the one in your database
    $listingstmt->bind_param("si", $status_rented, $listing_id);
    $listingstmt->execute();
}
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

$sql = "SELECT * FROM listing 
JOIN owner ON listing.owner_id = owner.owner_id where listing.listing_id = '$listing_id'";
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
        $docs_img = $row["docs_img"];
        $n_bedroom = $row["n_bedroom"];
        $n_bathroom = $row["n_bathroom"];
        $house_rules = $row["house_rules"];
        $lat = $row["lat"];
        $lng = $row["lng"];
        $fullAddress = $address1 . ", " . $address2 . ", " . $address3 . ", " . $address4;
        $name = $row["name"] ;
       
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

                      
                          <span class="product-desc-price">Monthly Price:
                          ₱     <?php echo $rentprice;?></span>
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
 <div class="title">
                        <p>Owner</p>
                        <span style="color:red;"><?php echo  $name;?></span>
                      </div>


                          </div>
                     
                        
                        </div>
                      </div>
                    </div>
                    <div class="product-details__availability">
                   
                        <div class="product-item__button mt-lg-30 mt-sm-25 mt-20 d-flex flex-wrap">
                            <div class=" d-flex flex-wrap product-item__action align-items-center">
                            <form method="post">
                <input type="hidden" value="<?php echo $listing_id; ?>">
                <?php
                // Check if the listing is already verified
                if ($isVerify !== 'Verify') {
                    echo '<button type="submit" name="verify" class="btn btn-success btn-default btn-squared border-0 me-10 my-sm-0 my-2">Verify</button>';
                } else {
                    echo '<button type="button" class="btn btn-success btn-default btn-squared border-0 me-10 my-sm-0 my-2" disabled>Verified</button>';
                }
                ?>
            </form>
              <button data-bs-toggle='modal' data-bs-target="#ownerModal<?php echo $listing_id; ?>" class="btn btn-primary btn-default btn-squared border-0 me-10 my-sm-0 my-2">View Documents</button>
                            </div>
                           
 <div class='modal fade' id="ownerModal<?php echo $listing_id; ?>" tabindex='-1' role='dialog' aria-labelledby='ownerModalLabel' aria-hidden='true'>
     <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='ownerModalLabel'>Documents</h5>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
            <div class='text-center' style='width:50%;'>
             <img src='<?php echo $docs_img;?>' width='400'>
              </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            </div>
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








</body>
</html>