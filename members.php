<?php
require_once 'config/database.php';

// Handle member creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add_member') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $department = $_POST['department'];
        $memberType = $_POST['memberType'];
        $bio = $_POST['memberBio'];
        
        try {
            $stmt = $pdo->prepare("INSERT INTO members (first_name, last_name, email, phone, department, member_type, bio, status, created_at) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, 'Active', NOW())");
            $stmt->execute([$firstName, $lastName, $email, $phone, $department, $memberType, $bio]);
            
            // Handle profile image upload if present
            if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === 0) {
                $memberId = $pdo->lastInsertId();
                $uploadDir = 'uploads/members/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileExtension = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);
                $fileName = $memberId . '_' . time() . '.' . $fileExtension;
                $targetPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetPath)) {
                    $stmt = $pdo->prepare("UPDATE members SET profile_image = ? WHERE id = ?");
                    $stmt->execute([$fileName, $memberId]);
                }
            }
            
            header('Location: members.php?success=1');
            exit;
        } catch (PDOException $e) {
            $error = "Error adding member: " . $e->getMessage();
        }
    }
}

// Get filter parameters
$department = isset($_GET['department']) ? $_GET['department'] : '';
$memberType = isset($_GET['memberType']) ? $_GET['memberType'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Build query
$query = "SELECT * FROM members WHERE 1=1";
$params = [];

if ($department) {
    $query .= " AND department = ?";
    $params[] = $department;
}
if ($memberType) {
    $query .= " AND member_type = ?";
    $params[] = $memberType;
}
if ($status) {
    $query .= " AND status = ?";
    $params[] = $status;
}
if ($search) {
    $query .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
    $searchParam = "%$search%";
    $params[] = $searchParam;
    $params[] = $searchParam;
    $params[] = $searchParam;
}

$query .= " ORDER BY created_at DESC";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error fetching members: " . $e->getMessage();
    $members = [];
}
?>
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
      <h6 class="mb-0 text-white"><?php echo htmlspecialchars($_SESSION['full_name'] ?? 'Admin User'); ?></h6>
      <small class="text-white-50"><?php echo htmlspecialchars($_SESSION['role'] ?? 'Administrator'); ?></small>
      <a href="logout.php" class="btn btn-outline-light btn-sm w-100 mt-3">
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
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Log Out</a></li>
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
                <form class="input-group me-3" style="max-width: 300px;" method="GET">
                  <input type="text" class="form-control" name="search" placeholder="Search members..." value="<?php echo htmlspecialchars($search); ?>">
                  <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                  </button>
                </form>
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
              <form method="GET" class="row g-3">
                <div class="col-md-3">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select" id="department" name="department">
                    <option value="">All Departments</option>
                    <option value="BSIT" <?php echo $department === 'BSIT' ? 'selected' : ''; ?>>BSIT</option>
                    <option value="BTLED-IA" <?php echo $department === 'BTLED-IA' ? 'selected' : ''; ?>>BTLED-IA</option>
                    <option value="BTLED-HE" <?php echo $department === 'BTLED-HE' ? 'selected' : ''; ?>>BTLED-HE</option>
                    <option value="BTLED-ICT" <?php echo $department === 'BTLED-ICT' ? 'selected' : ''; ?>>BTLED-ICT</option>
                    <option value="BFPT" <?php echo $department === 'BFPT' ? 'selected' : ''; ?>>BFPT</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="memberType" class="form-label">Member Type</label>
                  <select class="form-select" id="memberType" name="memberType">
                    <option value="">All Member Types</option>
                    <option value="Student Member" <?php echo $memberType === 'Student Member' ? 'selected' : ''; ?>>Student Member</option>
                    <option value="Faculty Member" <?php echo $memberType === 'Faculty Member' ? 'selected' : ''; ?>>Faculty Member</option>
                    <option value="Industry Partner" <?php echo $memberType === 'Industry Partner' ? 'selected' : ''; ?>>Industry Partner</option>
                    <option value="Alumni" <?php echo $memberType === 'Alumni' ? 'selected' : ''; ?>>Alumni</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="status" class="form-label">Status</label>
                  <select class="form-select" id="status" name="status">
                    <option value="">All Status</option>
                    <option value="Active" <?php echo $status === 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo $status === 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                    <option value="Pending" <?php echo $status === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="Suspended" <?php echo $status === 'Suspended' ? 'selected' : ''; ?>>Suspended</option>
                  </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                  <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i> Apply Filters
                  </button>
                </div>
              </form>
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
                    <?php if (isset($error)): ?>
                      <tr>
                        <td colspan="7" class="text-center text-danger"><?php echo $error; ?></td>
                      </tr>
                    <?php elseif (empty($members)): ?>
                      <tr>
                        <td colspan="7" class="text-center">No members found</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($members as $member): ?>
                        <tr>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="<?php echo $member['id']; ?>">
                            </div>
                          </td>
                          <td>
                            <div class="d-flex align-items-center">
                              <?php if (!empty($member['profile_image'])): ?>
                                <img src="uploads/members/<?php echo htmlspecialchars($member['profile_image']); ?>" 
                                     alt="<?php echo htmlspecialchars($member['first_name']); ?>" 
                                     class="rounded-circle me-2" width="32" height="32">
                              <?php else: ?>
                                <div class="rounded-circle bg-secondary me-2 d-flex align-items-center justify-content-center" 
                                     style="width: 32px; height: 32px;">
                                  <i class="bi bi-person text-white"></i>
                                </div>
                              <?php endif; ?>
                              <div>
                                <div class="fw-bold"><?php echo htmlspecialchars($member['first_name'] . ' ' . $member['last_name']); ?></div>
                                <div class="small text-muted"><?php echo htmlspecialchars($member['email']); ?></div>
                              </div>
                            </div>
                          </td>
                          <td><?php echo htmlspecialchars($member['department']); ?></td>
                          <td><?php echo htmlspecialchars($member['member_type']); ?></td>
                          <td><?php echo date('M d, Y', strtotime($member['created_at'])); ?></td>
                          <td>
                            <span class="badge bg-<?php 
                              echo match($member['status']) {
                                'Active' => 'success',
                                'Inactive' => 'secondary',
                                'Pending' => 'warning',
                                'Suspended' => 'danger',
                                default => 'secondary'
                              };
                            ?>">
                              <?php echo htmlspecialchars($member['status']); ?>
                            </span>
                          </td>
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-outline-secondary" 
                                      onclick="editMember(<?php echo $member['id']; ?>)">
                                <i class="bi bi-pencil"></i>
                              </button>
                              <button type="button" class="btn btn-sm btn-outline-danger" 
                                      onclick="deleteMember(<?php echo $member['id']; ?>)">
                                <i class="bi bi-trash"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
          <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_member">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
              </div>
              <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="department" class="form-label">Department</label>
                <select class="form-select" id="department" name="department" required>
                  <option value="" selected disabled>Select Department</option>
                  <option value="BSIT">BSIT</option>
                  <option value="BTLED-IA">BTLED-IA</option>
                  <option value="BTLED-HE">BTLED-HE</option>
                  <option value="BTLED-ICT">BTLED-ICT</option>
                  <option value="BFPT">BFPT</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="memberType" class="form-label">Member Type</label>
                <select class="form-select" id="memberType" name="memberType" required>
                  <option value="" selected disabled>Select Member Type</option>
                  <option value="Student Member">Student Member</option>
                  <option value="Faculty Member">Faculty Member</option>
                  <option value="Industry Partner">Industry Partner</option>
                  <option value="Alumni">Alumni</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="profileImage" class="form-label">Profile Image</label>
              <input class="form-control" type="file" id="profileImage" name="profileImage" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="memberBio" class="form-label">Bio/Description</label>
              <textarea class="form-control" id="memberBio" name="memberBio" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="sendWelcomeEmail" name="sendWelcomeEmail" checked>
                <label class="form-check-label" for="sendWelcomeEmail">
                  Send welcome email with login credentials
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add Member</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Member Modal -->
  <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editMemberModalLabel">Edit Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" id="editMemberForm">
            <input type="hidden" name="action" value="update_member">
            <input type="hidden" name="member_id" id="edit_member_id">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="edit_firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="edit_firstName" name="firstName" required>
              </div>
              <div class="col-md-6">
                <label for="edit_lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="edit_lastName" name="lastName" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="edit_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="edit_email" name="email" required>
              </div>
              <div class="col-md-6">
                <label for="edit_phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="edit_phone" name="phone">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="edit_department" class="form-label">Department</label>
                <select class="form-select" id="edit_department" name="department" required>
                  <option value="" disabled>Select Department</option>
                  <option value="BSIT">BSIT</option>
                  <option value="BTLED-IA">BTLED-IA</option>
                  <option value="BTLED-HE">BTLED-HE</option>
                  <option value="BTLED-ICT">BTLED-ICT</option>
                  <option value="BFPT">BFPT</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="edit_memberType" class="form-label">Member Type</label>
                <select class="form-select" id="edit_memberType" name="memberType" required>
                  <option value="" disabled>Select Member Type</option>
                  <option value="Student Member">Student Member</option>
                  <option value="Faculty Member">Faculty Member</option>
                  <option value="Industry Partner">Industry Partner</option>
                  <option value="Alumni">Alumni</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="edit_status" class="form-label">Status</label>
                <select class="form-select" id="edit_status" name="status" required>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                  <option value="Pending">Pending</option>
                  <option value="Suspended">Suspended</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="edit_profileImage" class="form-label">Profile Image</label>
                <input class="form-control" type="file" id="edit_profileImage" name="profileImage" accept="image/*">
                <div id="currentImage" class="mt-2"></div>
              </div>
            </div>
            <div class="mb-3">
              <label for="edit_memberBio" class="form-label">Bio/Description</label>
              <textarea class="form-control" id="edit_memberBio" name="memberBio" rows="3"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Update Member</button>
            </div>
          </form>
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
    
    // Edit member functionality
    function editMember(memberId) {
      // Fetch member data
      fetch('get_member.php?id=' + memberId)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const member = data.member;
            // Populate form fields
            document.getElementById('edit_member_id').value = member.id;
            document.getElementById('edit_firstName').value = member.first_name;
            document.getElementById('edit_lastName').value = member.last_name;
            document.getElementById('edit_email').value = member.email;
            document.getElementById('edit_phone').value = member.phone;
            document.getElementById('edit_department').value = member.department;
            document.getElementById('edit_memberType').value = member.member_type;
            document.getElementById('edit_status').value = member.status;
            document.getElementById('edit_memberBio').value = member.bio;
            
            // Show current image if exists
            const currentImageDiv = document.getElementById('currentImage');
            if (member.profile_image) {
              currentImageDiv.innerHTML = `
                <img src="uploads/members/${member.profile_image}" 
                     alt="Current profile" 
                     class="img-thumbnail" 
                     style="max-width: 100px;">
              `;
            } else {
              currentImageDiv.innerHTML = '';
            }
            
            // Show modal
            new bootstrap.Modal(document.getElementById('editMemberModal')).show();
          } else {
            alert('Error loading member data: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred while loading member data');
        });
    }
    
    // Handle edit form submission
    document.getElementById('editMemberForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      
      fetch('update_member.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.reload();
        } else {
          alert('Error updating member: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the member');
      });
    });
    
    // Delete member functionality
    function deleteMember(memberId) {
      if (confirm('Are you sure you want to delete this member?')) {
        fetch('delete_member.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'member_id=' + memberId
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Error deleting member: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred while deleting the member');
        });
      }
    }
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>
</body>
</html>