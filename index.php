<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nairobi Beauty</title>
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="images/thikalogo2.png" />
  <style>
    .dashboard-card {
      border-radius: 15px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .dashboard-card p {
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }
    .dashboard-card a p {
      font-size: 1.5rem;
      font-weight: bold;
      color: #ffffff;
    }
    .dashboard-title {
      font-size: 1.75rem;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    <!-- Navbar -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/thikalogo2.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="index.php?logout='1'">
                <i class="ti-power-off text-primary"></i> Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>

    <!-- Page body -->
    <div class="container-fluid page-body-wrapper">
      <!-- Sidebar -->
      <?php include 'partials/sidebar.php' ?>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row mb-4">
            <div class="col-12 col-xl-8">
              <h3 class="dashboard-title">Welcome Admin</h3>
            </div>
          </div>

          <!-- Cards Grid -->
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="card dashboard-card bg-primary text-white">
                <div class="card-body">
                  <p>Customers</p>
                  <a href="approvedcustomers.php"><p>View</p></a>
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="card dashboard-card bg-dark text-white">
                <div class="card-body">
                  <p>Staff Members</p>
                  <a href="allstaff.php"><p>View</p></a>
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="card dashboard-card bg-info text-white">
                <div class="card-body">
                  <p>Suppliers</p>
                  <a href="suppliers.php"><p>View</p></a>
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="card dashboard-card bg-success text-white">
                <div class="card-body">
                  <p>Order Records</p>
                  <a href="allorders.php"><p>View</p></a>
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="card dashboard-card bg-danger text-white">
                <div class="card-body">
                  <p>Payment Records</p>
                  <a href="allpayments.php"><p>View</p></a>
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="card dashboard-card bg-secondary text-white">
                <div class="card-body">
                  <p>Completed Trainees</p>
                  <a href="completedservices.php"><p>View</p> </a>  <!-- <a href="allbookings.php"><p>View</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
              Copyright ©2025 Nairobi Beauty. All rights reserved
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
</body>

</html>
