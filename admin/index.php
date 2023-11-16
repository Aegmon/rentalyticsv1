<?php
include('sidebar.php');
$listing_place_total = $conn->query("SELECT COUNT(*) as total_listing FROM listing WHERE isVerify = 'Verify'");
$owner_male_result = $conn->query("SELECT COUNT(*) as male_count FROM owner WHERE gender = 'Male'");
$owner_female_result = $conn->query("SELECT COUNT(*) as female_count FROM owner WHERE gender = 'Female'");

$owner_male_count = $owner_male_result->fetch_assoc()['male_count'];
$owner_female_count = $owner_female_result->fetch_assoc()['female_count'];
$lisitng_total_count = $listing_place_total->fetch_assoc()['total_listing'];


$tenant_male_result = $conn->query("SELECT COUNT(*) as male_count FROM tenant WHERE gender = 'Male'");
$tenant_female_result = $conn->query("SELECT COUNT(*) as female_count FROM tenant WHERE gender = 'Female'");

$tenant_male_count = $tenant_male_result->fetch_assoc()['male_count'];
$tenant_female_count = $tenant_female_result->fetch_assoc()['female_count'];

// Calculate the total sum
$total_tenant_male_count = $tenant_male_count;
$total_tenant_female_count = $tenant_female_count;
$total_tenant_count = $tenant_male_count + $tenant_female_count;


$total_owner_male_count = $owner_male_count;
$total_owner_female_count = $owner_female_count;
$total_owner_count = $owner_male_count + $owner_female_count;

$total_listing = $lisitng_total_count;
$result = $conn->query("SELECT SUM(CASE WHEN gender_req = 'Male' THEN 1 ELSE 0 END) as male_listing_count,
                              SUM(CASE WHEN gender_req = 'Female' THEN 1 ELSE 0 END) as female_listing_count,
                          SUM(CASE WHEN gender_req = 'Both' THEN 1 ELSE 0 END) as both_listing_count
                        FROM listing");

// Fetch the result
$row = $result->fetch_assoc();
$total_male_listing_count = $row['male_listing_count'];
$total_female_listing_count = $row['female_listing_count'];
$total_both_listing_count = $row['both_listing_count'];


$result = $conn->query("SELECT type, address2,gender_req, COUNT(*) as gender_count 
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

    $sql = "SELECT l.owner_id, COUNT(DISTINCT l.listing_id) AS listing_count, COUNT(a.application_id) AS rent_count
        FROM listing l
        LEFT JOIN application a ON l.listing_id = a.listing_id
     GROUP BY l.owner_id ";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $rent_count = $row['rent_count'];
        $listing_count = $row['listing_count'];
    }
} else {
   $rent_count = 0;
   $listing_count = 0;
}


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
         <div class="col-xxl-4 col-sm-4 mb-25">
                <div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">
                  <div class="overview-content w-100">
                    <div class=" ap-po-details-content d-flex flex-wrap justify-content-between">
                      <div class="ap-po-details__titlebar">
                        <h1><?php echo $total_listing; ?></h1>
                        <h5>Total Listing</h5>
                      </div>
                      <div class="ap-po-details__icon-area">
                        <div class="svg-icon order-bg-opacity-primary color-primary">
                          <i class="uil uil-home"></i>
                        </div>
                      </div>
                    </div>
               
                  </div>
                </div>
              </div>
         
          
          
                         <div class="col-xxl-4 col-sm-4 mb-25">
                <div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">
                  <div class="overview-content w-100">
                    <div class=" ap-po-details-content d-flex flex-wrap justify-content-between">
                      <div class="ap-po-details__titlebar">
                        <h1><?php echo $total_tenant_count; ?></h1>
                        <h5>Total Renter</h5>
                      </div>
                      <div class="ap-po-details__icon-area">
                        <div class="svg-icon order-bg-opacity-warning color-warning">
                          <i class="uil uil-users-alt"></i>
                        </div>
                      </div>
                    </div>
                 
                  </div>
                </div>
              </div>
                         <div class="col-xxl-4 col-sm-4 mb-25">
                <div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">
                  <div class="overview-content w-100">
                    <div class=" ap-po-details-content d-flex flex-wrap justify-content-between">
                      <div class="ap-po-details__titlebar">
                        <h1><?php echo $total_owner_count; ?></h1>
                        <h5>Total Owner</h5>
                      </div>
                      <div class="ap-po-details__icon-area">
                        <div class="svg-icon order-bg-opacity-warning color-warning">
                          <i class="uil uil-users-alt"></i>
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
<div class="col-lg-4 mb-4">
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
   <div>Rental Statistics</div>
   <div>


   </div>
    </div>
<div class="col-lg-12 mb-4">
  <div class="card">

  <div class="card-header">Registered Property Types</div>

   <div id="chartbar"></div>
 
  
  </div>
</div>
<div class="col-lg-12 mb-4">
  <div class="card">
  <div class="card-header">Customer Preferences</div>

  <div id="chartbar2"></div>
  
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
<div class="col-lg-12 mb-4">
  <div class="card">
  <div class="card-header">TreeMap</div>

  <div id="charttreemap"></div>
  
  </div>
