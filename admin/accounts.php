<?php
include('sidebar.php');
if (isset($_POST['user_id']) && isset($_POST['verify'])) {
    $user_id = $_POST['user_id'];
    $verify = $_POST['verify'];

    // Update isVerify in the credentials table
    $sql_update = "UPDATE credentials SET isVerify = '$verify' WHERE user_id = '$user_id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
if (isset($_POST['user_id']) && isset($_POST['unverify'])) {
    $user_id = $_POST['user_id'];
    $verify = $_POST['verify'];

    // Update isVerify in the credentials table
    $sql_update = "UPDATE credentials SET isVerify = '$verify' WHERE user_id = '$user_id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<div class="contents">
  <div class="container-fluid">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-main">
            <h4 class="text-capitalize breadcrumb-title">manage Accounts</h4>
            <div class="breadcrumb-action justify-content-center flex-wrap">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">manage Accounts</li>
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
        <h4>All Accounts</h4>
      </div>
      <div id="filter-form-container"></div>
      <table class="table mb-0 table-borderless adv-table1"  data-filter-container="#filter-form-container" data-paging-current="1" data-paging-position="right" data-paging-size="10">
        <thead>
          <tr class="userDatatable-header">
        
            <th>
              <span class="userDatatable-title">NAME</span>
            </th>
            <th>
              <span class="userDatatable-title">Email  </span>
            </th>
          
            <th data-type="html" data-name="position">
              <span class="userDatatable-title">Description</span>
            </th>
            <th data-type="html" data-name="status">
              <span class="userDatatable-title">status</span>
            </th>
            <th>
              <span class="userDatatable-title text-center ">action</span>
            </th>
          </tr>
        </thead>
        <tbody>
<?php

// SQL query
$sql = "SELECT 
            c.user_id,
            c.email,
            c.user_type,
            c.isVerify,
               r.id_picture,
            CASE
                WHEN r.user_id IS NOT NULL THEN r.name
                WHEN t.user_id IS NOT NULL THEN t.name
            END AS name
        FROM credentials c
        LEFT JOIN owner r ON c.user_id = r.user_id
        LEFT JOIN tenant t ON c.user_id = t.user_id 
        WHERE c.user_type != 'admin'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><div class='userDatatable-content'>" . $row["name"] . "</div></td>";
        echo "<td><div class='d-flex'><div class='userDatatable-inline-title'><a href='#' class='text-dark fw-500'><h6>" . $row["email"] . "</h6></a></div></div></td>";
        echo "<td><div class='userDatatable-content'>" . $row["user_type"] . "</div></td>";
        if ($row["isVerify"] == 0) {
            echo "<td><div class='userDatatable-content d-inline-block'><span class='bg-opacity-warning  color-warning rounded-pill userDatatable-content-status active'>pending</span></div></td>";
        } else {
            echo "<td><div class='userDatatable-content d-inline-block'><span class='bg-opacity-success  color-success rounded-pill userDatatable-content-status active'>active</span></div></td>";
        }
        echo "<td>
        <ul >
                <form action='' method='post'>
                    <input type='hidden' name='user_id' value='" . $row["user_id"] . "'>
                    <button type='submit' name='verify' value='1' class='btn btn-primary btn-default btn-rounded btn-transparent-primary '><i class='uil uil-check'></i></button>
                    <button type='submit' name='unverify' value='0'  class='btn btn-primary btn-default btn-rounded btn-transparent-primary '><i class='uil uil-trash'></i></button> ";

        if ($row["user_type"] == 'owner') {
            echo "<button type='button' class='btn btn-primary btn-default btn-rounded btn-transparent-primary ' data-bs-toggle='modal' data-bs-target='#ownerModal" . $row["user_id"] . "'><i class='uil uil-eye'></i></button>";
        }
        
        echo "</form>
            </li>
        </ul>
    </td>
    <div class='modal fade' id='ownerModal" . $row["user_id"] . "' tabindex='-1' role='dialog' aria-labelledby='ownerModalLabel' aria-hidden='true'>
     <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='ownerModalLabel'>Owner ID picture</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
            <div class='text-center' style='width:50%;'>
             <img src='../uploads/". $row['id_picture'] ."' width='400'>
              </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>
    
    ";

        echo "</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
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