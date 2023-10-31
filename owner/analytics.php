<?php
include('sidebar.php');

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
      
        var options = {
          series: [60, 100],
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
          series: [60, 100,35],
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
          series: [60, 100,35],
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
          series: [60, 100,35],
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
          series: [60, 100,35],
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
          series: [60, 100,35],
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