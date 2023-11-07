<?php
include('sidebar.php');
  // Check if the required fields are set
   
        // Get the value from the form
    if (isset($_GET['application_id'])) {
    $application_id = $_GET['application_id'];
    $payment_date = date('Y-m-d'); // Current date

    // Assuming you have already established the database connection
    // Replace $conn with your actual database connection variable
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO payment (application_id, payment_date) VALUES (?, ?)");
    $stmt->bind_param("is", $application_id, $payment_date);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}
      
if (isset($_GET['feedback'])) {
    $listing_id = $_POST['listing_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    // Assuming $conn is your database connection
    $stmt = $conn->prepare("INSERT INTO review (tenant_id, rating, feedback, listing_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $id, $rating, $feedback, $listing_id);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}  


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
                        <a class="nav-link active" id="first-tab" data-bs-target="#panel_b_first" data-secondary="#panel_a_first" data-bs-toggle="tab" href="#first" role="tab" aria-selected="true">private
                          chat</a>
                      </li>
                  
                    </ul>
                  </div>
                  <div class="search-body">
                    <div class="tab-content" id="ueberTabA">
                      <div class="tab-pane fade show active" id="panel_a_first" role="tabpanel" aria-labelledby="first-tab">
                        <ul class="user-list">
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse1.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet fdsfdsf sdf dsf dsf dsf dsf dsf d</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                  <div class="total-message mt-1 d-flex justify-content-end">
                                    <span class="badge badge-success ">5</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse2.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Shreyu Neu</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse3.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Domnic Harris</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                  <div class="total-message mt-1 d-flex justify-content-end">
                                    <span class="badge badge-success ">15</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse4.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Khalid Hasan</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse5.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Tuhin Molla</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse6.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Billal Hossain</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse7.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Ibn Adam</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse8.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Tanim</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse9.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Tabib Rahman</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse2.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Shreyu Neu</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse1.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse3.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Domnic Harris</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse4.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Khalid Hasan</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse1.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse6.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Billal Hossain</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="tab-pane fade" id="panel_a_second" role="tabpanel" aria-labelledby="second-tab">
                        <ul class="user-list">
                          <li>
                            <div class="user-button-top">
                              <button type="button" class="border bg-normal color-gray rounded-pill content-center"><img class="svg" src="img/svg/edit.svg" alt="edit">create a new group</button>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse1.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                  <div class="total-message mt-1 d-flex justify-content-end">
                                    <span class="badge badge-success ">2</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse2.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse3.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                  <div class="total-message mt-1 d-flex justify-content-end">
                                    <span class="badge badge-success ">12</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse4.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse5.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse6.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse7.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse8.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse9.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse10.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse11.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse12.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse13.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse2.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse15.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="tab-pane fade" id="panel_a_third" role="tabpanel" aria-labelledby="third-tab">
                        <ul class="user-list">
                          <li>
                            <div class="user-button-top">
                              <button type="button" class="border bg-normal color-gray rounded-pill content-center"><img class="svg" src="img/svg/user-plus.svg" alt="user-plus">Add New Contact</button>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse1.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                  <div class="total-message mt-1 d-flex justify-content-end">
                                    <span class="badge badge-success ">4</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse2.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse3.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                  <div class="total-message mt-1 d-flex justify-content-end">
                                    <span class="badge badge-success ">24</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse4.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse5.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse6.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offlien"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse7.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse8.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                  <div class="total-message mt-1 d-flex justify-content-end">
                                    <span class="badge badge-success ">3</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse9.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse10.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse11.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse12.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse13.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-offline"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                  <div class="total-message mt-1 d-flex justify-content-end">
                                    <span class="badge badge-success ">3</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse2.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="user-list-item">
                            <div class="user-list-item__wrapper">
                              <div class="avatar avatar-circle ms-0">
                                <img src="img/ellipse15.png" class="rounded-circle wh-46 d-flex bg-opacity-primary" alt="image">
                                <div class="badge-direction-bottom">
                                  <span class="chat-badge-dot avatar-online"></span>
                                </div>
                              </div>
                              <div class="users-list-body">
                                <div class="users-list-body-title">
                                  <h6>Meyri Carles</h6>
                                  <div class="text-limit" data-maxlength="10">
                                    <p class="mb-0"><span>Lorem ipsum dolor us was they amet</span>...</p>
                                  </div>
                                </div>
                                <div class="last-chat-time unread">
                                  <small>14:45 pm</small>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-content" id="ueberTabB">
            <div class="tab-pane fade  show active" id="panel_b_first" role="tabpanel" aria-labelledby="first-tab">
              <div class="chat">
                <div class="chat-body bg-white radius-xl">
                  <div class="chat-header">
                    <div class="media chat-name align-items-center">
                      <div class="media-body align-self-center ">
                        <h5 class=" mb-0 fw-500 mb-2">Domnic Harys</h5>
                        <div class="media-body__content d-flex align-items-center">
                          <span class="badge-dot dot-success me-1"></span>
                          <small class="d-flex color-light fs-12 text-capitalize">
                            active now
                          </small>
                        </div>
                      </div>
                    </div>
                    <ul class="nav flex-nowrap">
                      <li class="nav-item list-inline-item me-0">
                        <div class="dropdown">
                          <a href="#" role="button" title="Details" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="svg" src="img/svg/more-vertical.svg" alt="more-vertical">
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item align-items-center d-flex" href="#" data-chat-info-toggle>
                              <img class="svg" src="img/svg/users.svg" alt="users">
                              <span>Create new group</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/trash-2.svg" alt>
                              <span>Delete conversation</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/x-octagon.svg" alt="x-octagon">
                              <span>Block & report</span>
                            </a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="chat-box chat-box--big p-xl-30 ps-lg-20 pe-lg-0">
                    <div class="flex-1 incoming-chat">
                      <div class="chat-text-box ">
                        <div class="media d-flex">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="social-connector text-center text-capitalize">
                      <span>today</span>
                    </p>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat mt-20">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media d-flex">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna.</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                              <div class="seen-chat d-flex align-items-center  justify-content-end mb-2 mt-10">
                                <div class="chat-text-box__title d-flex align-items-center me-10 ">
                                  <span class="chat-text-box__time fs-12 color-light fw-400">Seen
9:20
PM</span>
                                </div>
                                <img src="img/author/1.jpg" alt="img" class="wh-20 rounded-circle">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media d-flex">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center ">
                                <div class="chat-text-box__subtitle typing cbg-light pe-30">
                                  <p class="color-light text-capitalize">typing...</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="chat-footer px-xl-30 px-lg-20 pb-lg-30 pt-1">
                    <div class="chat-type-text">
                      <div class="pt-0 outline-0 pb-0 pe-0 ps-0 rounded-0 position-relative d-flex align-items-center" tabindex="-1">
                        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                          <div class=" flex-1 d-flex align-items-center chat-type-text__write ms-0">
                            <a href="#">
                              <img class="svg" src="img/svg/smile.svg" alt="smile">
                            </a>
                            <input class="form-control border-0 bg-transparent box-shadow-none" placeholder="Type your message...">
                          </div>
                          <div class="chat-type-text__btn">
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/image.svg" alt="image"></button>
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/paperclip.svg" alt="paperclip"></button>
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
            <div class="tab-pane fade" id="panel_b_second" role="tabpanel" aria-labelledby="second-tab">
              <div class="chat">
                <div class="chat-body bg-white radius-xl">
                  <div class="chat-header ">
                    <div class="media chat-name align-items-center">
                      <div class="media-body align-self-center ">
                        <h5 class=" mb-0 fw-500 text-uppercase">ui/ux group</h5>
                      </div>
                    </div>
                    <div class="image-group">
                      <ul class="d-flex">
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <a href="#" class="bg-primary rounded-circle wh-30 color-white content-center fs-10 fw-500">20+</a>
                        </li>
                        <li>
                          <a href="#" class="border rounded-circle wh-30 color-extra-light content-center">
                            <img src="img/svg/plus.svg" alt="plus" class="svg">
                          </a>
                        </li>
                      </ul>
                    </div>
                    <ul class="nav flex-nowrap">
                      <li class="nav-item list-inline-item d-none d-sm-block me-0">
                        <div class="dropdown">
                          <a href="#" role="button" title="Details" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="svg" src="img/svg/more-vertical.svg" alt="more-vertical">
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item align-items-center d-flex" href="#" data-chat-info-toggle>
                              <img class="svg" src="img/svg/users.svg" alt="users">
                              <span>Create new group</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/trash-2.svg" alt>
                              <span>Delete conversation</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/x-octagon.svg" alt="x-octagon">
                              <span>Block & report</span>
                            </a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="chat-box chat-box--big p-xl-30 ps-lg-20 pe-lg-0">
                    <div class="flex-1 incoming-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="social-connector text-center text-capitalize">
                      <span>today</span>
                    </p>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat mt-20">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna.</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                              <div class="seen-chat seen-chat-group  d-flex align-items-center  justify-content-end mb-2 mt-10">
                                <ul class="d-flex">
                                  <li>
                                    <img src="img/author/1.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                  <li>
                                    <img src="img/author/2.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                  <li>
                                    <img src="img/author/3.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                  <li>
                                    <img src="img/author/4.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                  <li>
                                    <img src="img/author/1.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center ">
                                <div class="chat-text-box__subtitle typing cbg-light pe-30">
                                  <p class="color-light text-capitalize">typing...</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="chat-footer px-xl-30 px-lg-20 pb-lg-30 pt-1">
                    <div class="chat-type-text">
                      <div class="pt-0 outline-0 pb-0 pe-0 ps-0 rounded-0 position-relative d-flex align-items-center" tabindex="-1">
                        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                          <div class=" flex-1 d-flex align-items-center chat-type-text__write ms-0">
                            <a href="#">
                              <img class="svg" src="img/svg/smile.svg" alt="smile"></a>
                            <input class="form-control border-0 bg-transparent" placeholder="Type your message...">
                          </div>
                          <div class="chat-type-text__btn">
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/image.svg" alt="image"></button>
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/paperclip.svg" alt="paperclip"></button>
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
            <div class="tab-pane fade" id="panel_b_thrid" role="tabpanel" aria-labelledby="third-tab">
              <div class="chat">
                <div class="chat-body bg-white radius-xl">
                  <div class="chat-header">
                    <div class="media chat-name align-items-center">
                      <div class="media-body align-self-center ">
                        <h5 class=" mb-0 fw-500 mb-2">Domnic Harys</h5>
                        <div class="d-flex align-items-center">
                          <span class="badge-dot dot-success me-1"></span>
                          <small class="d-flex color-light fs-12 text-capitalize">
                            active now
                          </small>
                        </div>
                      </div>
                    </div>
                    <ul class="nav flex-nowrap">
                      <li class="nav-item list-inline-item d-none d-sm-block me-0">
                        <div class="dropdown">
                          <a href="#" role="button" title="Details" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="svg" src="img/svg/more-vertical.svg" alt="more-vertical">
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item align-items-center d-flex" href="#" data-chat-info-toggle>
                              <img class="svg" src="img/svg/users.svg" alt="users">
                              <span>Create new group</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/trash-2.svg" alt>
                              <span>Delete conversation</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/x-octagon.svg" alt="x-octagon">
                              <span>Block & report</span>
                            </a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="chat-box chat-box--big p-xl-30 ps-lg-20 pe-lg-0">
                    <div class="flex-1 incoming-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="social-connector text-center text-capitalize">
                      <span>today</span>
                    </p>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat mt-20">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna.</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                              <div class="seen-chat d-flex align-items-center  justify-content-end mb-2 mt-10">
                                <div class="chat-text-box__title d-flex align-items-center me-10 ">
                                  <span class="chat-text-box__time fs-12 color-light fw-400">Seen
9:20
PM</span>
                                </div>
                                <img src="img/author/1.jpg" alt="img" class="wh-20 rounded-circle">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center ">
                                <div class="chat-text-box__subtitle typing cbg-light pe-30">
                                  <p class="color-light text-capitalize">typing...</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="chat-footer px-xl-30 px-lg-20 pb-lg-30 pt-1">
                    <div class="chat-type-text">
                      <div class="pt-0 outline-0 pb-0 pe-0 ps-0 rounded-0 position-relative d-flex align-items-center" tabindex="-1">
                        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                          <div class=" flex-1 d-flex align-items-center chat-type-text__write ms-0">
                            <a href="#">
                              <img class="svg" src="img/svg/smile.svg" alt="smile"></a>
                            <input class="form-control border-0 bg-transparent box-shadow-none" placeholder="Type your message...">
                          </div>
                          <div class="chat-type-text__btn">
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/image.svg" alt="image"></button>
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/paperclip.svg" alt="paperclip"></button>
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
   <div class="tab-content" id="ueberTabB">
            <div class="tab-pane fade  show active" id="panel_b_first" role="tabpanel" aria-labelledby="first-tab">
              <div class="chat">
                <div class="chat-body bg-white radius-xl">
                  <div class="chat-header">
                    <div class="media chat-name align-items-center">
                      <div class="media-body align-self-center ">
                        <h5 class=" mb-0 fw-500 mb-2">Domnic Harys</h5>
                        <div class="media-body__content d-flex align-items-center">
                          <span class="badge-dot dot-success me-1"></span>
                          <small class="d-flex color-light fs-12 text-capitalize">
                            active now
                          </small>
                        </div>
                      </div>
                    </div>
                    <ul class="nav flex-nowrap">
                      <li class="nav-item list-inline-item me-0">
                        <div class="dropdown">
                          <a href="#" role="button" title="Details" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="svg" src="img/svg/more-vertical.svg" alt="more-vertical">
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item align-items-center d-flex" href="#" data-chat-info-toggle>
                              <img class="svg" src="img/svg/users.svg" alt="users">
                              <span>Create new group</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/trash-2.svg" alt>
                              <span>Delete conversation</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/x-octagon.svg" alt="x-octagon">
                              <span>Block & report</span>
                            </a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="chat-box chat-box--big p-xl-30 ps-lg-20 pe-lg-0">
                    <div class="flex-1 incoming-chat">
                      <div class="chat-text-box ">
                        <div class="media d-flex">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="social-connector text-center text-capitalize">
                      <span>today</span>
                    </p>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat mt-20">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media d-flex">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna.</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                              <div class="seen-chat d-flex align-items-center  justify-content-end mb-2 mt-10">
                                <div class="chat-text-box__title d-flex align-items-center me-10 ">
                                  <span class="chat-text-box__time fs-12 color-light fw-400">Seen
9:20
PM</span>
                                </div>
                                <img src="img/author/1.jpg" alt="img" class="wh-20 rounded-circle">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media d-flex">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center ">
                                <div class="chat-text-box__subtitle typing cbg-light pe-30">
                                  <p class="color-light text-capitalize">typing...</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="chat-footer px-xl-30 px-lg-20 pb-lg-30 pt-1">
                    <div class="chat-type-text">
                      <div class="pt-0 outline-0 pb-0 pe-0 ps-0 rounded-0 position-relative d-flex align-items-center" tabindex="-1">
                        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                          <div class=" flex-1 d-flex align-items-center chat-type-text__write ms-0">
                            <a href="#">
                              <img class="svg" src="img/svg/smile.svg" alt="smile">
                            </a>
                            <input class="form-control border-0 bg-transparent box-shadow-none" placeholder="Type your message...">
                          </div>
                          <div class="chat-type-text__btn">
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/image.svg" alt="image"></button>
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/paperclip.svg" alt="paperclip"></button>
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
            <div class="tab-pane fade" id="panel_b_second" role="tabpanel" aria-labelledby="second-tab">
              <div class="chat">
                <div class="chat-body bg-white radius-xl">
                  <div class="chat-header ">
                    <div class="media chat-name align-items-center">
                      <div class="media-body align-self-center ">
                        <h5 class=" mb-0 fw-500 text-uppercase">ui/ux group</h5>
                      </div>
                    </div>
                    <div class="image-group">
                      <ul class="d-flex">
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <img src="img/author/1.jpg" alt="img" class="wh-30 rounded-circle">
                        </li>
                        <li>
                          <a href="#" class="bg-primary rounded-circle wh-30 color-white content-center fs-10 fw-500">20+</a>
                        </li>
                        <li>
                          <a href="#" class="border rounded-circle wh-30 color-extra-light content-center">
                            <img src="img/svg/plus.svg" alt="plus" class="svg">
                          </a>
                        </li>
                      </ul>
                    </div>
                    <ul class="nav flex-nowrap">
                      <li class="nav-item list-inline-item d-none d-sm-block me-0">
                        <div class="dropdown">
                          <a href="#" role="button" title="Details" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="svg" src="img/svg/more-vertical.svg" alt="more-vertical">
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item align-items-center d-flex" href="#" data-chat-info-toggle>
                              <img class="svg" src="img/svg/users.svg" alt="users">
                              <span>Create new group</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/trash-2.svg" alt>
                              <span>Delete conversation</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/x-octagon.svg" alt="x-octagon">
                              <span>Block & report</span>
                            </a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="chat-box chat-box--big p-xl-30 ps-lg-20 pe-lg-0">
                    <div class="flex-1 incoming-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="social-connector text-center text-capitalize">
                      <span>today</span>
                    </p>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat mt-20">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna.</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                              <div class="seen-chat seen-chat-group  d-flex align-items-center  justify-content-end mb-2 mt-10">
                                <ul class="d-flex">
                                  <li>
                                    <img src="img/author/1.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                  <li>
                                    <img src="img/author/2.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                  <li>
                                    <img src="img/author/3.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                  <li>
                                    <img src="img/author/4.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                  <li>
                                    <img src="img/author/1.jpg" alt="img" class="wh-20 rounded-circle">
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center ">
                                <div class="chat-text-box__subtitle typing cbg-light pe-30">
                                  <p class="color-light text-capitalize">typing...</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="chat-footer px-xl-30 px-lg-20 pb-lg-30 pt-1">
                    <div class="chat-type-text">
                      <div class="pt-0 outline-0 pb-0 pe-0 ps-0 rounded-0 position-relative d-flex align-items-center" tabindex="-1">
                        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                          <div class=" flex-1 d-flex align-items-center chat-type-text__write ms-0">
                            <a href="#">
                              <img class="svg" src="img/svg/smile.svg" alt="smile"></a>
                            <input class="form-control border-0 bg-transparent" placeholder="Type your message...">
                          </div>
                          <div class="chat-type-text__btn">
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/image.svg" alt="image"></button>
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/paperclip.svg" alt="paperclip"></button>
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
            <div class="tab-pane fade" id="panel_b_thrid" role="tabpanel" aria-labelledby="third-tab">
              <div class="chat">
                <div class="chat-body bg-white radius-xl">
                  <div class="chat-header">
                    <div class="media chat-name align-items-center">
                      <div class="media-body align-self-center ">
                        <h5 class=" mb-0 fw-500 mb-2">Domnic Harys</h5>
                        <div class="d-flex align-items-center">
                          <span class="badge-dot dot-success me-1"></span>
                          <small class="d-flex color-light fs-12 text-capitalize">
                            active now
                          </small>
                        </div>
                      </div>
                    </div>
                    <ul class="nav flex-nowrap">
                      <li class="nav-item list-inline-item d-none d-sm-block me-0">
                        <div class="dropdown">
                          <a href="#" role="button" title="Details" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="svg" src="img/svg/more-vertical.svg" alt="more-vertical">
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item align-items-center d-flex" href="#" data-chat-info-toggle>
                              <img class="svg" src="img/svg/users.svg" alt="users">
                              <span>Create new group</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/trash-2.svg" alt>
                              <span>Delete conversation</span>
                            </a>
                            <a class="dropdown-item align-items-center d-flex" href="#">
                              <img class="svg" src="img/svg/x-octagon.svg" alt="x-octagon">
                              <span>Block & report</span>
                            </a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="chat-box chat-box--big p-xl-30 ps-lg-20 pe-lg-0">
                    <div class="flex-1 incoming-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="social-connector text-center text-capitalize">
                      <span>today</span>
                    </p>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat mt-20">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna aliquyam erat consetetur sadipscing elitr
                                    sed
                                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat sed diam voluptua..</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomRight dropdown-menu-right dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                        <a class="dropdown-item" href="#">remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center">
                                <h6 class="fs-14">Domnic Harys</h6>
                                <span class="chat-text-box__time fs-12 color-light fw-400 ms-15">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center mb-20 mt-10">
                                <div class="chat-text-box__subtitle p-20 bg-primary">
                                  <p class="color-white">Jam nonumy eirmod tempor invidunt ut
                                    labore
                                    et dolore magna.</p>
                                </div>
                                <div class="chat-text-box__other d-flex">
                                  <div class="chat-text-box__reaction px-sm-15 px-2">
                                    <div class="emotions">
                                      <div class="dropdown  dropdown-click ">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <img class="svg" src="img/svg/smile.svg" alt="smile"> </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu">
                                          <ul class="emotions__parent d-flex">
                                            <li>
                                              <a class href="#">
                                                <img src="img/svg/cool.png" alt="emotions">
                                              </a>
                                            </li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy2.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/happy.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/shocked.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/like.png" alt="emotions">
                                              </a></li>
                                            <li><a class href="#">
                                                <img src="img/svg/heart.png" alt="emotions">
                                              </a></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                      <a class="dropdown-item" href="#">Copy</a>
                                      <a class="dropdown-item" href="#">Quote</a>
                                      <a class="dropdown-item" href="#">Forward</a>
                                      <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 justify-content-end d-flex outgoing-chat">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="chat-text-box__title d-flex align-items-center justify-content-end mb-2">
                                <span class="chat-text-box__time fs-12 color-light fw-400">8:30
PM</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-end">
                                <div class="chat-text-box__other d-flex">
                                  <div class="px-15">
                                    <div class="dropdown dropdown-click">
                                      <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="img/svg/more-horizontal.svg" alt="more-horizontal" class="svg">
                                      </button>
                                      <div class="dropdown-default dropdown-bottomLeft dropdown-menu-left dropdown-menu" style>
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Quote</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-text-box__subtitle p-20 bg-deep">
                                  <p class="color-gray">Jam nonumy eirmod tempor invidunt ut
                                    labore et
                                    dolore magna.</p>
                                </div>
                              </div>
                              <div class="seen-chat d-flex align-items-center  justify-content-end mb-2 mt-10">
                                <div class="chat-text-box__title d-flex align-items-center me-10 ">
                                  <span class="chat-text-box__time fs-12 color-light fw-400">Seen
9:20
PM</span>
                                </div>
                                <img src="img/author/1.jpg" alt="img" class="wh-20 rounded-circle">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 incoming-chat mt-30">
                      <div class="chat-text-box">
                        <div class="media ">
                          <div class="chat-text-box__photo ">
                            <img src="img/author/1.jpg" class="align-self-start me-15 wh-46" alt="img">
                          </div>
                          <div class="media-body">
                            <div class="chat-text-box__content">
                              <div class="d-flex align-items-center ">
                                <div class="chat-text-box__subtitle typing cbg-light pe-30">
                                  <p class="color-light text-capitalize">typing...</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="chat-footer px-xl-30 px-lg-20 pb-lg-30 pt-1">
                    <div class="chat-type-text">
                      <div class="pt-0 outline-0 pb-0 pe-0 ps-0 rounded-0 position-relative d-flex align-items-center" tabindex="-1">
                        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                          <div class=" flex-1 d-flex align-items-center chat-type-text__write ms-0">
                            <a href="#">
                              <img class="svg" src="img/svg/smile.svg" alt="smile"></a>
                            <input class="form-control border-0 bg-transparent box-shadow-none" placeholder="Type your message...">
                          </div>
                          <div class="chat-type-text__btn">
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/image.svg" alt="image"></button>
                            <button type="button" class="border-0 btn-deep color-light wh-50 p-10 rounded-circle">
                              <img class="svg" src="img/svg/paperclip.svg" alt="paperclip"></button>
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



  </body>

  
</html>