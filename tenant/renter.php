<?php
include('sidebar.php');

    if (isset($_GET['application_id'])) {
    $application_id = $_GET['application_id'];
    $payment_date = date('Y-m-d'); // Current date

 
    $stmt = $conn->prepare("INSERT INTO payment (application_id, payment_date) VALUES (?, ?)");
    $stmt->bind_param("is", $application_id, $payment_date);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}
if (isset($_POST['add_feedback'])) {
    $listing_id = $_POST['listing_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO review (tenant_id, rating, feedback, listing_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $id, $rating, $feedback, $listing_id);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}


?>

<div class="contents">
  <div class="container-fluid">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-main">
            <h4 class="text-capitalize breadcrumb-title">Renter</h4>
            <div class="breadcrumb-action justify-content-center flex-wrap">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Renter</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
          <div class="card-body">
  <div class="userDatatable adv-table-table global-shadow border-light-0 w-100 adv-table">
    <div class="table-responsive">
      <div class="adv-table-table__header">
        <h4>My renter</h4>
      </div>
      <div id="filter-form-container"></div>
      <table class="table mb-0 table-borderless adv-table1"  data-filter-container="#filter-form-container" data-paging-current="1" data-paging-position="right" data-paging-size="10">
        <thead>
          <tr class="userDatatable-header">
        
            <th>
              <span class="userDatatable-title">Owner Name</span>
            </th>
            <th>
              <span class="userDatatable-title">Email  </span>
            </th>
          
         
            <th data-type="html" data-name="status">
              <span class="userDatatable-title">renting name</span>
            </th>
              <th>
              <span class="userDatatable-title ">payment</span>
            </th>
            <th>
              <span class="userDatatable-title ">action</span>
            </th>
          </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT 
            c.email,
            a.tenant_id,
            t.name AS tenant_name,
                o.name AS owner_name,
            c.email AS tenant_email,
            a.status as status,
            l.listing_id,
            l.listing_name,
            l.rentprice,
            l.reservationfee,
            a.application_id,
            a.date_of_application
        FROM application a
        LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
        LEFT JOIN listing l ON l.listing_id = a.listing_id
        LEFT JOIN Owner o ON l.owner_id = o.owner_id
       LEFT JOIN credentials c ON o.user_id = c.user_id
        WHERE a.tenant_id = '$id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
                echo "<td><div class='userDatatable-content'>" . $row["owner_name"] . "</div></td>";
        echo "<td><div class='userDatatable-content'>" . $row["email"] . "</div></td>";

        echo "<td><div class='userDatatable-content'>" . $row["listing_name"] . "</div></td>";



        $payment_sql = "SELECT * FROM payment WHERE application_id = '" . $row["application_id"] . "'";
        $payment_result = $conn->query($payment_sql);
            if ($payment_result->num_rows > 0) {
            echo "<td>
                <div class='userDatatable-content'>paid </div>
            </td>
         ";
           
        
        } else {
            echo "<td>
                <div class='userDatatable-content'>Not paid</div>
            </td>";
        }
   

        if ($row["status"] == "renter") {
          // Check if there is an existing review for this tenant and listing
          $existingReviewSql = "SELECT * FROM review WHERE tenant_id = ? AND listing_id = ?";
          $existingReviewStmt = $conn->prepare($existingReviewSql);
          $existingReviewStmt->bind_param("ii", $id, $row["listing_id"]);
          $existingReviewStmt->execute();
          $existingReviewResult = $existingReviewStmt->get_result();
          $existingReviewCount = $existingReviewResult->num_rows;
      
          if ($existingReviewCount > 0) {
              // Existing review found, disable the button
              echo '<td>
                  <button type="button" class="btn btn-primary" disabled>
                      Add Review
                  </button>
              </td>';
          } else {
              // No existing review, enable the button
              echo '<td>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal' . $row["application_id"] . '">
                      Add Review
                  </button>
              </td>';
          }
      
          $existingReviewStmt->close();
      } else {
        
if ($row["status"] == "renter") {
    // Check if there is an existing review for this tenant and listing
    $existingReviewSql = "SELECT * FROM review WHERE tenant_id = ? AND listing_id = ?";
    $existingReviewStmt = $conn->prepare($existingReviewSql);
    $existingReviewStmt->bind_param("ii", $id, $row["listing_id"]);
    $existingReviewStmt->execute();
    $existingReviewResult = $existingReviewStmt->get_result();
    $existingReviewCount = $existingReviewResult->num_rows;

    if ($existingReviewCount > 0) {
        // Existing review found, disable the button
        echo '<td>
            <button type="button" class="btn btn-primary" disabled>
                Add Review
            </button>
        </td>';
    } else {
        // No existing review, enable the button
        echo '<td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal' . $row["application_id"] . '">
                Add Review
            </button>
        </td>';
    }

    
} else {
}
    $reservation_fee_in_whole_number = $row["reservationfee"] * 100;
if ($payment_result->num_rows > 0) {
 echo '<td>
        <form action="payment.php" method="POST">
            <input type="hidden" name="application_id" value="' . $row["application_id"] . '">';
    echo '<input type="hidden" name="amount" value="' . $reservation_fee_in_whole_number . '">
        <button type="submit" name="pay" class="btn btn-primary" disabled>Make Payment</button>
        </form>
    </td>';
}else{
echo '<td>
        <form action="payment.php" method="POST">
            <input type="hidden" name="application_id" value="' . $row["application_id"] . '">';
echo '<input type="hidden" name="amount" value="' . $reservation_fee_in_whole_number . '">
        <button type="submit" name="pay" class="btn btn-primary" >Make Payment</button>
        </form>
    </td>';

}

}
        echo "</tr>";

        echo '

<div class="modal fade" id="reviewModal' . $row["application_id"] . '" tabindex="-1" aria-labelledby="reviewModal' . $row["application_id"] . 'Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModal' . $row["application_id"] . 'Label">Leave a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">   
                <div class="modal-body">
                    <div class="new-member-modal">
                        <div class="form-group mb-20">
                            <input type="hidden" class="form-control" name="listing_id" value="' . $row["listing_id"] . '">
                            
                            <!-- Rating for Amenities -->
                            <label for="rating_amenities" class="il-gray fs-14 fw-500 align-center mb-10">Amenities</label>
                            <input type="number" class="form-control" min="1" max="5" name="rating_amenities" placeholder=" Rating">
                            
                           <!-- Rating for Price -->
<label for="rating_price" class="il-gray fs-14 fw-500 align-center mb-10">Price</label>
<input type="number" class="form-control" min="1" max="5" name="rating_price" placeholder=" Rating">

<!-- Rating for Location -->
<label for="rating_location" class="il-gray fs-14 fw-500 align-center mb-10">Location</label>
<input type="number" class="form-control" min="1" max="5" name="rating_location" placeholder=" Rating">

<!-- Rating for Cleanliness -->
<label for="rating_cleanliness" class="il-gray fs-14 fw-500 align-center mb-10">Cleanliness</label>
<input type="number" class="form-control" min="1" max="5" name="rating_cleanliness" placeholder=" Rating">

<!-- Rating for Safety -->
<label for="rating_safety" class="il-gray fs-14 fw-500 align-center mb-10">Safety</label>
<input type="number" class="form-control" min="1" max="5" name="rating_safety" placeholder=" Rating">


                            <div class="form-group mt-3">
                                <textarea class="form-control" name="feedback" rows="3" placeholder="Feedback...."></textarea>
                            </div>
                        </div>
                        <div class="button-group d-flex pt-25">
                            <button type="submit" name="add_feedback" class="btn btn-primary btn-default btn-squared text-capitalize">Add</button>
                            <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

';

    }
}

