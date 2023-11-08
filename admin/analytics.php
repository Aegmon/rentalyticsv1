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
$total_male_count = $owner_male_count + $tenant_male_count;
$total_female_count = $owner_female_count + $tenant_female_count;



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
  <div class="card-header">Appartment</div>

  
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
   <div>Bar Graph</div>
   <div>
   <select>
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
    
   
    echo '["Place Name: ' . $row['listing_name'] . '\n'. "Reservation Fee: " . $row['reservationfee'] .'",' . $row['lat'] . ',' . $row['lng'] . '],';

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
 
    
    

  
   <script>
  var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560'];
  var options = {
    series: [{
      data: [<?php echo $total_apartment_count ?>, <?php echo  $total_dormitory_count ?>, <?php echo  $total_bedspace_count ?>, <?php echo  $total_boarding_house_count ?>]
    }],
    chart: {
      height: 350,
      width: 1000,
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
        'Appartment',
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
  
        var colors = ['#26a0fc','#00E396']
        var options = {
          series: [<?php echo $total_male_count?>, <?php echo $total_female_count?>],
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
        }],
        fill: {
          colors: colors
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    </script>
              <script>
      var colors = ['#26a0fc','#00E396', '#ffe15d']
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
        }],
        fill:{
          colors: colors
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
      
      
    </script>
         <script>
      var colors = ['#26a0fc','#00E396', '#ffe15d']
      
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
        }],
        fill:{
          colors: colors
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
      
      
    </script>
         <script>
      var colors = ['#26a0fc','#00E396', '#ffe15d']
      
        var options = {
         series: [<?php echo $total_male_bedspace_count ;?>, <?php echo $total_female_bedspace_count ;?>,<?php echo $total_both_bedspace_count ;?>],
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
              position: 'bottom',
            }
          }
        }],
       
        fill:{
          colors: colors
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();
      
      
    </script>
         <script>
      var colors = ['#26a0fc','#f41fad', '#ffe15d']
      
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
        }],
        fill:{
          colors: colors
        }
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
        }],
        fill:{
          colors: colors
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart5"), options);
        chart.render();
      
      
    </script>

  <!-- pricing -->
<?php

$query = "SELECT type, rentprice FROM listing";
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
    <script>
       var options = {
          series: [{
          data: [21, 22, 10, 28, 22]
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
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
          // search counts here
          categories: [  
            ['Apartment'], // type of property
            ['Bed'+ ' (6)'], // bed count
            ['Bath'+ ' (2)'],// bath count
            ['1200'], // price min
            ['1500'] // price max
          ],
          labels: {
            style: {
              colors: '#000',
              fontSize: '18px'
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chartbar2"), options);
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

<script src="js/plugins.min.js"></script>
  <script src="js/script.min.js"></script>

     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo6VqHn6BDlQ4PWMTPsHo1fDai1xQgHEQ&libraries=places&callback=initMap"
    async defer></script>
  </body>

  
</html>