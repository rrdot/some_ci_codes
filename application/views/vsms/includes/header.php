<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vital Signs Monitoring System</title>

  <link rel="stylesheet" type="text/css" href="<?php  echo base_url();?>bootstrap/css/bootstrap.css">

  <!-- Custom fonts for this template-->
  <link href="<?php  echo base_url();?>template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php  echo base_url();?>template/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php  echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url();?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Vital Signs Monitoring System</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url();?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Vital Signs</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
    

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
          <i class="fas fa-fw fa-cog"></i>
          <span>User</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php  echo site_url('viewusers');?>">User Accounts</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoom" aria-expanded="true" aria-controls="collapseRoom">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Rooms</span>
          </a>
          <div id="collapseRoom" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?php  echo site_url('viewrooms');?>">View Rooms</a>
              <a class="collapse-item" href="<?php  echo site_url('addroompage');?>">Add Room</a>
            </div>
          </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Device</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php  echo site_url('viewdevices');?>">View Devices</a>
            <a class="collapse-item" href="<?php  echo site_url('adddevicepage');?>">Add Device</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Patient</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php  echo site_url('viewpatients');?>">View Patients</a>
            <a class="collapse-item" href="<?php  echo site_url('addpatientpage');?>">Add Patient</a>
          </div>
        </div>
      </li>

      
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo site_url('logout');?>">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Logout</span>
        </a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar 
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

         
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
        </nav> -->  

        <nav class="navbar navbar-expand navbar-light bg-white static-top shadow">

         
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
        </nav>