</div>
            </div>
          </div>
        </div>
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
  $sql = "SELECT * FROM listing";
  $result = $conn->query($sql);

  while ($row = mysqli_fetch_array($result)) {
    
   
    echo '["Place Name: ' . $row['listing_name'] . '\n'. "Reservation Fee: " . $row['reservationfee'] . '\n'. $row['type'] . '' .' ",' . $row['lat'] . ',' . $row['lng'] . '],';

  }
  
  ?>
];

    // Create an array to store the geofences
    var geofences = [];

    // Add markers and geofences for each location
    for (var i = 0; i < locations.length; i++) {
      var location = new google.maps.LatLng(locations[i][1], locations[i][2]);
      var mark = new google.maps.Marker({
        position: location,
        map: map,
        animation: google.maps.Animation.DROP,
        title: locations[i][0],
        
      });
      // Check if this marker falls inside any existing geofence
      var markerInsideAnyGeofence = false;
      for (var j = 0; j < geofences.length; j++) {
        var geofenceBounds = geofences[j].getBounds();
        if (geofenceBounds.contains(location)) {
          markerInsideAnyGeofence = true;
          break;
        }
      }

      // If the marker is not inside any existing geofence, create a new geofence
      if (!markerInsideAnyGeofence) {
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
        geofences.push(geofence);
      }
    }
}

   

    </script>
     <!-- customer preferences -->
    <?php
// Assuming you have a database connection established ($conn)
$sql_ref = "SELECT keyword, count
FROM cus_ref
ORDER BY keyword DESC";
$result_ref = $conn->query($sql_ref);

$categories = array();
$data = array();

if ($result_ref->num_rows > 0) {
    while ($row_ref = $result_ref->fetch_assoc()) {
        $categories[] = [$row_ref['keyword']];
        $data[] = intval($row_ref['count']); // Convert to integer (whole number)
    }
}

// Construct the chart options
$chart_options = array(
    'series' => array(
        array(
            'data' => $data,
        ),
    ),
    'chart' => array(
        'height' => 350,
        'type' => 'bar',
        'events' => array(
            'click' => 'function(chart, w, e) { }',
        ),
    ),
    'plotOptions' => array(
        'bar' => array(
            'borderRadius' => 5,
            'columnWidth' => '45%',
            'distributed' => true,
        ),
    ),
    'dataLabels' => array(
        'enabled' => false,
    ),
    'legend' => array(
        'show' => false,
    ),
    'xaxis' => array(
        'categories' => $categories,
        'labels' => array(
            'style' => array(
                'colors' => '#000',
                'fontSize' => '18px',
            ),
        ),
    ),
);

// Convert the options array to JSON
$chart_options_json = json_encode($chart_options);
?>

<script>
    var options = <?php echo $chart_options_json; ?>;
    var chart = new ApexCharts(document.querySelector("#chartbar2"), options);
    chart.render();
</script>
<!--     
    <?php
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


?>  -->
<!-- <script>
        var options = <?php echo json_encode($options); ?>;
        var chart = new ApexCharts(document.querySelector("#chartbar"), options);
        chart.render();
    </script> -->


          <script>
  
        // var colors = ['#26a0fc','#00E396']
        var options = {
          series: [<?php echo $total_tenant_male_count?>, <?php echo $total_tenant_female_count?>],
          chart: {
          width: 380,
          type: 'pie',
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
          type: 'pie',
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
          type: 'pie',
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
          type: 'pie',
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
      // var colors = ['#26a0fc','#f41fad', '#ffe15d']
      
        var options = {
          series: [<?php echo $total_male_apartment_count;?>, <?php echo $total_female_apartment_count ;?>,<?php echo $total_both_apartment_count ;?>],
          
          chart: {
          width: 380,
          type: 'pie',
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
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: 'straight'
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
        title: {
            text: 'Competition',
            align: 'center',
            style: {
                fontSize: '20px'
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#charttreemap"), options);
    chart.render();
</script>

    <!-- customer preferences -->
    <?php

$sql_ref = "SELECT keyword, MAX(count) AS max_count
FROM cus_ref
GROUP BY keyword;";
$result_ref = $conn->query($sql_ref);

$categories = array();
$data = array();

if ($result_ref->num_rows > 0) {
    while ($row_ref = $result_ref->fetch_assoc()) {
        $categories[] = $row_ref['keyword']; 
        $data[] = intval($row_ref['max_count']); 
    }
}


$chart_options = array(
    'series' => array(
        array(
            'data' => $data,
        ),
    ),
    'chart' => array(
        'height' => 350,
        'type' => 'bar',
        'events' => array(
            'click' => 'function(chart, w, e) { }',
        ),
    ),
    'plotOptions' => array(
        'bar' => array(
            'borderRadius' => 5,
            'columnWidth' => '45%',
            'distributed' => true,
        ),
    ),
    'dataLabels' => array(
        'enabled' => false,
    ),
    'legend' => array(
        'show' => false,
    ),
    'xaxis' => array(
        'categories' => $categories,
        'labels' => array(
            'style' => array(
                'colors' => '#000',
                'fontSize' => '18px',
            ),
        ),
    ),
);

// Convert the options array to JSON
$chart_options_json = json_encode($chart_options);
?>

<script>
    var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560'];
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
    colors: colors,
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