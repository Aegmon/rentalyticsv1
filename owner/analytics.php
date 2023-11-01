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

  
        <div id="chart"> </div>
 
  
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
                   <div class="mb-4">
   Bar Graph
    </div>
<div class="col-lg-4 mb-4">
  <div class="card">
  <div class="card-header">Registered Property Types</div>

  
        <div id="chartbar"></div>
 
  
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
  <div class="card-header">Gender</div>

  
        <div id="chart3"></div>
 
  
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgYKHZB_QKKLWfIRaYPCadza3nhTAbv7c"></script>
    <script>    
    var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560'];
      
        var options = {
          series: [{
          data: [<?php echo $total_apartment_count ?>,<?php echo  $total_dormitory_count ?>,<?php echo  $total_bedspace_count ?>,<?php echo  $total_boarding_house_count ?>]
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
        colors: colors,
        plotOptions: {
          bar: {
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
              colors: colors,
              fontSize: '12px'
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chartbar"), options);
        chart.render();
      
        
        </script>
          <script>
  

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
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    </script>
              <script>
      
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
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
      
      
    </script>
         <script>
      
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
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();
      
      
    </script>
         <script>
      
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
      
        var options = {
                 series: [<?php echo $total_male_apartment_count ;?>, <?php echo $total_female_apartment_count ;?>,<?php echo $total_both_apartment_count ;?>],
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

        var chart = new ApexCharts(document.querySelector("#chart5"), options);
        chart.render();
      
      
    </script>
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