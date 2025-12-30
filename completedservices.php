<?php
session_start();
//error_reporting(E_ERROR);
include('include/connections.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nairobi Beauty</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/thikalogo2.png" />
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/extra-libs/DataTables/datatables.min.css">
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include 'partials/navbar.php' ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php include 'partials/sidebar.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Completed Trainees</h4>

                  <!-- Print Button -->
                  <button onclick="printTable()" class="btn btn-primary mb-3">🖨️ Print</button>

                  <div id="print-section">
                    <table id="zero_config" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#No</th>
                          <th>Trainee Name</th>
                          <th>Course</th>
                          <th>Study Mode</th>
                          <th>Fee</th>
                          <th>Rating</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $select = "SELECT * FROM clients c INNER JOIN bookings o on c.client_id = o.client_id
                          RIGHT JOIN service_payment p on o.booking_id = p.booking_id WHERE o.booking_status IN ('3','4')";
                        $query = mysqli_query($con, $select);
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                          <tr class="odd gradeX">
                            <td><?php echo $row['booking_id'] ?></td>
                            <td><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                            <td><?php echo $row['course'] ?></td>
                            <td><?php echo $row['study_mode'] ?></td>
                            <td><?php echo $row['fee'] ?></td>
                            <td><?php echo $row['rating'] ?></td>
                            <td>Completed</td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include 'partials/footer.php' ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- Print Script -->
  <script>
    function printTable() {
      var divToPrint = document.getElementById("print-section");
      var newWin = window.open('', 'Print-Window');
      newWin.document.open();
      newWin.document.write('<html><head><title>Print Table</title>');
      newWin.document.write('<link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">');
      newWin.document.write('<style>table { border-collapse: collapse; width: 100%; } th, td { border: 1px solid #000; padding: 8px; }</style>');
      newWin.document.write('</head><body onload="window.print()">');
      newWin.document.write(divToPrint.innerHTML);
      newWin.document.write('</body></html>');
      newWin.document.close();
    }
  </script>

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- DataTables -->
  <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
  <script>
    $('#zero_config').DataTable();
  </script>
</body>

</html>
