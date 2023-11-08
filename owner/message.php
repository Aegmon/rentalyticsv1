<?php
include('sidebar.php');



?>

<div class="contents">
  <div class="container-fluid">
    <div class="social-dash-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-main">
            <h4 class="text-capitalize breadcrumb-title">Message</h4>
            <div class="breadcrumb-action justify-content-center flex-wrap">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Message</li>
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
                <div class="chat-area d-flex mb-40">
          <div class="mb-lg-0 mb-40 chat-sidebar">
            <div class="sidebar-group left-sidebar chat_sidebar">
              <div id="chat" class="left-sidebar-wrap radius-xl active">
                <div class="chat-wrapper py-25">
                  <div class="search-header">
                    <form action="http://demo.dashboardmarket.com/" class="d-flex align-items-center">
                      <img src="img/svg/search.svg" alt="search" class="svg">
                      <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Search" aria-label="Search">
                    </form>
                  </div>
                  <div class="search-tab">
                    <ul class="nav ap-tab-main border-bottom text-capitalize" id="ueberTab" role="tablist">
                      <li class="nav-item me-0">
                        <a class="nav-link active" id="first-tab" data-bs-target="#panel_b_first" data-secondary="#panel_a_first" data-bs-toggle="tab"
                         href="#first" role="tab" aria-selected="true">Owner</a>
                      </li>
                  
                    </ul>
                  </div>
                  <div class="search-body">
                    <div class="tab-content" id="ueberTabA">
                      <div class="tab-pane fade show active" id="panel_a_first" role="tabpanel" aria-labelledby="first-tab">
                        <ul class="user-list">
 <?php

$sql = "SELECT m.tenant_id, o.name, MAX(m.message) as message, MAX(m.date) as date 
        FROM message m
        LEFT JOIN tenant o ON m.tenant_id = o.tenant_id
        WHERE m.owner_id = '$id'
        GROUP BY m.tenant_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <li class="user-list-item">
            <div class="user-list-item__wrapper">
                <div class="avatar avatar-circle ms-0">
                    <img src="img/user.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                    <div class="badge-direction-bottom">
                        <span class="chat-badge-dot avatar-online"></span>
                    </div>
                </div>
                <div class="users-list-body">
                    <div class="users-list-body-title">
                        <h6><?php echo $row['name']; ?></h6>
                        <div class="text-limit" data-maxlength="10">
                            <p class="mb-0"><span><?php echo $row['message']; ?></span>...</p>
                        </div>
                    </div>
                    <div class="last-chat-time unread">
                        <small><?php echo date('H:i a', strtotime($row['date'])); ?></small>
                    </div>
                </div>
            </div>
        </li>
        <?php
    }
} else {
    echo "No Message";
}

?>


                        </ul>
                      </div>
                
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-content" style="width:100%" id="ueberTabB">
            <div class="tab-pane fade  show active" id="panel_b_first" role="tabpanel" aria-labelledby="first-tab">
              <div class="chat">
                <div class="chat-body bg-white radius-xl">
                  <div class="chat-header">
                    <div class="media chat-name align-items-center">
                      <div class="media-body align-self-center ">
                        <h5 class=" mb-0 fw-500 mb-2"> </h5>
                        <div class="media-body__content d-flex align-items-center">
                        
                          <small class="d-flex color-light fs-12 text-capitalize">
                          
                          </small>
                        </div>
                      </div>
                    </div>
                 
                  </div>
                  <div class="chat-box chat-box--big p-xl-30 ps-lg-20 pe-lg-0" >


           
                  </div>
                  <div class="chat-footer px-xl-30 px-lg-20 pb-lg-30 pt-1">
                    <div class="chat-type-text">
                      <div class="pt-0 outline-0 pb-0 pe-0 ps-0 rounded-0 position-relative d-flex align-items-center" tabindex="-1">
                        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                          <div class=" flex-1 d-flex align-items-center chat-type-text__write ms-0">
                          
                            <input class="form-control border-0 bg-transparent box-shadow-none" placeholder="Type your message...">
                          </div>
                          <div class="chat-type-text__btn">
                        
                            <button type="button" class="border-0 btn-primary wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/send.svg" alt="send"></button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.user-list-item').on('click', function() {
    $('.user-list-item').removeClass('active');
    $(this).addClass('active');
    const name = $(this).find('h6').text();
    const time = $(this).find('small').text();
    const message = $(this).find('p').text();
    const owner_id = $(this).data('owner-id'); // Assuming data attribute is 'owner-id'

    $('.chat-name h5').text(name);
    $('.chat-name small').text(time);
    $('.chat-box__content p').text(message);

    $.ajax({
      type: 'GET',
      url: 'get_user_messages.php',
      data: { owner_id: owner_id }, // Passing owner_id to get_user_messages.php
      success: function(data) {
        // Display the user's messages in the chat area
        $('.chat-messages').html(data);
      },
      error: function(error) {
        console.error('Error fetching user messages:', error);
      }
    });
  });
});
</script>




  </body>

  
</html>