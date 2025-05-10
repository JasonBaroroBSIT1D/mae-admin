<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Members - ACCESS Admin Dashboard</title>
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
      <a href="index.php" class="nav-link">
        <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
      </a>
      <a href="members.php" class="nav-link active">
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
      <a href="login.php" class="btn btn-outline-light btn-sm w-100 mt-3">
        <i class="bi bi-box-arrow-right me-1"></i> Log Out
      </a>
    </div>
  </aside>

  <!-- Main content area -->
  <main class="main-content">
    <!-- Page header -->
    <header class="page-header d-flex justify-content-between align-items-center">
      <h1 class="h3 mb-0">Members Management</h1>
     
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
    
    <!-- Members content -->
    <div class="container-fluid px-0">
      <!-- Actions bar -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0">Members Directory</h5>
              <div class="d-flex">
                <div class="input-group me-3" style="max-width: 300px;">
                  <input type="text" class="form-control" placeholder="Search members...">
                  <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                  <i class="bi bi-person-plus me-1"></i> Add Member
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
     
      
      <!-- Filters row -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-3">
                  <select class="form-select">
                    <option selected>All Departments</option>
                    <option>BSIT</option>
                    <option>BTLED-IA</option>
                    <option>BTLED-HE</option>
                    <option>BTLED-ICT</option>
                    <option>BFPT/option>
                  </select>
                </div>
                <div class="col-md-3">
                  <select class="form-select">
                    <option selected>All Member Types</option>
                    <option>Student Member</option>
                    <option>Faculty Member</option>
                    <option>Industry Partner</option>
                    <option>Alumni</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <select class="form-select">
                    <option selected>All Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                    <option>Pending</option>
                    <option>Suspended</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-outline-secondary w-100">
                    <i class="bi bi-funnel me-1"></i> Apply Filters
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Members table -->
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead class="table-light">
                    <tr>
                      <th scope="col">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="selectAll">
                          <label class="form-check-label" for="selectAll"></label>
                        </div>
                      </th>
                      <th scope="col">Name</th>
                      <th scope="col">Department</th>
                      <th scope="col">Type</th>
                      <th scope="col">Joined</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    
  </main>
  
  <!-- Add Member Modal -->
  <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMemberModalLabel">Add New Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" required>
              </div>
              <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
              </div>
              <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="department" class="form-label">Department</label>
                <select class="form-select" id="department" required>
                  <option value="" selected disabled>Select Department</option>
                  <option>BSIT</option>
                  <option>BTLED-IA</option>
                  <option>BTLED-HE</option>
                  <option>BTLED-ICT</option>
                  <option>BFPT</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="memberType" class="form-label">Member Type</label>
                <select class="form-select" id="memberType" required>
                  <option value="" selected disabled>Select Member Type</option>
                  <option>Student Member</option>
                  <option>Faculty Member</option>
                  <option>Industry Partner</option>
                  <option>Alumni</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="profileImage" class="form-label">Profile Image</label>
              <input class="form-control" type="file" id="profileImage">
            </div>
            <div class="mb-3">
              <label for="memberBio" class="form-label">Bio/Description</label>
              <textarea class="form-control" id="memberBio" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="sendWelcomeEmail" checked>
                <label class="form-check-label" for="sendWelcomeEmail">
                  Send welcome email with login credentials
                </label>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Add Member</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap & jQuery JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <script>
    // Select all checkbox functionality
    document.getElementById('selectAll').addEventListener('change', function() {
      const checkboxes = document.querySelectorAll('tbody .form-check-input');
      checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
      });
    });
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>
</body>
</html>