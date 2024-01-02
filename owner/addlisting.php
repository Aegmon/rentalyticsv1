<?php
include('sidebar.php');

?>
<?php
   $listing_id = $_GET['listing_id'];
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
       $house_rules_str = implode(", ", $house_rules);

    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
   $sql = "INSERT INTO listing (listing_name, address1, address2, address3, address4, description, n_bedroom, n_bathroom, house_rules, rentprice, reservationfee, owner_id, gender_req, type, lat, lng) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssissssissss",
        $name,
        $address1,
        $address2,
        $address3,
        $address4,
        $desc,
        $no_bed,
        $no_bath,
        $house_rules_str, // Use the comma-separated string here
        $price,
        $reservation,
        $id,
        $gender,
        $type,
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
if (!empty($_FILES['images']['name'][0])) {
    // Handle main image upload
    $targetDir = "../uploads/";
    $fileName11 = basename($_FILES["images"]["name"][0]);
    $targetFilePath = $targetDir . $fileName11;

    if (move_uploaded_file($_FILES["images"]["tmp_name"][0], $targetFilePath)) {
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
        echo "Failed to upload main image file";
    }
}

// Handle additional images
for ($i = 1; $i < count($_FILES['images']['name']); $i++) {
    if (!empty($_FILES['images']['name'][$i])) {
        $targetDir = "../uploads/";
        $fileName = basename($_FILES['images']['name'][$i]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetFilePath)) {
            // File successfully uploaded
            $imageSql = "INSERT INTO images (listing_id, image_url) VALUES (?, ?)";
            $imageStmt = $conn->prepare($imageSql);
            $imageStmt->bind_param("is", $last_id, $targetFilePath);
            $imageStmt->execute();
            $imageStmt->close();
        } else {
            // Failed to upload file
            echo "Failed to upload image file";
        }
    }
}


    if (!empty($_FILES['documents']['name'])) {
         $targetDir = "../uploads/";
   
        $fileName = basename($_FILES["documents"]["name"]);
        $targetFilePath =  $targetDir.$fileName;
        // Read the file data
   

         if (move_uploaded_file($_FILES["documents"]["tmp_name"], $targetFilePath)) {
            // File successfully uploaded
            $image_sql = "UPDATE listing SET docs_img=? WHERE listing_id=?";
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

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="contents">
  <div class="container-fluid">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-main">
            <h4 class="text-capitalize breadcrumb-title">Add Listing</h4>
            <div class="breadcrumb-action justify-content-center flex-wrap">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Listing</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h6>Listing</h6>
            </div>
            <div class="card-body">
              <div class="card card-default card-md mb-4">
                <div class="card-body py-md-25">
                 <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="a1" class="il-gray fs-14 fw-500 align-center mb-10">Accomadation Type</label>
                          <select class="form-control ih-medium ip-light radius-xs b-light px-15" name="type" required>
                            <option value="boarding_house">Boarding house</option>
                            <option value="apartment">Apartment</option>
                            <option value="dormitory">Dormitory</option>
                            <option value="bedspace">Bedspace</option>
                            
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="a2" class="il-gray fs-14 fw-500 align-center mb-10">Gender Requirements</label>
                          <select class="form-control ih-medium ip-light radius-xs b-light px-15" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Both">Both</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Name</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="name" placeholder="Enter Place Name" required>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Price</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15" name="price" placeholder="Enter Price" required>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Reservation Fee</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15" name="reservation" placeholder="Enter Price" required>
                        </div>
                      </div>
                
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">Description</label>
                          <textarea class="form-control ih-medium ip-light radius-xs b-light px-15" name="desc" required></textarea>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a9" class="il-gray fs-14 fw-500 align-center mb-10">Number of Bedrooms</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15"name="no_bed" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a9" class="il-gray fs-14 fw-500 align-center mb-10">Number of Bath Rooms</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15" name="no_bath" required>
                        </div>
                      </div>
                    <div class="col-md-6">
    <div class="form-group">
        <label for="a9" class="il-gray fs-14 fw-500 align-center mb-10">Amenities</label>
        <div class="checkbox-list">
            <div class="checkbox-list__single mb-3">
                <div class="checkbox-group d-flex">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-4" name="amenities[]" value="Internet">
                        <label for="check-grp-4">
                            <span class="checkbox-text">Internet</span>
                        </label>
                    </div>
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-5" name="amenities[]" value="Kitchen">
                        <label for="check-grp-5">
                            <span class="checkbox-text">Kitchen</span>
                        </label>
                    </div>
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-6" name="amenities[]" value="Bed">
                        <label for="check-grp-6">
                            <span class="checkbox-text">Bed</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="checkbox-list__single mb-3">
                <div class="checkbox-group d-flex">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-7" name="amenities[]" value="Parking">
                        <label for="check-grp-7">
                            <span class="checkbox-text">Parking</span>
                        </label>
                    </div>
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-8" name="amenities[]" value="Pool">
                        <label for="check-grp-8">
                            <span class="checkbox-text">Pool</span>
                        </label>
                    </div>
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-9" name="amenities[]" value="Laundry Facilities">
                        <label for="check-grp-9">
                            <span class="checkbox-text">Laundry Facilities</span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- New Amenities -->
            <div class="checkbox-list__single mb-3">
                <div class="checkbox-group d-flex">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-10" name="amenities[]" value="Fire alarm">
                        <label for="check-grp-10">
                            <span class="checkbox-text">Fire alarm</span>
                        </label>
                    </div>
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-11" name="amenities[]" value="Fire exits">
                        <label for="check-grp-11">
                            <span class="checkbox-text">Fire exits</span>
                        </label>
                    </div>
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-12" name="amenities[]" value="CCTV">
                        <label for="check-grp-12">
                            <span class="checkbox-text">CCTV</span>
                        </label>
                    </div>
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-13" name="amenities[]" value="Lobby">
                        <label for="check-grp-13">
                            <span class="checkbox-text">Lobby</span>
                        </label>
                    </div>
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="check-grp-14" name="amenities[]" value="Parking lot">
                        <label for="check-grp-14">
                            <span class="checkbox-text">Parking lot</span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- End New Amenities -->
        </div>
    </div>
</div>

      <div class="col-md-12">
    <div class="form-group">
        <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">House Rules</label>
        <div class="checkbox-list d-flex">
            <div class="checkbox-list__single">
                <div class="checkbox-group">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="rule-check-1" name="house_rules[]" value="Observe Silence">
                        <label for="rule-check-1">
                            <span class="checkbox-text">Observe Silence</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="checkbox-list__single">
                <div class="checkbox-group">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="rule-check-2" name="house_rules[]" value="Visitor Not Allowed">
                        <label for="rule-check-2">
                            <span class="checkbox-text">Visitor Not Allowed</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="checkbox-list__single">
                <div class="checkbox-group">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="rule-check-3" name="house_rules[]" value="Maintain Cleanliness">
                        <label for="rule-check-3">
                            <span class="checkbox-text">Maintain Cleanliness</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="checkbox-list__single">
                <div class="checkbox-group">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="rule-check-4" name="house_rules[]" value="No Smoking">
                        <label for="rule-check-4">
                            <span class="checkbox-text">No Smoking</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="checkbox-list__single">
                <div class="checkbox-group">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="rule-check-5" name="house_rules[]" value="Liquor Not Allowed">
                        <label for="rule-check-5">
                            <span class="checkbox-text">Liquor Not Allowed</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="checkbox-list__single">
                <div class="checkbox-group">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="rule-check-6" name="house_rules[]" value="Room Inspections">
                        <label for="rule-check-6">
                            <span class="checkbox-text">Room Inspections</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="checkbox-list__single">
                <div class="checkbox-group">
                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                        <input class="checkbox" type="checkbox" id="rule-check-7" name="house_rules[]" value="No Pets Allowed">
                        <label for="rule-check-7">
                            <span class="checkbox-text">No Pets Allowed</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<label for="text-rule">Others:</label>
<textarea name="" id="text-rule" cols="15" rows="5"></textarea>
</div>
             <div class="col-md-12">
  <div class="form-group">
    <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">Images</label>
    <div class="dm-upload">
      <div class="dm-upload-avatar media-import dropzone-md-s">
        <p class="color-light mt-0 fs-14">Drop files here to upload</p>
      </div>
      <div class="avatar-up">
 <input type="file" name="images[]" class="upload-avatar-input" id="uploadInput" multiple accept="image/*" required>

      </div>
    </div>
  </div>
  <div class="dm-upload__file">
    <ul id="imageList">
      <!-- Uploaded image names will be displayed here -->
    </ul>
  </div>
</div>



                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Document Name <small style="color:red;">(For Verification Of admin)</small></label>
                        <select class="form-control ih-medium ip-light radius-xs b-light px-15" name="titleOfDocument" required>
    <option value="">Select Document</option>
    <option value="Business permit">Business permit</option>
    <option value="Mayor’s permit">Mayor’s permit</option>
    <option value="BIR">BIR</option>
    <option value="Fire safety certificate">Fire safety certificate</option>
</select>

                        </div>
                      </div>
                       <div class="col-md-12">
                        <div class="form-group">
                          <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">Documents</label>
                          <div class="dm-upload">
                            
                              <input type="file" name="documents" accept="image/*">
                      
                        </div>
                      </div>
<hr style="margin: 5px 0; padding: 0;">
<h3 class="text-center m-3">Address</h3>
   <div class="row">
       <div class="col-md-12">
          <label for="a4" class="il-gray fs-14 fw-500 align-center mb-10">Search</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15"  id="search-box" placeholder="Search...." >
          </div>
        <div class="col-md-3">
                        <div class="form-group">
                          <label for="a4" class="il-gray fs-14 fw-500 align-center mb-10">House No/Street/Block</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="address1"  placeholder="House No/Street/Block" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a5" class="il-gray fs-14 fw-500 align-center mb-10">Barangay</label>
                          <!-- <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" id="barangay" name="address2" placeholder="Barangay"> -->
                          <select class="form-control ih-medium ip-light radius-xs b-light px-15" id="barangay" name="address2" required>
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
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a6" class="il-gray fs-14 fw-500 align-center mb-10">City/Municipality</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" id="city" name="address3" placeholder="City" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a7" class="il-gray fs-14 fw-500 align-center mb-10">Province</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" id="province"name="address4" readonly placeholder="Province" value="Tarlac" required>
                        </div>
                      </div>
 </div>
                          <div class="col-md-12">
                              <div class="form-group">
                         <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">Pin Location</label>
                                   <input type="hidden" class="form-control" placeholder="lat" name="lat" id="latitude" required>
                                    <input type="hidden" class="form-control" placeholder="lng" name="lng" id="longitude" required>
                                           
										  	<div id="map" style="width: 100%; height: 50vh;"></div>
                         </div>
                               </div>
                      <div class="col-md-12">
  <div class="form-group">
    <button type="submit" name="add" class="btn btn-primary">Submit</button>
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