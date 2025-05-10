<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Announcements - ACCESS Admin Dashboard</title>
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
      <a href="events.php" class="nav-link">
        <i class="bi bi-calendar-event"></i> <span>Events</span>
      </a>
      <a href="attendance.php" class="nav-link">
        <i class="bi bi-person-check"></i> <span>Attendance</span>
      </a>
      <a href="announcements.php" class="nav-link active">
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
      <h1 class="h3 mb-0">Announcements</h1>
      
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
    
    <!-- Announcements content -->
    <div class="container-fluid px-0">
      <!-- Actions bar -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0">Announcements List</h5>
              <div class="d-flex">
                <div class="input-group me-3" style="max-width: 300px;">
                  <input type="text" class="form-control" placeholder="Search announcements...">
                  <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                  <i class="bi bi-plus-circle me-1"></i> Create Announcement
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Filters and stats -->
      <div class="row mb-4">
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Announcement Filters</h5>
              <div class="row g-3">
                <div class="col-md-4">
                  <select class="form-select">
                    <option selected>All Categories</option>
                    <option>Event</option>
                    <option>Academic</option>
                    <option>Club Notice</option>
                    <option>Competition</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select class="form-select">
                    <option selected>All Status</option>
                    <option>Active</option>
                    <option>Pending</option>
                    <option>Closed</option>
                    <option>Draft</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="month" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Announcements Overview</h5>
              <div class="row text-center">
                <div class="col-4">
                  <h3 class="text-success">5</h3>
                  <p class="text-muted small mb-0">Active</p>
                </div>
                <div class="col-4">
                  <h3 class="text-warning">2</h3>
                  <p class="text-muted small mb-0">Pending</p>
                </div>
                <div class="col-4">
                  <h3 class="text-info">16</h3>
                  <p class="text-muted small mb-0">Total</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Announcements table -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="selectAll">
                          <label class="form-check-label" for="selectAll"></label>
                        </div>
                      </th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Posted Date</th>
                      <th>End Date</th>
                      <th>Posted By</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>
                        <span class="fw-medium">General Assembly Notice</span>
                      </td>
                      <td><span class="badge bg-info">Club Notice</span></td>
                      <td>May 03, 2025</td>
                      <td>May 15, 2025</td>
                      <td>Admin User</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Actions
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-down-circle me-2"></i> Deactivate</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>
                        <span class="fw-medium">Club Shirt Distribution</span>
                      </td>
                      <td><span class="badge bg-success">Event</span></td>
                      <td>April 30, 2025</td>
                      <td>May 10, 2025</td>
                      <td>Admin User</td>
                      <td><span class="badge bg-secondary">Closed</span></td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Actions
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-up-circle me-2"></i> Reactivate</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>
                        <span class="fw-medium">Seminar Registration</span>
                      </td>
                      <td><span class="badge bg-success">Event</span></td>
                      <td>April 28, 2025</td>
                      <td>May 10, 2025</td>
                      <td>Admin User</td>
                      <td><span class="badge bg-warning text-dark">Pending</span></td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Actions
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i> Activate</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>
                        <span class="fw-medium">Code Camp 2025 Applications Open</span>
                      </td>
                      <td><span class="badge bg-primary">Competition</span></td>
                      <td>April 25, 2025</td>
                      <td>May 25, 2025</td>
                      <td>Admin User</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Actions
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-down-circle me-2"></i> Deactivate</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>
                        <span class="fw-medium">Winter Coding Bootcamp</span>
                      </td>
                      <td><span class="badge bg-success">Event</span></td>
                      <td>April 20, 2025</td>
                      <td>May 20, 2025</td>
                      <td>Admin User</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Actions
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-down-circle me-2"></i> Deactivate</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <!-- Pagination -->
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                  <span class="text-muted">Showing 1 to 5 of 16 entries</span>
                </div>
                <nav>
                  <ul class="pagination mb-0">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Announcement Preview -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-4">Announcement Preview</h5>
              <div class="alert alert-info mb-0">
                <i class="bi bi-info-circle me-2"></i> Select an announcement from the list above to preview its content here.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Add Announcement Modal -->
  <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAnnouncementModalLabel">Create New Announcement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row mb-3">
              <div class="col-md-8">
                <label class="form-label">Announcement Title</label>
                <input type="text" class="form-control" placeholder="Enter announcement title">
              </div>
              <div class="col-md-4">
                <label class="form-label">Category</label>
                <select class="form-select">
                  <option selected>Select category</option>
                  <option>Event</option>
                  <option>Academic</option>
                  <option>Club Notice</option>
                  <option>Competition</option>
                  <option>Other</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Content</label>
              <textarea class="form-control" rows="6" placeholder="Compose announcement content..."></textarea>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Priority Level</label>
                <select class="form-select">
                  <option>Low</option>
                  <option selected>Normal</option>
                  <option>High</option>
                  <option>Urgent</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Status</label>
                <select class="form-select">
                  <option selected>Active</option>
                  <option>Pending</option>
                  <option>Draft</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Attachments</label>
              <input type="file" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Post Announcement</button>
        </div>
      </div>
    </div>
  </div>

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