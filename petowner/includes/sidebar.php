<?php
  require('../pages/session.php');
  confirm_logged_in();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>VetTalk</title>
  <link rel="icon" href="https://www.freeiconspng.com/uploads/animal-paw-vector-icon-animals-icons-icons-download-0.png">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
          
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-solid fa-paw"></i>
        </div>
        <div class="sidebar-brand-text mx-3">VETTALK</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Tables
      </div>
      <!-- Tables Buttons -->
      <li class="nav-item">
        <a class="nav-link" href="cust_searchfrm.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pet.php" data-toggle="collapse" data-target="#collapsePets"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-paw"></i>
          <span>Pets</span>
        </a>
         
        <div id="collapsePets" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="pet.php">Dogs</a>
            <a class="collapse-item" href="pet1.php">Cats</a>
            
          </div>
        </div>
        
      </li>

      <li class="nav-item">
        <a class="nav-link" href="vacc_sched.php">
          <i class="fas fa-fw fa-list"></i>
          <span>Vaccination Schedule</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="calendar.php" data-toggle="collapse" data-target="#collapseAppointment"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-clipboard"></i>
          <span>My Appointments</span>
        </a>
         
        <div id="collapseAppointment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="calendar.php">Book Vet Appointment</a>
            <a class="collapse-item" href="bookings.php">Veterinary Appointments </a>
            <a class="collapse-item" href="bookings_lab.php">Laboratory Appointments </a>
            
          </div>
        </div>
        
      </li>

      <li class="nav-item">
        <a class="nav-link" href="transaction.php">
          <i class="fas fa-fw fa-retweet"></i>
          <span>Transaction</span></a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="documents.php">
          <i class="fas fa-fw fa-file"></i>
          <span>Documents / Files</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <?php include_once 'topbar.php'; ?>
