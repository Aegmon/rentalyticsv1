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
$sql = "SELECT t.*, MAX(m.message) as message, MAX(m.date) as date ,t.profile_pic
        FROM tenant t
        LEFT JOIN message m ON t.tenant_id = m.tenant_id
        WHERE m.owner_id = '$id'
        GROUP BY t.tenant_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
       <li class="user-list-item" data-tenant-id="<?php echo $row['tenant_id']; ?>">
            <div class="user-list-item__wrapper">
                <div class="avatar avatar-circle ms-0">
                    <img src="../uploads/<?php echo $row['profile_pic']; ?>" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                    <div class="badge-direction-bottom">
                        <!-- <span class="chat-badge-dot avatar-online"></span> -->
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

                    <small><?php echo date('h:i a', strtotime($row['date'])); ?></small>
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
                          
                           <input type="text" id="message-input" class="form-control border-0 bg-transparent box-shadow-none" placeholder="Type your message...">

                          </div>
                          <div class="chat-type-text__btn">
                        
                           <button type="button" id="send-message-btn" class="border-0 btn-primary wh-50 p-10 rounded-circle">
   <img class="svg" src="img/svg/send.svg" alt="send">
</button>
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
 

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgYKHZB_QKKLWfIRaYPCadza3nhTAbv7c"></script>
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.user-list-item').on('click', function() {
    $('.user-list-item').removeClass('active');
    $(this).addClass('active');
    const name = $(this).find('h6').text();
    const time = $(this).find('small').text();
    const tenant_id = $(this).data('tenant-id');

    // Update the chat box header
    $('.chat-name h5').text(name);
    $('.chat-name small').text(time);

    // Clear the existing messages in the chat box
    $('.chat-box').empty();

    // Fetch and display user messages using AJAX
    $.ajax({
      type: 'GET',
      url: 'get_user_messages.php',
      data: { tenant_id: tenant_id},
      success: function(data) {
        // Display the user's messages in the chat area
        $('.chat-box').append(data);
      },
      error: function(error) {
        console.error('Error fetching user messages:', error);
      }
    });
  });


     $('#send-message-btn').on('click', function() {
      const tenant_id = $('.user-list-item.active').data('tenant-id'); // Get the active user's owner_id
      const message = $('#message-input').val(); // Get the message from the input field

      // Check if the message is not empty
      if (message.trim() !== '') {
         // AJAX request to send the message
         $.ajax({
            type: 'POST',
            url: 'send_message.php', // Create a new PHP script for handling the message insertion
            data: { tenant_id: tenant_id, message: message },
            success: function(response) {
               // Clear the input field after successfully sending the message
               $('#message-input').val('');

               // Fetch and display updated messages
               fetchAndUpdateMessages(tenant_id);
            },
            error: function(error) {
               console.error('Error sending message:', error);
            }
         });
      }
   });

   // Function to fetch and update messages (reuse this function)
   function fetchAndUpdateMessages(tenant_id) {
      // AJAX request to fetch and display user messages
      $.ajax({
         type: 'GET',
         url: 'get_user_messages.php',
         data: { tenant_id: tenant_id },
         success: function(data) {
            // Display the user's messages in the chat area
            $('.chat-box').html(data);
         },
         error: function(error) {
            console.error('Error fetching user messages:', error);
         }
      });
   }

});

</script>





  </body>

  
</html>