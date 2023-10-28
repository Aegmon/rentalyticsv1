<?php include('../connection.php')?>
<!doctype html>
<html lang="en" dir="ltr">

  <!-- Mirrored from demo.dashboardmarket.com/hexadash-html/ltr/demo6.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Oct 2023 01:02:49 GMT -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentalytics | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/plugin.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <link rel="stylesheet" href="unicons.iconscout.com/release/v4.0.0/css/line.css">
  </head>
  <body class="layout-light side-menu">
    <div class="mobile-search">
      <form action="http://demo.dashboardmarket.com/" class="search-form">
        <img src="img/svg/search.svg" alt="search" class="svg">
        <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="Search..." aria-label="Search">
      </form>
    </div>
    <div class="mobile-author-actions"></div>
    <header class="header-top">
      <nav class="navbar navbar-light">
        <div class="navbar-left">
          <div class="logo-area">
            <a class="navbar-brand" href="index-2.html">
              <!-- <img class="dark" src="img/logo-dark.png" alt="logo">
              <img class="light" src="img/logo-white.png" alt="logo"> -->
              <h3>Rentalytics Logo</h3>
            </a> 
            <a href="#" class="sidebar-toggle">
              <img class="svg" src="img/svg/align-center-alt.svg" alt="img"></a>
          </div>
      
        </div>
        <div class="navbar-right">
          <ul class="navbar-right__menu">
         
       
          
          
            <li class="nav-author">
              <div class="dropdown-custom">
                <a href="javascript:;" class="nav-item-toggle"><img src="img/author-nav.jpg" alt class="rounded-circle">
                  <span class="nav-item__title">Adminstrator<i class="las la-angle-down nav-item__arrow"></i></span>
                </a>
                <div class="dropdown-parent-wrapper">
                  <div class="dropdown-wrapper">
                    <div class="nav-author__info">
                      <div class="author-img">
                        <img src="img/author-nav.jpg" alt class="rounded-circle">
                      </div>
                      <div>
                        <h6>John Doe</h6>
                        <span>Admin</span>
                      </div>
                    </div>
                    <div class="nav-author__options">
                      <ul>
                        
                     
                      
                       
                      </ul>
                      <a href="../logout.php" class="nav-author__signout">
                        <i class="uil uil-sign-out-alt"></i> Sign Out</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <div class="navbar-right__mobileAction d-md-none">
            <!-- <a href="#" class="btn-search">
              <img src="img/svg/search.svg" alt="search" class="svg feather-search">
              <img src="img/svg/x.svg" alt="x" class="svg feather-x"></a>
            <a href="#" class="btn-author-action">
              <img class="svg" src="img/svg/more-vertical.svg" alt="more-vertical"></a> -->
          </div>
        </div>
      </nav>
    </header>
    <main class="main-content">
      <div class="sidebar-wrapper">
        <div class="sidebar sidebar-collapse" id="sidebar">
          <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
           
             
              <li>
                <a href="index.php" class>
                     <span class="nav-icon uil uil-create-dashboard"></span>
                  <span class="menu-text">Dashboard</span>
                 
                </a>
               </li>
                  <li>
                <a href="accounts.php" class>
                           <i class="nav-icon uil uil-users-alt"></i>
                  <span class="menu-text">Manage Accounts</span>
                 
                </a>
               </li>
            </ul>
          </div>
        </div>
      </div>