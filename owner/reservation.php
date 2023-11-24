<?php
include('sidebar.php');
$listing_id = isset($_GET['listing_id']) ? $_GET['listing_id'] : null;
if(isset($_POST['approved']) || isset($_POST['rejected'])) {


    // Retrieve the listing_id from the POST data
    $application_id = $_POST['application_id'];

    // Determine the status based on the button clicked
    $status = isset($_POST['approved']) ? 'approved' : 'rejected';

    // Prepare and execute the SQL statement for updating the application status
    $sql = "UPDATE application SET status = ? WHERE application_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $application_id);

 

    // Execute the application status update
    if ($stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . $conn->error;
    }
}
if (isset($_POST['endstay'])) {
    $application_id = $_POST['application_id'];
    $sql = "UPDATE application SET status = ?, date_of_application = NOW() WHERE application_id = ?";
    $stmt = $conn->prepare($sql);
    $status = 'renter';
    $stmt->bind_param("si", $status, $application_id);
    $stmt->execute();
}
if (isset($_POST['void'])) {
    $application_id = $_POST['application_id'];
    $sql = "UPDATE application SET status = ?, date_of_application = NOW() WHERE application_id = ?";
    $stmt = $conn->prepare($sql);
    $status = 'rejected';
    $stmt->bind_param("si", $status, $application_id);
    $stmt->execute();
}
?>
<div class="contents">
  <div class="container-fluid">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-main">
            <h4 class="text-capitalize breadcrumb-title">Reservation</h4>
            <div class="breadcrumb-action justify-content-center flex-wrap">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Reservation</li>
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
        <h4>All Reservation</h4>
      </div>
      <div id="filter-form-container"></div>
      <table class="table mb-0  adv-table1"  data-filter-container="#filter-form-container" data-paging-current="1" data-paging-position="right" data-paging-size="10">
        <thead>
          <tr class="userDatatable-header">
        
            <th>
              <span class="userDatatable-title">NAME</span>
            </th>
            <th>
              <span class="userDatatable-title">Email  </span>
            </th>
          
         
            <th data-type="html" data-name="status">
              <span class="userDatatable-title">renting name</span>
            </th>
               <th>
              <span class="userDatatable-title">Reservation Status</span>
            </th>
            <th>
              <span class="userDatatable-title">View Payment</span>
            </th>
                <th>
              <span class="userDatatable-title">Tools</span>
            </th>
          </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT 
            c.email,
            a.tenant_id,
            t.name AS tenant_name,
            c.email AS tenant_email,
            a.status as status,
            l.listing_id,
            l.owner_id,
            l.listing_name,
            a.application_id,
            p.payment_id,
            a.date_of_application
        FROM application a
        LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
        LEFT JOIN credentials c ON t.user_id = c.user_id
        LEFT JOIN listing l ON l.listing_id = a.listing_id
        LEFT JOIN payment p ON a.application_id = p.application_id 
        WHERE l.owner_id = '$id'";

// Add WHERE clause only if $listing_id is set
if ($listing_id !== null) {
    $sql .= " AND l.listing_id = '$listing_id'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
         $applicationDate = strtotime($row["date_of_application"]);
        $currentDate = time();
        $threeDaysLater = strtotime('+3 days', $applicationDate);

        if ($currentDate > $threeDaysLater && $row["status"] != 'approved' && $row["status"] != 'rejected') {
            // Update the status to 'rejected'
            $applicationId = $row["application_id"];
            $updateStatusQuery = "UPDATE application SET status = 'rejected' WHERE application_id = '$applicationId'";
            $conn->query($updateStatusQuery);
            // Optionally, you can log or notify about the status change.
        }

        echo "<tr>";
        echo "<td><div class='userDatatable-content'>" . $row["email"] . "</div></td>";
        echo "<td><div class='userDatatable-content'>" . $row["tenant_name"] . "</div></td>";
        echo "<td><div class='userDatatable-content'>" . $row["listing_name"] . "</div></td>";
        echo "<td><div class='userDatatable-content'>" . $row["status"] . "</div></td>";

        if ($row["status"] == 'pending'  ) {
            echo "<td>
            <div class='userDatatable-content'>
            <a href='viewpayment.php?payment_id=" . $row['payment_id'] . "' class='edit'><i class='uil uil-eye'></i></a>
            </div>
            </td>
            <td>
            <div>
            <form action='' method='POST'>
                 <input type='hidden' value='" . $row["application_id"] . "' name='application_id'>
            <button type='submit' name='approved' value='approved' class='btn btn-success'>Approve</button>
            <button type='submit' name='rejected' value='rejected' class='btn btn-danger'>Reject</button>
            </form>
            </div>
            </td>";
        } elseif ($row["status"] == 'approved') {
            echo "<td>
            <div class='userDatatable-content'>
            <a href='viewpayment.php?payment_id=" . $row['payment_id'] . "' class='edit'><i class='uil uil-eye'></i></a>
            </div>
            </td>
            <td>
            <div class='userDatatable-content'>
               <form action='' method='POST'>
            <input type='hidden' value='" . $row["application_id"] . "' name='application_id'>
            <button type='submit' name='endstay' value='endstay' class='btn btn-success'>End Stay</button>
            <button type='submit' name='void' value='void' class='btn btn-danger'>Void</button>
            </form>
            </div>
            </td>";
        } elseif ($row["status"] == 'renter') {
            echo "<td><div class='userDatatable-content'>End of Stay :" . date("M, d, Y", strtotime($row["date_of_application"])) . "</div></td>";
        } else {
           echo "";
        }

        echo "</tr>";
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