?>


        </tbody>
      </table>
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
    <script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    var stripe = Stripe('pk_test_51Nzrf4Id5WzwE9nmz6QQ06udHZ3k7wucYVgtgA3mWIkkqChWzAg9HizLVyN3Fuc2c7b4UBjx46kt7tpLBHddjxDf00CmqhIZOu');
    var checkoutButton = document.getElementById('customButton');

    checkoutButton.addEventListener('click', function () {
        stripe.redirectToCheckout({
            items: [{ sku: 'sku_123', quantity: 1 }], // Replace with your own SKU
            successUrl: 'https://your-website.com/success',
            cancelUrl: 'https://your-website.com/cancel',
        });
    });
</script>
<script>
    $((function() {
        $(".adv-table1").footable({
            filtering: {
                enabled: !0
            },
            paging: {
                enabled: !0,
                current: 1
            },
            strings: {
                enabled: !1
            },
            filtering: {
                enabled: !0
            },
            components: {
                filtering: FooTable.MyFiltering
            }
        })
    })),
    FooTable.MyFiltering = FooTable.Filtering.extend({
        construct: function(t) {
            this._super(t);
            this.jobTitles = ["Active", "Pending", "Rejected"];
            this.jobTitleDefault = "All";
            this.$jobTitle = null;
        },
        $create: function() {
            this._super();
            var t = this,
                s = $("<div/>", {
                    class: "form-group dm-select d-flex align-items-center adv-table-searchs__status my-xl-25 my-15 mb-0 me-sm-30 me-0"
                }).append($("<label/>", {
                    class: "d-flex align-items-center mb-sm-0 mb-2",
                    text: "Status"
                })).prependTo(t.$form);
            t.$jobTitle = $("<select/>", {
                class: "form-control ms-sm-10 ms-0"
            }).on("change", {
                self: t
            }, t._onJobTitleDropdownChanged).append($("<option/>", {
                text: t.jobTitleDefault
            })).appendTo(s);
            $.each(t.jobTitles, (function(e, s) {
                t.$jobTitle.append($("<option/>").text(s));
            }));
        },
        _onJobTitleDropdownChanged: function(t) {
            var e = t.data.self,
                s = $(this).val();
            s !== e.jobTitleDefault ? e.addFilter("status", s, ["status"]) : e.removeFilter("status");
            e.filter();
        },
        draw: function() {
            this._super();
            var e = this.find("status");
            e instanceof FooTable.Filter ? this.$jobTitle.val(e.query.val()) : this.$jobTitle.val(this.jobTitleDefault);
        }
    });
</script>



  </body>

  
</html>