<?php

include('sidebar.php');
   $listing_id = $_GET['listing_id'];
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
<script>
    ! function(t) {
  t("#external-events .fc-event").each((function() {
    t(this).data("event", {
      title: t.trim(t(this).text()),
      stick: !0
    }), t(this).draggable({
      zIndex: 999,
      revert: !0,
      revertDuration: 0
    })
  }));
  new Date;
  let e = {
      id: 1,
      events: [{
        id: "1",
        start: moment().format("YYYY-MM-17") + "T08:30:00",
        title: "Family Events"
      }, {
        id: "2",
        start: moment().format("YYYY-MM-DD") + "T10:30:00",
        end: moment().format("YYYY-MM-DD") + "T12:00:00",
        title: "Dinner with Family"
      }],
      className: "primary",
      textColor: "#5F63F2"
    },
    n = {
      id: 2,
      events: [{
        id: "1",
        start: moment().format("YYYY-MM-20") + "T01:00:00",
        title: "Product Lunch"
      }],
      className: "secondary",
      textColor: "#FF69A5"
    },
    a = {
      id: 3,
      events: [{
        id: "1",
        start: moment().format("YYYY-MM-DD") + "T18:30:00",
        title: "Team Meeting"
      }],
      className: "success",
      textColor: "#20C997"
    },
    i = {
      id: 4,
      events: [{
        id: "1",
        start: moment().format("YYYY-MM-25") + "T11:00:00",
        title: "Team Meeting"
      }, {
        id: "2",
        start: moment().format("YYYY-MM-DD") + "T07:00:00",
        end: moment().format("YYYY-MM-DD") + "T08:30:00",
        title: "HexaDash Calendar App"
      }],
      className: "warning",
      textColor: "#FA8B0C"
    };
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
        listDayFormat: !0,
        listDayAltFormat: !0,
        allDaySlot: !1,
        editable: !0,
        eventSources: [e, n, a, i],
        contentHeight: 800,
        initialView: "dayGridMonth", // Set to "dayGridMonth" for Month view
        eventDidMount: function(e) {
          t(".fc-list-day").each((function() {}))
        },
        eventClick: function(e) {
          console.log(e.event.title);
          let n = t("#e-info-modal");
          n.modal("show"), console.log(n.find(".e-info-title")), n.find(".e-info-title").text(e.event.title)
        }
      });
      o.render(), t(".fc-button-group .fc-listMonth-button").prepend('<i class="las la-list"></i>')
    }
  }))
}(jQuery);
</script>




  </body>

  
</html>