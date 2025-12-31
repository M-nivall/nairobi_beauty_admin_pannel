<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Customers</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="newcustomers.php">Pending Approval</a></li>
                <li class="nav-item"> <a class="nav-link" href="approvedcustomers.php">Approved</a></li>
                 <li class="nav-item"> <a class="nav-link" href="rejectedcustomers.php">Rejected</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Payments</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="newpayments.php">Pending Approval</a></li>
                <li class="nav-item"><a class="nav-link" href="approvedpayments.php">Approved</a></li>
                  <li class="nav-item"><a class="nav-link" href="rejectedpayments.php">Rejected</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Orders</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="neworders.php">Pending Approval</a></li>
                <li class="nav-item"> <a class="nav-link" href="approvedorders.php">Approved</a></li>
                <li class="nav-item"> <a class="nav-link" href="ordersshipping.php">Under Shippment</a></li>
                <li class="nav-item"> <a class="nav-link" href="deliveredorders.php">Delivered</a></li>
                <li class="nav-item"> <a class="nav-link" href="rejectedorders.php">Rejected</a></li>
              </ul>
            </div>
          </li>

            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts2" aria-expanded="false" aria-controls="charts2">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Supply Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="newsupply.php">New Supply Requests</a></li>
                <li class="nav-item"> <a class="nav-link" href="approvedsupply.php">Approved Supplies</a></li>
                <li class="nav-item"> <a class="nav-link" href="completedsupply.php">Received Supplies</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Trainee Sessions</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="newbookings.php">New Bookings</a></li>
                <li class="nav-item"> <a class="nav-link" href="assignedtechnician.php">In Pgrogress</a></li>
                <li class="nav-item"> <a class="nav-link" href="completedservices.php">Completed Sessions</a></li>
              </ul>
            </div>
          </li>
        </ul>
        
      </nav>