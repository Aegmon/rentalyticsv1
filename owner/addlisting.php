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

    $sql = "INSERT INTO listing (listing_name, address1, address2, address3, address4, description, n_bedroom, n_bathroom, house_rules, rentprice, reservationfee, owner_id, gender_req) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssissssis",
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
        $gender
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
        $targetFilePath =  $fileName11;

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
                          <select class="form-control ih-medium ip-light radius-xs b-light px-15" name="type">
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
                          <select class="form-control ih-medium ip-light radius-xs b-light px-15" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Both">Both</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Name</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="name" placeholder="Enter Place Name">
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Price</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15" name="price" placeholder="Enter Price">
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Reservation Fee</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15" name="reservation" placeholder="Enter Price">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a4" class="il-gray fs-14 fw-500 align-center mb-10">House No/Street/Block</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="address1" placeholder="House No/Street/Block">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a5" class="il-gray fs-14 fw-500 align-center mb-10">Barangay</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="address2" placeholder="Barangay">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a6" class="il-gray fs-14 fw-500 align-center mb-10">City</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="address3" placeholder="City">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a7" class="il-gray fs-14 fw-500 align-center mb-10">Province</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="address4" placeholder="Province">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">Description</label>
                          <textarea class="form-control ih-medium ip-light radius-xs b-light px-15" name="desc"></textarea>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a9" class="il-gray fs-14 fw-500 align-center mb-10">Number of Bedrooms</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15"name="no_bed" >
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="a9" class="il-gray fs-14 fw-500 align-center mb-10">Number of Bath Rooms</label>
                          <input type="number" class="form-control ih-medium ip-light radius-xs b-light px-15" name="no_bath">
                        </div>
                      </div>
                      <div class="col-md-3">
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
</div>

                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">House Rules</label>
                          <textarea class="form-control ih-medium ip-light radius-xs b-light px-15" name="house_rules"></textarea>
                        </div>
                      </div>
             <div class="col-md-12">
  <div class="form-group">
    <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">Images</label>
    <div class="dm-upload">
      <div class="dm-upload-avatar media-import dropzone-md-s">
        <p class="color-light mt-0 fs-14">Drop files here to upload</p>
      </div>
      <div class="avatar-up">
        <input type="file" name="images" class="upload-avatar-input" id="uploadInput" multiple accept="image/*">
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
                          <label for="a3" class="il-gray fs-14 fw-500 align-center mb-10">Document Name</label>
                          <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="titleOfDocument" placeholder="Enter Place Name">
                        </div>
                      </div>
                       <div class="col-md-12">
                        <div class="form-group">
                          <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">Documents</label>
                          <div class="dm-upload">
                            
                              <input type="file" name="documents">
                           
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgYKHZB_QKKLWfIRaYPCadza3nhTAbv7c"></script>
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
This version of the code ensures that the JavaScript function handles up to five uploaded images. Adjust the code as needed to fit your specific requirements.






</body>
</html>