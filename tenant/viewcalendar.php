<?php

include('sidebar.php');
   $listing_id = $_GET['listing_id'];
   if (isset($_POST['rentnow'])) {
    // Retrieve the listing_id and tenant_id from the POST data
    $listing_id = $_POST['listing_id'];

    $start_date = $_POST['start_date'];
     $end_date = $_POST['end_date'];
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
        $insert_sql = "INSERT INTO `application`(`tenant_id`, `listing_id`,`start_date`, `end_date`) VALUES (?, ?,?,?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iiss",$id, $listing_id,$start_date,$end_date);
        $insert_stmt->execute();
        echo '<script>window.location.href = "renter.php";</script>';
    }
}
?>

<div class="contents">
  <div class="container-fluid">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-main">
            <h4 class="text-capitalize breadcrumb-title">Calendar</h4>
            <div class="breadcrumb-action justify-content-center flex-wrap">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Calendar</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
           <div class="col-md-3">
      <div class="card card-default card-md mb-4">
               <div class="card-body">
    <form method="post">
        <input type="hidden" name="listing_id" value="<?php echo $listing_id; ?>">
        
        <div class="input-group mb-3">
            <label for="start_date" class="form-label m-2">Start Date</label>
            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Start Date"req style="background-color: transparent;" required>
        </div>

        <div class="input-group mb-3">
            <label for="end_date" class="form-label  m-2">End Date</label>
            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="End Date" style="background-color: transparent;"required>
        </div>

        <div class="input-group">
            <button type="submit" name="rentnow" class="btn btn-success fs-6 text-white btn-default btn-squared border-1=0 ms-0">Rent Now</button>
        </div>
    </form>
</div>

                </div>
      </div>
        <div class="col-md-9">
      <div class="card card-default card-md mb-4">
                  <div class="card-body">
                    <div id="full-calendar"></div>
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
    <?php 
    
    $sql = "SELECT 
    a.tenant_id,
    t.name AS tenant_name,
    a.status as status,
    l.listing_id,
    l.listing_name,
    l.rentprice,
    l.reservationfee,
    a.application_id,
    a.date_of_application,
    a.start_date,
    a.end_date
FROM application a
LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
LEFT JOIN listing l ON l.listing_id = a.listing_id
WHERE l.listing_id = '$listing_id' AND a.status = 'approved'";
$result = $conn->query($sql);
    ?>

<script>
    var eventsData = <?php echo json_encode($result->fetch_all(MYSQLI_ASSOC)); ?>;

    console.log("Events Data:", eventsData);

    function getColorBasedOnApplication(application_id) {
        // Assuming you have a predefined set of colors
        var colors = ['#FF33A1', '#3366FF', '#FF5733', '#FF33A1', '#33FFFF'];
        
        // Use the remainder of application_id to select a color
        var colorIndex = application_id % colors.length;

        console.log("Application ID:", application_id, "Color Index:", colorIndex);

        return colors[colorIndex];
    }

    !(function(t) {
        document.addEventListener("DOMContentLoaded", (function() {
            var l = document.getElementById("full-calendar");
            if (l) {
                var o = new FullCalendar.Calendar(l, {
                    headerToolbar: {
                        left: "today,prev,title,next"
                    },
                    views: {
                        listMonth: {
                            buttonText: "Schedule",
                            titleFormat: {
                                month: "short",
                                weekday: "short"
                            }
                        }
                    },
                    listDayFormat: true,
                    listDayAltFormat: true,
                    allDaySlot: false,
                    editable: false,  // Set to false to make the calendar not draggable
                    events: eventsData.map(function(event) {
                        return {
                            id: event.application_id,
                            title: event.listing_name,
                            start: event.start_date,
                            end: event.end_date,
                            color: getColorBasedOnApplication(event.application_id),
                            // Other event properties as needed
                        };
                    }),
                    contentHeight: 800,
                    initialView: "dayGridMonth",
                    eventDidMount: function(e) {
                        t(".fc-list-day").each((function() {}))
                    },
                    eventClick: function(e) {
                        console.log(e.event.title);
                        let n = t("#e-info-modal");
                        n.modal("show");
                        console.log(n.find(".e-info-title"));
                        n.find(".e-info-title").text(e.event.title);
                    }
                });
                o.render();
                t(".fc-button-group .fc-listMonth-button").prepend('<i class="las la-list"></i>')
            }
        }));
    }(jQuery));
</script>


  </body>

  
</html>