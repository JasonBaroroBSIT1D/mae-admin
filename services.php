<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Services - ACCESS Admin Dashboard</title>
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
      <a href="services.php" class="nav-link active">
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

  <!-- Main content -->
  <main class="content">
     <header class="page-header d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Feedback Management</h1>
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
    
    <!-- Page header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h1 class="page-title">Services Management</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Services</li>
            </ol>
          </nav>
        </div>
        <div class="col-auto">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="bi bi-plus-circle me-1"></i> Add New Service
          </button>
        </div>
      </div>
    </div>

    <!-- Service categories card -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">Service Categories</h5>
        <div class="row g-3">
          <div class="col-md-4">
            <div class="p-3 border rounded bg-light d-flex align-items-center">
              <div class="icon-box bg-primary text-white">
                <i class="bi bi-house-door"></i>
              </div>
              <div class="ms-3">
                <h6 class="mb-1">Housing Assistance</h6>
                <p class="mb-0 small text-muted">8 active services</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-3 border rounded bg-light d-flex align-items-center">
              <div class="icon-box bg-success text-white">
                <i class="bi bi-book"></i>
              </div>
              <div class="ms-3">
                <h6 class="mb-1">Educational Support</h6>
                <p class="mb-0 small text-muted">12 active services</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-3 border rounded bg-light d-flex align-items-center">
              <div class="icon-box bg-info text-white">
                <i class="bi bi-heart-pulse"></i>
              </div>
              <div class="ms-3">
                <h6 class="mb-1">Health Services</h6>
                <p class="mb-0 small text-muted">5 active services</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Service requests stats -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card stats-card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="icon-box bg-primary-light text-primary">
                <i class="bi bi-clipboard-check"></i>
              </div>
              <div class="ms-3">
                <h6 class="mb-0">Total Requests</h6>
                <h3 class="mb-0">124</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card stats-card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="icon-box bg-warning-light text-warning">
                <i class="bi bi-hourglass-split"></i>
              </div>
              <div class="ms-3">
                <h6 class="mb-0">Pending</h6>
                <h3 class="mb-0">28</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card stats-card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="icon-box bg-success-light text-success">
                <i class="bi bi-check-circle"></i>
              </div>
              <div class="ms-3">
                <h6 class="mb-0">Completed</h6>
                <h3 class="mb-0">96</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Service tabs -->
    <div class="card mb-4">
      <div class="card-body">
        <ul class="nav nav-tabs" id="serviceTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">
              All Services
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">
              Pending
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button">
              Approved
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="declined-tab" data-bs-toggle="tab" data-bs-target="#declined" type="button">
              Declined
            </button>
          </li>
        </ul>
        
        <div class="tab-content pt-3" id="serviceTabsContent">
          <div class="tab-pane fade show active" id="all" role="tabpanel">
            <!-- Service requests table -->
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Category</th>
                    <th>Requester</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="serviceRequests">
                  <!-- Service requests will be loaded dynamically -->
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="tab-pane fade" id="pending" role="tabpanel">
            <!-- Pending service requests table -->
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Category</th>
                    <th>Requester</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="pendingRequests">
                  <!-- Pending requests will be loaded dynamically -->
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="tab-pane fade" id="approved" role="tabpanel">
            <!-- Approved service requests table -->
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Category</th>
                    <th>Requester</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="approvedRequests">
                  <!-- Approved requests will be loaded dynamically -->
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="tab-pane fade" id="declined" role="tabpanel">
            <!-- Declined service requests table -->
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Category</th>
                    <th>Requester</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="declinedRequests">
                  <!-- Declined requests will be loaded dynamically -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Add Service Modal -->
  <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addServiceForm">
            <div class="mb-3">
              <label for="serviceName" class="form-label">Service Name</label>
              <input type="text" class="form-control" id="serviceName" required>
            </div>
            <div class="mb-3">
              <label for="serviceCategory" class="form-label">Category</label>
              <select class="form-select" id="serviceCategory" required>
                <option value="">Select Category</option>
                <option value="Housing Assistance">Housing Assistance</option>
                <option value="Educational Support">Educational Support</option>
                <option value="Health Services">Health Services</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="serviceDescription" class="form-label">Description</label>
              <textarea class="form-control" id="serviceDescription" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="serviceAvailability" class="form-label">Availability</label>
              <select class="form-select" id="serviceAvailability" required>
                <option value="Available">Available</option>
                <option value="Limited">Limited</option>
                <option value="Unavailable">Unavailable</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="saveServiceBtn">Save Service</button>
        </div>
      </div>
    </div>
  </div>

  <!-- View Service Details Modal -->
  <div class="modal fade" id="viewServiceModal" tabindex="-1" aria-labelledby="viewServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewServiceModalLabel">Service Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="serviceDetailsContent">
          <!-- Service details will be loaded here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Sample service request data
      const serviceRequests = [
        { id: 'SRV001', serviceName: 'Housing Application Assistance', category: 'Housing Assistance', requester: 'John Doe', date: '2023-10-15', status: 'Pending' },
        { id: 'SRV002', serviceName: 'Tutoring Services', category: 'Educational Support', requester: 'Jane Smith', date: '2023-10-14', status: 'Approved' },
        { id: 'SRV003', serviceName: 'Mental Health Counseling', category: 'Health Services', requester: 'Mike Johnson', date: '2023-10-13', status: 'Pending' },
        { id: 'SRV004', serviceName: 'Scholarship Application Help', category: 'Educational Support', requester: 'Sarah Williams', date: '2023-10-12', status: 'Approved' },
        { id: 'SRV005', serviceName: 'Emergency Housing', category: 'Housing Assistance', requester: 'Robert Brown', date: '2023-10-11', status: 'Declined' },
        { id: 'SRV006', serviceName: 'Medical Referral', category: 'Health Services', requester: 'Lisa Davis', date: '2023-10-10', status: 'Pending' }
      ];

      // Populate all service requests table
      const allRequestsTable = document.getElementById('serviceRequests');
      serviceRequests.forEach(request => {
        const row = document.createElement('tr');
        let statusBadge = '';
        
        switch(request.status) {
          case 'Pending':
            statusBadge = '<span class="badge bg-warning">Pending</span>';
            break;
          case 'Approved':
            statusBadge = '<span class="badge bg-success">Approved</span>';
            break;
          case 'Declined':
            statusBadge = '<span class="badge bg-danger">Declined</span>';
            break;
        }
        
        row.innerHTML = `
          <td>${request.id}</td>
          <td>${request.serviceName}</td>
          <td>${request.category}</td>
          <td>${request.requester}</td>
          <td>${request.date}</td>
          <td>${statusBadge}</td>
          <td>
            <button class="btn btn-sm btn-outline-primary me-1" onclick="viewServiceDetails('${request.id}')">
              <i class="bi bi-eye"></i>
            </button>
            ${request.status === 'Pending' ? `
              <button class="btn btn-sm btn-success me-1" onclick="updateRequestStatus(this, '${request.id}', 'Approved')">
                <i class="bi bi-check-lg"></i>
              </button>
              <button class="btn btn-sm btn-danger" onclick="updateRequestStatus(this, '${request.id}', 'Declined')">
                <i class="bi bi-x-lg"></i>
              </button>
            ` : ''}
          </td>
        `;
        
        allRequestsTable.appendChild(row);
      });
      
      // Populate status-specific tables
      const pendingRequests = serviceRequests.filter(req => req.status === 'Pending');
      const approvedRequests = serviceRequests.filter(req => req.status === 'Approved');
      const declinedRequests = serviceRequests.filter(req => req.status === 'Declined');
      
      populateStatusTable('pendingRequests', pendingRequests);
      populateStatusTable('approvedRequests', approvedRequests);
      populateStatusTable('declinedRequests', declinedRequests);
      
      // Add service button functionality
      document.getElementById('saveServiceBtn').addEventListener('click', function() {
        const form = document.getElementById('addServiceForm');
        if (form.checkValidity()) {
          // In a real application, you would send this data to the server
          alert('Service added successfully!');
          // Close modal and reset form
          const modal = bootstrap.Modal.getInstance(document.getElementById('addServiceModal'));
          modal.hide();
          form.reset();
        } else {
          // Trigger HTML5 validation
          form.reportValidity();
        }
      });
    });

    function populateStatusTable(tableId, requests) {
      const table = document.getElementById(tableId);
      if (!table) return;
      
      requests.forEach(request => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${request.id}</td>
          <td>${request.serviceName}</td>
          <td>${request.category}</td>
          <td>${request.requester}</td>
          <td>${request.date}</td>
          <td>
            <button class="btn btn-sm btn-outline-primary" onclick="viewServiceDetails('${request.id}')">
              <i class="bi bi-eye"></i>
            </button>
          </td>
        `;
        
        table.appendChild(row);
      });
    }

    function updateRequestStatus(button, id, status) {
      // In a real application, you would send this update to the server
      const row = button.closest('tr');
      const statusCell = row.querySelector('td:nth-child(6)');
      
      let statusBadge = '';
      switch(status) {
        case 'Approved':
          statusBadge = '<span class="badge bg-success">Approved</span>';
          break;
        case 'Declined':
          statusBadge = '<span class="badge bg-danger">Declined</span>';
          break;
      }
      
      statusCell.innerHTML = statusBadge;
      
      // Remove action buttons
      const actionsCell = row.querySelector('td:last-child');
      actionsCell.innerHTML = `
        <button class="btn btn-sm btn-outline-primary" onclick="viewServiceDetails('${id}')">
          <i class="bi bi-eye"></i>
        </button>
      `;
      
      alert(`Service request ${id} has been ${status.toLowerCase()}.`);
    }

    function viewServiceDetails(id) {
      // In a real application, you would fetch the details from the server
      const serviceDetails = {
        id: id,
        serviceName: 'Housing Application Assistance',
        category: 'Housing Assistance',
        requester: 'John Doe',
        requesterId: 'MEM001',
        date: '2023-10-15',
        status: 'Pending',
        description: 'Assistance with completing housing application for low-income families.',
        notes: 'Client needs help with documentation requirements and understanding eligibility criteria.'
      };
      
      const detailsContent = document.getElementById('serviceDetailsContent');
      detailsContent.innerHTML = `
        <div class="mb-3">
          <h6 class="text-muted">Service ID</h6>
          <p>${serviceDetails.id}</p>
        </div>
        <div class="mb-3">
          <h6 class="text-muted">Service Name</h6>
          <p>${serviceDetails.serviceName}</p>
        </div>
        <div class="mb-3">
          <h6 class="text-muted">Category</h6>
          <p>${serviceDetails.category}</p>
        </div>
        <div class="mb-3">
          <h6 class="text-muted">Requester</h6>
          <p>${serviceDetails.requester} (ID: ${serviceDetails.requesterId})</p>
        </div>
        <div class="mb-3">
          <h6 class="text-muted">Request Date</h6>
          <p>${serviceDetails.date}</p>
        </div>
        <div class="mb-3">
          <h6 class="text-muted">Status</h6>
          <p>${serviceDetails.status}</p>
        </div>
        <div class="mb-3">
          <h6 class="text-muted">Description</h6>
          <p>${serviceDetails.description}</p>
        </div>
        <div class="mb-3">
          <h6 class="text-muted">Notes</h6>
          <p>${serviceDetails.notes}</p>
        </div>
      `;
      
      const modal = new bootstrap.Modal(document.getElementById('viewServiceModal'));
      modal.show();
    }
  </script>

  
</body>
</html>