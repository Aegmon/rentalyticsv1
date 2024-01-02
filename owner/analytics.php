<?php
include('sidebar.php');
$owner_male_result = $conn->query("SELECT COUNT(*) as male_count FROM owner WHERE gender = 'Male'");
$owner_female_result = $conn->query("SELECT COUNT(*) as female_count FROM owner WHERE gender = 'Female'");

$owner_male_count = $owner_male_result->fetch_assoc()['male_count'];
$owner_female_count = $owner_female_result->fetch_assoc()['female_count'];

$tenant_male_result = $conn->query("SELECT COUNT(*) as male_count FROM tenant WHERE gender = 'Male'");
$tenant_female_result = $conn->query("SELECT COUNT(*) as female_count FROM tenant WHERE gender = 'Female'");

$tenant_male_count = $tenant_male_result->fetch_assoc()['male_count'];
$tenant_female_count = $tenant_female_result->fetch_assoc()['female_count'];

// Calculate the total sum
$total_male_count = $tenant_male_count;
$total_female_count = $tenant_female_count;



$dateToday = Date('Y / m / d');

// Calculate the first day of the previous month
$firstDayOfPreviousMonth = date('Y-m-01', strtotime('-1 month'));

// Calculate the last day of the previous month
$lastDayOfPreviousMonth = date('Y-m-t', strtotime('-1 month'));
// SQL query to select data from the previous month
$query = "SELECT COUNT(*) as approved_previous 
          FROM application 
          WHERE status = 'approved' 
          AND date_of_application >= '$firstDayOfPreviousMonth' 
          AND date_of_application <= '$lastDayOfPreviousMonth'";

$approvedPrev = $conn->query($query);
//rejected prev
$query = "SELECT COUNT(*) as rejected_previous 
          FROM application 
          WHERE status = 'rejected' 
          AND date_of_application >= '$firstDayOfPreviousMonth' 
          AND date_of_application <= '$lastDayOfPreviousMonth'";

$rejectedPrev = $conn->query($query);

$previousApproved = $approvedPrev->fetch_assoc()['approved_previous'];
$previousRejected = $rejectedPrev->fetch_assoc()['rejected_previous'];


$totalPrev_reserve_count = $previousApproved + $previousRejected;


$currentMonth = date('Y-m'); // Get the current month in the format 'YYYY-MM'

$query = "SELECT COUNT(*) as approved_counts 
          FROM application 
          WHERE status = 'approved' 
          AND DATE_FORMAT(date_of_application, '%Y-%m') = '$currentMonth'";

$approvedCount = $conn->query($query);

$query = "SELECT COUNT(*) as rejected_counts 
          FROM application 
          WHERE status = 'rejected' 
          AND DATE_FORMAT(date_of_application, '%Y-%m') = '$currentMonth'";

$rejectedCount = $conn->query($query);
$query = "SELECT COUNT(*) as renter_counts 
          FROM application 
          WHERE status = 'renter' 
          AND DATE_FORMAT(date_of_application, '%Y-%m') = '$currentMonth'";

$renterCount = $conn->query($query);


$approved = $approvedCount->fetch_assoc()['approved_counts'];
$rejected = $rejectedCount->fetch_assoc()['rejected_counts'];
$renter = $renterCount->fetch_assoc()['renter_counts'];

$total_approved_count = $approved;
$total_reserved_count = $approved + $rejected;



