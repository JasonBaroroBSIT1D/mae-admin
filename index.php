<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Check if login form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "config/database.php";
        
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            
            if($stmt->execute()) {
                if($stmt->rowCount() == 1) {
                    if($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        
                        if(password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            // Redirect to dashboard
                            header("location: index.php");
                            exit;
                        } else {
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid username or password.";
                }
            } else {
                $login_err = "Oops! Something went wrong. Please try again later.";
            }
            
            unset($stmt);
        }
    }
    
    // If not logged in, show login page
    include 'login.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACCESS Admin Dashboard - USTP Oroquieta</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="styles.css">
  
</head>
<body>
  <!-- Sidebar navigation -->
  <aside class="sidebar">
    <div class="logo-container">
      <img src="ACCESS.jpg" alt="ACCESS Organization Logo" class="logo">
      <h5 class="mt-3 text-white">ACCESS</h5>
      <p class="text-muted small">Admin Panel</p>
    </div>
    
    <nav class="nav flex-column mb-auto">
      <a href="index.php" class="nav-link active">
        <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
      </a>
      <a href="members.php" class="nav-link">
        <i class="bi bi-people"></i> <span>Members</span>
      </a>
     <a href="services.php" class="nav-link ">
        <i class="bi bi-tools"></i> <span>Services</span>
      </a>
      <a href="attendance.php" class="nav-link">
        <i class="bi bi-person-check"></i> <span>Attendance</span>
      </a>
      <a href="announcements.php" class="nav-link">
        <i class="bi bi-megaphone"></i> <span>Announcements</span>
      </a>
      <a href="gallery.php" class="nav-link">
        <i class="bi bi-images"></i> <span>Gallery</span>
      </a>
      <a href="reports.php" class="nav-link">
        <i class="bi bi-file-earmark-bar-graph"></i> <span>Reports</span>
      </a>
      <a href="feedback.php" class="nav-link">
        <i class="bi bi-chat-square-text"></i> <span>Feedback</span>
      </a>
    </nav>
    
    <div class="user-container">
      <img src="ACCESS.jpg" alt="Admin User" class="user-image">
      <h6 class="mb-0 text-white">Admin User</h6>
      <small class="text-white-50">Administrator</small>
      <a href="logout.php" class="btn btn-outline-light btn-sm w-100 mt-3">
        <i class="bi bi-box-arrow-right me-1"></i> Log Out
      </a>
    </div>
  </aside>

  <!-- Main content area -->
  <main class="main-content">
    <!-- Page header -->
    <header class="page-header d-flex justify-content-between align-items-center">
      <h1 class="h3 mb-0">Admin Dashboard</h1>
     
        <div class="dropdown">
          <button class="btn btn-light d-flex align-items-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="ACCESS.jpg" alt="Admin" class="rounded-circle me-2" width="32" height="32">
            <span>Administrator</span>
            <i class="bi bi-chevron-down ms-2"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="login.php"><i class="bi bi-box-arrow-right me-2"></i> Log Out</a></li>
          </ul>
        </div>
      </div>
    </header>
    
    <!-- Dashboard content -->
    <div class="container-fluid px-0">
      <!-- Welcome banner -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="bg-primary text-white rounded-3 p-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h2 class="fw-bold">Welcome back, Administrator!</h2>
                <p class="mb-0">Here's what's happening with ACCESS organization today.</p>
              </div>
              <i class="bi bi-stars display-4"></i>
            </div>
          </div>
        </div>
      </div>
      
     
      </section>
      
      <div class="row g-4 mb-4">
        <!-- Recent events table -->
        <div class="col-lg-6">
          <div class="table-container h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h2 class="h4 mb-0">Recent Events</h2>
              <a href="events.html" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-eye me-1"></i> View All
              </a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Attendance</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-primary rounded text-white p-2 me-2">
                          <i class="bi bi-code-slash"></i>
                        </div>
                        <span>Web Development Workshop</span>
                      </div>
                    </td>
                    <td>April 22, 2025</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 7px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 84%"></div>
                        </div>
                        <span class="ms-2">42/50</span>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="View Details">
                          <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit Event">
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-info rounded text-white p-2 me-2">
                          <i class="bi bi-people"></i>
                        </div>
                        <span>Club Meeting</span>
                      </div>
                    </td>
                    <td>April 24, 2025</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 7px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 84%"></div>
                        </div>
                        <span class="ms-2">38/45</span>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="View Details">
                          <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit Event">
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-warning rounded text-white p-2 me-2">
                          <i class="bi bi-trophy"></i>
                        </div>
                        <span>Programming Contest</span>
                      </div>
                    </td>
                    <td>May 01, 2025</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 7px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 83%"></div>
                        </div>
                        <span class="ms-2">25/30</span>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="View Details">
                          <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit Event">
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-success rounded text-white p-2 me-2">
                          <i class="bi bi-cpu"></i>
                        </div>
                        <span>Tech Talk: AI Fundamentals</span>
                      </div>
                    </td>
                    <td>May 05, 2025</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 7px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 88%"></div>
                        </div>
                        <span class="ms-2">35/40</span>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="View Details">
                          <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit Event">
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <!-- Latest announcements -->
        <div class="col-lg-6">
          <div class="table-container h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h2 class="h4 mb-0">Latest Announcements</h2>
              <a href="announcements.html" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-eye me-1"></i> View All
              </a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Posted Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>General Assembly Notice</td>
                <td>May 03, 2025</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="View Announcement">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit Announcement">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Club Shirt Distribution</td>
                <td>April 30, 2025</td>
                <td><span class="badge bg-secondary">Closed</span></td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="View Announcement">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit Announcement">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Seminar Registration</td>
                <td>April 28, 2025</td>
                <td><span class="badge bg-warning text-dark">Pending</span></td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="View Announcement">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit Announcement">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</main>

<!-- Bootstrap JS Bundle (with Popper for dropdowns/tooltips) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom script (optional, for tooltips or interactivity) -->
<script>
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
  new bootstrap.Tooltip(el);
});
</script>
</body>
</html>
