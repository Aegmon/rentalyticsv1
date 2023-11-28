<?php

include('sidebar.php');
   $listing_id = $_GET['listing_id'];
?>
<?php
if (isset($_POST['rentnow'])) {
    // Retrieve the listing_id and tenant_id from the POST data
    $listing_id = $_POST['listing_id'];

    
    // Check if the record already exists
    $check_sql = "SELECT * FROM `application` WHERE `tenant_id` = ? AND `listing_id` = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii",$id, $listing_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    // If a record is found, display an alert and don't insert again
    if ($check_result->num_rows > 0) {
        echo '<script>alert("Already sent your application.");</script>';
    } else {
        // Prepare and execute the SQL statement for inserting the new application
        $insert_sql = "INSERT INTO `application`(`tenant_id`, `listing_id`) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ii",$id, $listing_id);
        $insert_stmt->execute();
        echo '<script>window.location.href = "renter.php";</script>';
    }
}

if (isset($_POST['send'])) {
    $msg = $_POST['msg'];
    $owner_id = $_POST['owner_id'];
  $stmt = $conn->prepare("INSERT INTO `message` (tenant_id, owner_id, message , message_from) VALUES (?, ?, ?,?)");
  $m_from ='tenant';
    $stmt->bind_param("iiss", $id, $owner_id, $msg ,$m_from);

    // Set parameters and execute
    $stmt->execute();
 header("Location: message.php");
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


                          </div>
                     
                        
                        </div>
                        
                      </div>
                    </div>
             
                  </div>
                   <div class=" col-lg-4">

  	            <div id="map" style="width: 100%; height: 50vh;margin-top:50px;"></div>

     <div class="product-item__button mt-lg-30 mt-sm-25 mt-20 d-flex flex-wrap">
                            <div class=" d-flex flex-wrap product-item__action align-items-center">
                               <a href="viewcalendar.php?listing_id=<?php echo $listing_id;?>"class="btn btn-gray fs-6 text-white btn-default btn-squared border-0 ms-0">View Calendar
                                </a>
             
                              <button class="btn btn-primary btn-default btn-squared border-0 me-10 my-sm-0 my-2" 
                              data-bs-toggle="modal" data-bs-target="#editModal<?php echo $owner_id;?>">Message Owner</button>
                           
                            <!-- MODAL -->




<div class="modal fade" id="editModal<?php echo $owner_id;?>" tabindex="-1" aria-labelledby="editModal<?php echo $owner_id;?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal'.$row["listing_id"].'Label">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="new-member-modal">
                        <input type="hidden" name="owner_id" value="<?php echo $owner_id;?>">
                    
                       
                        <div class="form-group mb-20">
                            <textarea class="form-control" name="msg" rows="7" placeholder="Type Your Message ...."></textarea>
                        </div>
                 

                        <div class="button-group d-flex pt-25">
                            <button type="submit" name="send" class="btn btn-primary btn-default btn-squared text-capitalize">Send</button>
                        
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