$result = $conn->query("SELECT SUM(CASE WHEN gender_req = 'Male' THEN 1 ELSE 0 END) as male_listing_count,
                              SUM(CASE WHEN gender_req = 'Female' THEN 1 ELSE 0 END) as female_listing_count,
                          SUM(CASE WHEN gender_req = 'Both' THEN 1 ELSE 0 END) as both_listing_count
                        FROM listing");

// Fetch the result
$row = $result->fetch_assoc();
$total_male_listing_count = $row['male_listing_count'];
$total_female_listing_count = $row['female_listing_count'];
$total_both_listing_count = $row['both_listing_count'];


$result = $conn->query("SELECT type, gender_req, COUNT(*) as gender_count 
                        FROM listing 
                        GROUP BY type, gender_req");

// Initialize variables
$gender_counts = array();

// Fetch the result and store it in a variable
while ($row = $result->fetch_assoc()) {
    $type = $row['type'];
    $gender_req = $row['gender_req'];
    $count = $row['gender_count'];
    if (!isset($gender_counts[$type])) {
        $gender_counts[$type] = array();
    }
    $gender_counts[$type][$gender_req] = $count;
}

if (isset($gender_counts['boarding_house'])) {
    $total_male_boarding_house_count = isset($gender_counts['boarding_house']['Male']) ? $gender_counts['boarding_house']['Male'] : 0;
    $total_female_boarding_house_count = isset($gender_counts['boarding_house']['Female']) ? $gender_counts['boarding_house']['Female'] : 0;
    $total_both_boarding_house_count = isset($gender_counts['boarding_house']['Both']) ? $gender_counts['boarding_house']['Both'] : 0;
}

if (isset($gender_counts['apartment'])) {
    $total_male_apartment_count = isset($gender_counts['apartment']['Male']) ? $gender_counts['apartment']['Male'] : 0;
    $total_female_apartment_count = isset($gender_counts['apartment']['Female']) ? $gender_counts['apartment']['Female'] : 0;
    $total_both_apartment_count = isset($gender_counts['apartment']['Both']) ? $gender_counts['apartment']['Both'] : 0;
}

if (isset($gender_counts['dormitory'])) {
    $total_male_dormitory_count = isset($gender_counts['dormitory']['Male']) ? $gender_counts['dormitory']['Male'] : 0;
    $total_female_dormitory_count = isset($gender_counts['dormitory']['Female']) ? $gender_counts['dormitory']['Female'] : 0;
    $total_both_dormitory_count = isset($gender_counts['dormitory']['Both']) ? $gender_counts['dormitory']['Both'] : 0;
}

if (isset($gender_counts['bedspace'])) {
    $total_male_bedspace_count = isset($gender_counts['bedspace']['Male']) ? $gender_counts['bedspace']['Male'] : 0;
    $total_female_bedspace_count = isset($gender_counts['bedspace']['Female']) ? $gender_counts['bedspace']['Female'] : 0;
    $total_both_bedspace_count = isset($gender_counts['bedspace']['Both']) ? $gender_counts['bedspace']['Both'] : 0;
}
$total_boarding_house_count = isset($gender_counts['boarding_house']) ? array_sum($gender_counts['boarding_house']) : 0;
$total_apartment_count = isset($gender_counts['apartment']) ? array_sum($gender_counts['apartment']) : 0;
$total_dormitory_count = isset($gender_counts['dormitory']) ? array_sum($gender_counts['dormitory']) : 0;
$total_bedspace_count = isset($gender_counts['bedspace']) ? array_sum($gender_counts['bedspace']) : 0;
?>
<?php
// Get the current month and year
// $currentMonth = date('m');
// $currentYear = date('Y');

// $sql1 = "SELECT 
//             MONTH(a.date_of_application) AS month,
//             COUNT(*) AS total,
//             SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS approved,
//             SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
//             SUM(CASE WHEN a.status = 'renter' THEN 1 ELSE 0 END) AS renter
//         FROM application a
//         LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
//         LEFT JOIN credentials c ON t.user_id = c.user_id
//         LEFT JOIN listing l ON l.listing_id = a.listing_id
//         LEFT JOIN payment p ON a.application_id = p.application_id
//         WHERE l.owner_id = '$id' 
//         AND a.status IN ('approved', 'rejected', 'renter')
//         AND MONTH(a.date_of_application) = '$currentMonth'
//         AND YEAR(a.date_of_application) = '$currentYear'
//         GROUP BY month
//         ORDER BY month";

// // Execute the SQL query
// $result1 = mysqli_query($conn, $sql1);


// $success_count = 0; // Variable to store the count of approved applications
// $total_count = 0; // Variable to store the total number of applications this month

// while ($row1 = mysqli_fetch_assoc($result1)) {
 
    
//     // Update the total count
//     $total_count += $row1['total'];
    
//     // Update the success count for approved applications
//     $success_count += $row1['approved'];
// }

// $rate = ($success_count / $total_count )*100;
?>




<div class="contents">
  <div class="container-fluid mb-4">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-main">
            <h4 class="text-capitalize breadcrumb-title">Analytics</h4>
            <div class="breadcrumb-action justify-content-center flex-wrap">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
  <div class="row mb-4">
        <div class="col-md-12">
          <div class="card">
          <div class="card-body">
            <div class="row">
                   <!-- <div class="mb-4">
   Monthyl Success Rate : <strong style="color: lightgreen"><?php echo $rate ; ?>%</strong>
    </div> -->
    <div class="mb-4">
      <!-- <div class="d-flex justify-content-end">
      <select id="yearDropdown">
        <option value="" selected disabled>Select Year</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
      </select>
      </div> -->
      <div class="text-end">
       
      <p><?php echo "Date Today: " . '<span class="color-dark">'. $dateToday . '</span>'?></p>
      </div>



        <?php

// Function to percentage

function successRatio($approved, $total_reserved_count)
{
    if ($total_reserved_count != 0) {
        $percentage = ($approved/$total_reserved_count) * 100;
        return $percentage;
    } else {
        return 0; // Avoid division by zero error
    }
    
}
$rationReserved = $approved;  // the actual amount
$rationTotal = $total_reserved_count;     // total available amount

// Calculate percentage
$successPercentage = successRatio($rationReserved, $rationTotal);

//change color base on percentage 
$textColor = '';
$arrowSymbol = '';

if($successPercentage == 0){
  $textColor = 'black';
  $arrowSymbol = '';
}elseif ($successPercentage > 35) {
    $textColor = 'green';
    $arrowSymbol = ' &#8593;'; // Up arrow symbol
} elseif ($successPercentage < 35) {
    $textColor = 'red';
    $arrowSymbol = ' &#8595;'; // Down arrow symbol
}
?>
<?php

// Function to percentage now

function prevRatio($previousApproved, $totalPrev_reserve_count)
{
    if ($totalPrev_reserve_count != 0) {
        $percentagePrev = ($previousApproved/$totalPrev_reserve_count) * 100;
        return $percentagePrev;
    } else {
        return 0; // Avoid division by zero error
    }
    
}
$rationReservedPrev = $previousApproved;  // the actual amount
$rationTotalPrev = $totalPrev_reserve_count;     // total available amount

// Calculate percentage
$successPercentagePrev = prevRatio($rationReservedPrev, $rationTotalPrev);

//change color base on percentage 
$textColor1 = '';
$arrowSymbol1 = '';

if ($successPercentagePrev == 0) {
  $textColor1 = '#666d92';
  $arrowSymbol1 = ''; // Up arrow symbol
} elseif ($successPercentagePrev < 35) {
  $textColor1 = 'red';
  $arrowSymbol1 = ' &#8595;'; // Down arrow symbol
} elseif ($successPercentagePrev > 35) {
  $textColor1 = 'green';
  $arrowSymbol1 = ' &#8593;'; // Up arrow symbol
}

// ratio
function ratioGap($successPercentagePrev,$successPercentage){

  if($successPercentagePrev !=0 ){
    $precentGap = ($successPercentage - $successPercentagePrev );
    return $precentGap;
  }else{
    return 0;
  }
} 

$prev = $successPercentagePrev;
$now = $successPercentage;

$gapRatio = ratioGap($prev,$now);

$textColor2 = '';
$arrowSymbol2 = '';

if ($gapRatio > 0) {
    $textColor2 = 'green';
    $arrowSymbol2 = ' &#8593;'; // Up arrow symbol
} elseif ($gapRatio < 0) {
    $textColor2 = 'red';
    $arrowSymbol2 = ' &#8595;'; // Down arrow symbol
}
?>

        <div class="text-center">
          <h4><?php echo "Successful Reservation Rate: ". '<span style="color: ' . $textColor . '";>' . number_format($successPercentage, 2) . "%" .$arrowSymbol. '</span>';?> <span style="font-size: 16px; margin:20px 0 0 5px;"><?php echo '<span style="color: ' . $textColor2 . '";>' . number_format( $gapRatio, 2) . "%" .$arrowSymbol2.  '</span>';?>
</span>
</h4>
</div>
          
          <!-- <div class="text-center"> -->
   
          
          
  
    <!-- </div> -->
    </div>


<!-- prev data -->

<div class="text-center">
<span><?php echo "Previous Month Success Rate: ". '<span style="color: ' . $textColor1 . '";>' . number_format($successPercentagePrev, 2) . "%" .$arrowSymbol1.  '</span>';?>
</span>
</div>

    

<div class="col-lg-12 mb-4">
  <div class="card">
 
        <div id="multiline"></div>
 
  
  </div>
</div>





            </div>
          </div>
        </div>
      </div>


      
    </div>


      <div class="row">
        <div class="col-md-12">
          <div class="card">
          <div class="card-body">
            <div class="row">
                   <div class="mb-4">
   Segmentation of gender
    </div>
<div class="col-lg-4 mb-4">
  <div class="card">
  <div class="card-header">Renter Gender Segmentation</div>

  
        <div id="chart"></div>
 
  
  </div>
</div>
<div class="col-lg-4 mb-4">
  <div class="card">
  <div class="card-header">Number of rental places that accept only specific gender</div>

  
        <div id="chart1"></div>
 
  
  </div>
</div>
<div class="col-sm-3 mb-4">
  <div class="card">
  <div class="card-header">Boarding house</div>

  
        <div id="chart2"></div>
 
  
  </div>
</div>
<div class="col-lg-4 mb-4">
  <div class="card">
  <div class="card-header">Bed Space</div>

  
        <div id="chart3"></div>
 
  
  </div>
</div>
<div class="col-lg-4 mb-4">
  <div class="card">
  <div class="card-header">Dormitory</div>

  
        <div id="chart4"></div>
 
  
  </div>
</div>
<div class="col-lg-4 mb-4">
  <div class="card">
  <div class="card-header">Apartment</div>

  
        <div id="chart5"></div>
 
  
  </div>
</div>
            </div>
          </div>
        </div>
      </div>


      
    </div>
  </div>
</div>
<div class="row">
        <div class="col-md-12">
          <div class="card">
          <div class="card-body">
            <div class="row">
                   <div class="mb-4">
   Competition
    </div>
<div class="col-lg-12 mb-4">
  <div class="card">
  <div class="card-header">Registered Property Types</div>

  
        <div id="chartline"></div>
 
  
  </div>
</div>
<!-- <div class="col-lg-12 mb-4">
  <div class="card">
  <div class="card-header">TreeMap</div>

  <div id="charttreemap"></div>
  
  </div>
</div> -->
            </div>
          </div>
        </div>
      </div>


      
    </div>


<div class="container-fluid">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
        
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
          <div class="card-body">
            <div class="row">
                   <div class="mb-4 d-flex flex-row justify-content-between">
   <!-- <div>Rental Statistics</div> -->
   <div>


   </div>
    </div>
<div class="col-lg-12 mb-4">
  <div class="card">

  <div class="card-header">Customer Preferences</div>

   <!-- <div id="chartbar"></div> -->
 
  
  </div>
</div>
<div class="row d-flex justify-content-around">
<div class="col-lg-3 mb-4">
  <div class="card">

  <div id="chartBed"></div>
  
  </div>
</div>

<div class="col-sm-3 mb-4">
  <div class="card">

  <div id="chartBathroom"></div>
  
  </div>
</div>
<div class="col-sm-3 mb-4">
  <div class="card">

  <div id="chartPrice"></div>
  
  </div>
</div>
</div>
<div class="row d-flex justify-content-around">
<div class="col-sm-3 mb-4">
  <div class="card">

  <div id="chartOther"></div>
  
  </div>
</div>
<div class="col-sm-3 mb-4">
  <div class="card">

  <div id="chartBarangay"></div>
  
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

<div class="container-fluid">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
        
        </div>
      </div>
    
  </div>
</div>
<div class="container-fluid mt-3">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
        
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
          <div class="card-body">
            <div class="row">
                   <div class="mb-4">
GIS
    </div>
<div class="col-lg-12 mb-4">
  <div class="card">
   	<div id="map" style="width: 100%; height: 50vh;"></div>
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
        
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
function initMap() {
  // Define the center variable with appropriate latitude and longitude values
  var center = { lat: 15.4755, lng: 120.5963 }; // Update with actual coordinates

  var map = new google.maps.Map(document.getElementById('map'), {
    center: center,
    zoom: 12,
  });

  var locations = [
    <?php
    $sql = "SELECT * FROM listing where owner_id = $id";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
      echo '["Place Name: ' . $row['listing_name'] . '\n' . "Reservation Fee: " . $row['reservationfee'] . '",' . $row['lat'] . ',' . $row['lng'] . '],';
    }
    ?>
  ];

  var locations2 = [
    <?php
    $sql = "SELECT * FROM listing ";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
      echo '["Place Name: ' . $row['listing_name'] . '\n' . "Reservation Fee: " . $row['reservationfee'] . '",' . $row['lat'] . ',' . $row['lng'] . '],';
    }
    ?>
  ];

  // Create an array to store all markers
  var allMarkers = [];

  // Add markers for the first array (locations) and store them in allMarkers array
  for (var i = 0; i < locations.length; i++) {
    var location = new google.maps.LatLng(locations[i][1], locations[i][2]);
    var mark = new google.maps.Marker({
      position: location,
      map: map,
      animation: google.maps.Animation.DROP,
      title: locations[i][0],
    });
    allMarkers.push(mark);

    // Create a geofence for each marker in locations
    var geofence = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center: location,
      radius: 600, // 300 meters
    });
  }

  // Add markers for the second array (locations2) and store them in allMarkers array
  for (var i = 0; i < locations2.length; i++) {
    var location = new google.maps.LatLng(locations2[i][1], locations2[i][2]);
    var mark = new google.maps.Marker({
      position: location,
      map: map,
      animation: google.maps.Animation.DROP,
      title: locations2[i][0],
    });
    allMarkers.push(mark);
  }
}
</script>

 
    
    
    </script>
 
    
   <!-- <?php
