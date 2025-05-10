<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendance Management - ACCESS Admin Dashboard</title>
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
            <a href="members.php" class="nav-link">
                <i class="bi bi-people"></i> <span>Members</span>
            </a>
           <a href="services.php" class="nav-link ">
        <i class="bi bi-tools"></i> <span>Services</span>
      </a>
            <a href="attendance.php" class="nav-link active">
                <i class="bi bi-person-check"></i> <span>Attendance</span>
            </a>
            <a href="announcements.php" class="nav-link">
                <i class="bi bi-megaphone"></i> <span>Announcements</span>
            </a>
            <a href="gallery.htmlphp" class="nav-link">
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
        <header class="page-header d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Attendance Management</h1>
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

        <div class="container-fluid px-0">
            <!-- Event Selection -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="eventSelect" class="form-label">Select Event</label>
                            <select class="form-select" id="eventSelect">
                                <option value="">Choose an event...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="dateFilter" class="form-label">Date</label>
                            <input type="date" class="form-control" id="dateFilter">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary mt-4" onclick="loadAttendance()">
                                <i class="bi bi-search me-2"></i>Load Attendance
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="attendanceTable">
                            <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Student ID</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Time In</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Attendance data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Attendance Status Modal -->
    <div class="modal fade" id="attendanceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Attendance Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="attendanceForm">
                        <input type="hidden" id="attendanceId">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="attendanceStatus">
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="late">Late</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remarks</label>
                            <textarea class="form-control" id="attendanceRemarks" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updateAttendance()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/attendance.js"></script>
</body>
</html> 