$sql = "SELECT address2, type, COUNT(*) as type_count 
        FROM listing 
        GROUP BY address2, type";

$result = $conn->query($sql);


$gender_counts = array();


while ($row = $result->fetch_assoc()) {
    $type = $row['type'];
    $address2 = $row['address2'];
    $count = $row['type_count'];

    if (!isset($gender_counts[$type])) {
        $gender_counts[$type] = array();
    }

    $gender_counts[$type][$address2] = $count;
}


$series = array();
foreach ($gender_counts as $type => $typeData) {
    $productData = array_values($typeData); 
    

    $series[] = array(
        'name' => $type,
        'data' => $productData,
    );
}


$options = array(
    'series' => $series,
    'chart' => array(
        'type' => 'bar',
        'height' => 350,
        'stacked' => true,
        'toolbar' => array(
            'show' => true
        ),
        'zoom' => array(
            'enabled' => true
        )
    ),
    'responsive' => array(
        array(
            'breakpoint' => 480,
            'options' => array(
                'legend' => array(
                    'position' => 'bottom',
                    'offsetX' => -10,
                    'offsetY' => 0
                )
            )
        )
    ),
    'plotOptions' => array(
        'bar' => array(
            'horizontal' => false,
            'borderRadius' => 10,
            'dataLabels' => array(
                'total' => array(
                    'enabled' => true,
                    'style' => array(
                        'fontSize' => '13px',
                        'fontWeight' => 900
                    )
                )
            )
        ),
    ),
    'xaxis' => array(
        'categories' => array_keys(reset($gender_counts)),
    ),
    'legend' => array(
        'position' => 'right',
        'offsetY' => 40
    ),
    'fill' => array(
        'opacity' => 1
    )
);


?> -->
<!-- <script>
        var options = <?php echo json_encode($options); ?>;
        var chart = new ApexCharts(document.querySelector("#chartbar"), options);
        chart.render();
    </script> -->
<script>
  
  var options = {
    series: [{
      data: [<?php echo $total_apartment_count ?>, <?php echo  $total_dormitory_count ?>, <?php echo  $total_bedspace_count ?>, <?php echo  $total_boarding_house_count ?>]
    }],
    chart: {
      height: 350,
      type: 'bar',
      events: {
        click: function (chart, w, e) {
          // console.log(chart, w, e)
        }
      }
    },
    colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560'],
    plotOptions: {
      bar: {
        borderRadius: 5,
        columnWidth: '45%',
        distributed: true,
      }
    },
    dataLabels: {
      enabled: false
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: [
        'Apartment',
        'Dormitory',
        'Bed Space',
        'Boarding House',
      ],
      labels: {
        style: {
          colors: '#000',
          fontSize: '18px'
        }
      }
    },
    yaxis: {
      labels: {
        formatter: function (val) {
          return Math.round(val);
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chartbar"), options);
  chart.render();

</script>

          <script>
  
        // var colors = ['#26a0fc','#00E396']
        var options = {
          series: [<?php echo $total_male_count?>, <?php echo $total_female_count?>],
          chart: {
          width: 380,
          type: 'donut',
        },
        labels: ['Male', 'Female'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    </script>
              <script>
      // var colors = ['#26a0fc','#00E396', '#ffe15d']
        var options = {
          series: [<?php echo $total_male_listing_count ;?>, <?php echo $total_female_listing_count ;?>,<?php echo $total_both_listing_count ;?>],
          chart: {
          width: 380,
          type: 'donut',
        },
        labels: ['Male', 'Female', 'Both'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 180
            },
            legend: {
              position: 'bottom',
              
            },
           
        }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
      
      
    </script>
         <script>
      // var colors = ['#26a0fc','#00E396', '#ffe15d']
      
        var options = {
          series: [<?php echo $total_male_boarding_house_count ;?>, <?php echo $total_female_boarding_house_count ;?>,<?php echo $total_both_boarding_house_count ;?>],
          chart: {
          width: 380,
          type: 'donut',
        },
        labels: ['Male', 'Female', 'Both'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
      
      
    </script>
         <script>
      // var colors = ['#26a0fc','#00E396', '#ffe15d']
      
        var options = {
         series: [<?php echo $total_male_bedspace_count ;?>, <?php echo $total_female_bedspace_count ;?>,<?php echo $total_both_bedspace_count ;?>],
          chart: {
          width: 380,
          type: 'donut',
        },
        labels: ['Male', 'Female', 'Both'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom',
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();
      
      
    </script>
         <script>
      // var colors = ['#26a0fc','#f41fad', '#ffe15d']
      
        var options = {
           series: [<?php echo $total_male_dormitory_count ;?>, <?php echo $total_female_dormitory_count ;?>,<?php echo $total_both_dormitory_count ;?>],
          chart: {
          width: 380,
          type: 'donut',
        },
        labels: ['Male', 'Female', 'Both'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart4"), options);
        chart.render();
      
      
    </script>
         <script>
      var colors = ['#26a0fc','#f41fad', '#ffe15d']
      
        var options = {
          series: [<?php echo $total_male_apartment_count;?>, <?php echo $total_female_apartment_count ;?>,<?php echo $total_both_apartment_count ;?>],
          
          chart: {
          width: 380,
          type: 'donut',
        },
        labels: ['Male', 'Female', 'Both'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart5"), options);
        chart.render();
      
      
    </script>

  <!-- pricing -->
<?php

$query = "SELECT type, rentprice FROM listing where isVerify = 'Verify'";
$result = mysqli_query($conn, $query);

$rentPrices = array();
while ($row = mysqli_fetch_assoc($result)) {
    $type = $row['type'];
    $rentPrice = $row['rentprice'];
    if (!array_key_exists($type, $rentPrices)) {
        $rentPrices[$type] = array();
    }
    $rentPrices[$type][] = $rentPrice;
}

// Prepare the data array for the chart
$categories = array();
$seriesData = array();
foreach ($rentPrices as $type => $prices) {
    $categories[] = $type;
    $averageRentPrice = array_sum($prices) / count($prices);
    $seriesData[] = round($averageRentPrice, 2);
}
?>

<?php
// Function to format the type strings
function formatType($type)
{
    $formattedType = str_replace("_", " ", $type);
    $formattedType = ucwords($formattedType);
    return $formattedType;
}

// Assuming you have already established a database connection
// Execute the SQL query to fetch rent prices per type
$query = "SELECT type, rentprice FROM listing";
$result = mysqli_query($conn, $query);

// Initialize an associative array to store rent prices for each type
$rentPrices = array();
while ($row = mysqli_fetch_assoc($result)) {
    $type = formatType($row['type']);
    $rentPrice = $row['rentprice'];
    if (!array_key_exists($type, $rentPrices)) {
        $rentPrices[$type] = array();
    }
    $rentPrices[$type][] = $rentPrice;
}

// Prepare the data array for the chart
$categories = array();
$seriesData = array();
foreach ($rentPrices as $type => $prices) {
    $categories[] = $type;
    $averageRentPrice = array_sum($prices) / count($prices);
    $seriesData[] = round($averageRentPrice, 2);
}
?>

<script>
    // Function to format the type strings in JavaScript
    function formatType(type) {
        return type.replace(/_/g, ' ').replace(/\b\w/g, function (c) {
            return c.toUpperCase();
        });
    }

    var options = {
        series: [{
            name: "Price",
            data: <?php echo json_encode($seriesData); ?>
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        colors: ['#7B66FF'],
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: 'Pricing',
            align: 'center',
            style: {
                fontSize: '20px'
            }
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: <?php echo json_encode(array_map('formatType', $categories)); ?>,
            labels: {
                show: true,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold'
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chartline"), options);
    chart.render();
</script>
</script>


  <!-- count of propeties per barangays -->
<?php

$query = "SELECT `address2` FROM `listing`";
$result = mysqli_query($conn, $query);

// Initialize an associative array to keep track of counts for each address
$addressCount = array();
while ($row = mysqli_fetch_assoc($result)) {
    $address = $row['address2'];
    if (array_key_exists($address, $addressCount)) {
        $addressCount[$address]++;
    } else {
        $addressCount[$address] = 1;
    }
}

// Prepare the data array for the chart
$chartData = array();
foreach ($addressCount as $address => $count) {
    $chartData[] = array('x' => $address, 'y' => $count);
}
?>

<script>
  var chartData = <?php echo json_encode($chartData); ?>;

var options = {
    series: [
        {
            data: chartData
        }
    ],

    legend: {
        show: false
    },
    chart: {
        height: 350,
        type: 'treemap',
    },
    // colors: ['#FF6C22'],
    title: {
        text: 'Competition',
        align: 'center',
        style: {
            fontSize: '20px'
        }
    },
    plotOptions: {
        treemap: {
            distributed: true,
            colorScale: {
                ranges: [{
                    from: 0,
                    to: 50,
                    color: '#1640D6'
                }, {
                    from: 51,
                    to: 100,
                    color: '#1640D6'
                }]
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#charttreemap"), options);
chart.render();

    // var chartData = <?php echo json_encode($chartData); ?>;

    // var options = {
    //     series: [
    //         {
    //             data: chartData
    //         }
    //     ],
      
    //     legend: {
    //         show: false
    //     },
    //     chart: {
    //         height: 350,
    //         type: 'treemap',
            
    //     },
    //     colors: ['#FF6C22'],
    //     title: {
    //         text: 'Competition',
    //         align: 'center',
    //         style: {
    //             fontSize: '20px'
    //         }
    //     }
    // };

    // var chart = new ApexCharts(document.querySelector("#charttreemap"), options);
    // chart.render();
</script>

    <!-- customer preferences -->
    <?php
// Assuming you have a database connection established ($conn)
$sql_ref = "SELECT keyword, count FROM cus_ref";
$result_ref = $conn->query($sql_ref);

$labels_bed = array();
$data_bed = array();

$labels_bathroom = array();
$data_bathroom = array();

if ($result_ref->num_rows > 0) {
    while ($row_ref = $result_ref->fetch_assoc()) {
        $keyword = $row_ref['keyword'];
        $count = intval($row_ref['count']);

        // Exclude 'bedspace' from both 'Bed' and 'Bathroom' charts
        if (stripos($keyword, 'Bedspace') === false) {
            if (stripos($keyword, 'Bed') !== false) {
                // Keyword contains 'Bed'
                $labels_bed[] = $keyword;
                $data_bed[] = $count;
            } elseif (stripos($keyword, 'Bathroom') !== false) {
                // Keyword contains 'Bathroom'
                $labels_bathroom[] = $keyword;
                $data_bathroom[] = $count;
            }
        }
    }
}

// Construct the chart options for the 'Bed' pie chart
$chart_options_bed = array(
    'series' => $data_bed,
    'chart' => array(
        'height' => 350,
        'type' => 'pie',
        'events' => array(
            'click' => 'function(chart, w, e) { }',
        ),
    ),
    'labels' => $labels_bed,
    'dataLabels' => array(
        'enabled' => false,
    ),
    'legend' => array(
        'show' => true,
        'position' => 'bottom',
    ),
);

// Convert the options array to JSON for the 'Bed' chart
$chart_options_bed_json = json_encode($chart_options_bed);

// Construct the chart options for the 'Bathroom' pie chart
$chart_options_bathroom = array(
    'series' => $data_bathroom,
    'chart' => array(
        'height' => 350,
        'type' => 'pie',
        'events' => array(
            'click' => 'function(chart, w, e) { }',
        ),
    ),
    'labels' => $labels_bathroom,
    'dataLabels' => array(
        'enabled' => false,
    ),
    'legend' => array(
        'show' => true,
        'position' => 'bottom',
    ),
);

// Convert the options array to JSON for the 'Bathroom' chart
$chart_options_bathroom_json = json_encode($chart_options_bathroom);
?>

<script>
    var options_bed = <?php echo $chart_options_bed_json; ?>;
    var chart_bed = new ApexCharts(document.querySelector("#chartBed"), options_bed);
    chart_bed.render();

    var options_bathroom = <?php echo $chart_options_bathroom_json; ?>;
    var chart_bathroom = new ApexCharts(document.querySelector("#chartBathroom"), options_bathroom);
    chart_bathroom.render();
</script>

<?php
// Assuming you have a database connection established ($conn)
$sql_ref = "SELECT keyword, count FROM cus_ref";
$result_ref = $conn->query($sql_ref);

$minPrices = array();
$maxPrices = array();

while ($row_ref = $result_ref->fetch_assoc()) {
    $keyword = $row_ref['keyword'];
    $count = intval($row_ref['count']);

    if (stripos($keyword, 'Min Price:') !== false) {
        // Extract numeric value following 'Min Price:'
        preg_match('/Min Price:\s*([\d.]+)/', $keyword, $matches);
        if (isset($matches[1])) {
            $minPrices[] = (float)$matches[1];
        }
    } elseif (stripos($keyword, 'Max Price:') !== false) {
        // Extract numeric value following 'Max Price:'
        preg_match('/Max Price:\s*([\d.]+)/', $keyword, $matches);
        if (isset($matches[1])) {
            $maxPrices[] = (float)$matches[1];
        }
    }
}

// Calculate averages
$averageMinPrice = (!empty($minPrices)) ? array_sum($minPrices) / count($minPrices) : 0;
$averageMaxPrice = (!empty($maxPrices)) ? array_sum($maxPrices) / count($maxPrices) : 0;

// Construct labels and data for the pie chart
$labels_price = array('Average Min Price', 'Average Max Price');
$data_price = array($averageMinPrice, $averageMaxPrice);

// Construct the chart options for the pie chart
$chart_options_price = array(
    'series' => $data_price,
    'chart' => array(
        'height' => 350,
        'type' => 'pie',
        'events' => array(
            'click' => 'function(chart, w, e) { }',
        ),
    ),
    'labels' => $labels_price,
    'dataLabels' => array(
        'enabled' => false,
    ),
    'legend' => array(
        'show' => true,
        'position' => 'bottom',
    ),
);

// Convert the options array to JSON
$chart_options_price_json = json_encode($chart_options_price);
?>

<script>
    var options_price = <?php echo $chart_options_price_json; ?>;
    var chart_price = new ApexCharts(document.querySelector("#chartPrice"), options_price);
    chart_price.render();
</script>
<?php
// Assuming you have a database connection established ($conn)

// List of excluded keywords
$excluded_keywords = array('Min Price:', 'Max Price:', 'Bed', 'Bathroom');

// List of excluded barangays
$excluded_barangays = array(
    'Aguso', 'Alvindia', 'Amucao', 'Armenia', 'Asturias', 'Atioc', 'Balanti', 'Balete', 'Balibago I',
    'Balibago II', 'Balingcanaway', 'Banaba', 'Bantog', 'Baras-baras', 'Batang-batang', 'Binauganan',
    'Bora', 'Buenavista', 'Buhilit', 'Burot', 'Calingcuan', 'Capehan', 'Carangian', 'Care', 'Central',
    'Culipat', 'Cut-cut I', 'Cut-cut II', 'Dalayap', 'Dela Paz', 'Dolores', 'Laoang', 'Ligtasan', 'Lourdes',
    'Mabini', 'Maligaya', 'Maliwalo', 'Mapalacsiao', 'Mapalad', 'Matatalaib', 'Paraiso', 'Poblacion', 'Salapungan',
    'San Carlos', 'San Francisco', 'San Isidro', 'San Jose', 'San Jose de Urquico', 'San Juan Bautista (formerly Matadero)',
    'San Juan de Mata (formerly Malatiki)', 'San Luis', 'San Manuel', 'San Miguel', 'San Nicolas', 'San Pablo', 'San Pascual',
    'San Rafael', 'San Roque', 'San Sebastian', 'San Vicente', 'Santa Cruz', 'Santa Maria', 'Santo Cristo', 'Santo Domingo',
    'Santo Niño', 'Sapang Maragul', 'Sapang Tagalog', 'Sepung Calzada (Panampunan)', 'Sinait', 'Suizo', 'Tariji', 'Tibag', 'Tibagan',
    'Trinidad', 'Ungot', 'Villa Bacolor'
);

// Construct the SQL query with excluded keywords and barangays
$sql_ref = "SELECT keyword, count FROM cus_ref WHERE";
foreach ($excluded_keywords as $keyword) {
    $sql_ref .= " NOT keyword LIKE '%$keyword%' AND";
}
foreach ($excluded_barangays as $barangay) {
    $sql_ref .= " NOT keyword = '$barangay' AND";
}
// Remove the trailing "AND" from the query
$sql_ref = rtrim($sql_ref, " AND");

$result_ref = $conn->query($sql_ref);

$labels_other = array();
$data_other = array();

while ($row_ref = $result_ref->fetch_assoc()) {
    $keyword = $row_ref['keyword'];
    $count = intval($row_ref['count']);

    $labels_other[] = $keyword;
    $data_other[] = $count;
}

// Construct the chart options for the pie chart
$chart_options_other = array(
    'series' => $data_other,
    'chart' => array(
        'height' => 350,
        'type' => 'pie',
        'events' => array(
            'click' => 'function(chart, w, e) { }',
        ),
    ),
    'labels' => $labels_other,
    'dataLabels' => array(
        'enabled' => false,
    ),
    'legend' => array(
        'show' => true,
        'position' => 'bottom',
    ),
);

// Convert the options array to JSON
$chart_options_other_json = json_encode($chart_options_other);
?>
<script>
    var options_other = <?php echo $chart_options_other_json; ?>;
    var chart_other = new ApexCharts(document.querySelector("#chartOther"), options_other);
    chart_other.render();
<?php
$sql = "SELECT 
            MONTH(a.date_of_application) AS month,
            COUNT(*) AS total,
            SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS approved,
            SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN a.status = 'renter' THEN 1 ELSE 0 END) AS renter
        FROM application a
        LEFT JOIN tenant t ON a.tenant_id = t.tenant_id
        LEFT JOIN credentials c ON t.user_id = c.user_id
        LEFT JOIN listing l ON l.listing_id = a.listing_id
        LEFT JOIN payment p ON a.application_id = p.application_id
        WHERE l.owner_id = '$id' AND a.status IN ('approved', 'rejected', 'renter')
        GROUP BY Month
        ORDER BY Month";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Fetch the result and format it for JavaScript
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Convert the PHP array to a JSON string
$jsonData = json_encode($data);
?>
    var chartData = <?php echo $jsonData; ?>;

    var optionss = {
        series: [
            {
                name: 'Approved',
                data: chartData.map(item => item.approved)
            },
            {
                name: 'Rejected',
                data: chartData.map(item => item.rejected)
            },
            // {
            //     name: 'Renter',
            //     data: chartData.map(item => item.renter)
            // }
        ],
          chart: {
          height: 350,
          type: 'line',
          dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
          },
          toolbar: {
            show: false
          },
          zoom: {
                enabled: false
            }
        },
        colors: ['#28a745', '#dc3545','#545454'],
        dataLabels: {
          enabled: true,
        },
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: 'Reservation vs Payment',
          align: 'left'
        },
        grid: {
          borderColor: '#e7e7e7',
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        markers: {
          size: 1
        },
        xaxis: {
    categories: chartData.map(item => {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return months[item.month - 1]; //  1 and 12
    }),
},

    //  xaxis: {
    //             categories: chartData.map(item => item.month),
    //             title: {
    //                 text: 'Month'
    //             }
    //         },
        // yaxis: {
        //   title: {
        //     text: ''
        //   },
        //   min: 0
       
        // },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          floating: true,
          offsetY: -25,
          offsetX: -5
        }
        };

        var charts = new ApexCharts(document.querySelector("#multiline"), optionss);
        charts.render();
</script>


<?php
// Assuming you have a database connection established ($conn)

// List of included barangays
$included_barangays = array(
    'Aguso', 'Alvindia', 'Amucao', 'Armenia', 'Asturias', 'Atioc', 'Balanti', 'Balete', 'Balibago I',
    'Balibago II', 'Balingcanaway', 'Banaba', 'Bantog', 'Baras-baras', 'Batang-batang', 'Binauganan',
    'Bora', 'Buenavista', 'Buhilit', 'Burot', 'Calingcuan', 'Capehan', 'Carangian', 'Care', 'Central',
    'Culipat', 'Cut-cut I', 'Cut-cut II', 'Dalayap', 'Dela Paz', 'Dolores', 'Laoang', 'Ligtasan', 'Lourdes',
    'Mabini', 'Maligaya', 'Maliwalo', 'Mapalacsiao', 'Mapalad', 'Matatalaib', 'Paraiso', 'Poblacion', 'Salapungan',
    'San Carlos', 'San Francisco', 'San Isidro', 'San Jose', 'San Jose de Urquico', 'San Juan Bautista (formerly Matadero)',
    'San Juan de Mata (formerly Malatiki)', 'San Luis', 'San Manuel', 'San Miguel', 'San Nicolas', 'San Pablo', 'San Pascual',
    'San Rafael', 'San Roque', 'San Sebastian', 'San Vicente', 'Santa Cruz', 'Santa Maria', 'Santo Cristo', 'Santo Domingo',
    'Santo Niño', 'Sapang Maragul', 'Sapang Tagalog', 'Sepung Calzada (Panampunan)', 'Sinait', 'Suizo', 'Tariji', 'Tibag', 'Tibagan',
    'Trinidad', 'Ungot', 'Villa Bacolor'
);

// Construct the SQL query with included barangays
$sql_ref = "SELECT keyword, count FROM cus_ref WHERE keyword IN ('" . implode("','", $included_barangays) . "')";
$result_ref = $conn->query($sql_ref);

$labels_barangay = array();
$data_barangay = array();

while ($row_ref = $result_ref->fetch_assoc()) {
    $keyword = $row_ref['keyword'];
    $count = intval($row_ref['count']);

    $labels_barangay[] = $keyword;
    $data_barangay[] = $count;
}

// Construct the chart options for the pie chart
$chart_options_barangay = array(
    'series' => $data_barangay,
    'chart' => array(
        'height' => 350,
        'type' => 'pie',
        'events' => array(
            'click' => 'function(chart, w, e) { }',
        ),
    ),
    'labels' => $labels_barangay,
    'dataLabels' => array(
        'enabled' => false,
    ),
    'legend' => array(
        'show' => true,
        'position' => 'bottom',
    ),
);

// Convert the options array to JSON
$chart_options_barangay_json = json_encode($chart_options_barangay);
?>

<script>
    var options_barangay = <?php echo $chart_options_barangay_json; ?>;
    var chart_barangay = new ApexCharts(document.querySelector("#chartBarangay"), options_barangay);
    chart_barangay.render();
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
<script>
function updateQuery() {
    // Get the selected barangay value
    var selectedBarangay = document.getElementById("barangaySelect").value;

    // Send an AJAX request to update the content dynamically
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the content based on the server response
            var response = JSON.parse(this.responseText);

            // Example: Update the chart data with the response data
            var updatedChartData = response.chartData;
            chart.updateSeries([{ data: updatedChartData }]);
        }
    };
    xhttp.open("GET", "update.php?barangay=" + selectedBarangay, true);
    xhttp.send();
}
</script>

<script src="js/plugins.min.js"></script>
  <script src="js/script.min.js"></script>

     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo6VqHn6BDlQ4PWMTPsHo1fDai1xQgHEQ&libraries=places&callback=initMap"
    async defer></script>
  </body>

  
</html>