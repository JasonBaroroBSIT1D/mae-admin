<?php
require_once '../config/database.php';
require_once '../auth/session.php';
require_once '../includes/member_operations.php';

header('Content-Type: application/json');
requireAdmin();

$database = new Database();
$db = $database->getConnection();

$memberOps = new MemberOperations($db);

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['firstName'],
                'last_name' => $_POST['lastName'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'department' => $_POST['department'],
                'member_type' => $_POST['memberType'],
                'bio' => $_POST['memberBio'],
                'profile_image' => ''
            ];

            // Handle file upload
            if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === 0) {
                $uploadDir = '../uploads/';
                $fileName = time() . '_' . $_FILES['profileImage']['name'];
                if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadDir . $fileName)) {
                    $data['profile_image'] = $fileName;
                }
            }

            if ($memberOps->addMember($data)) {
                echo json_encode(['success' => true, 'message' => 'Member added successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add member']);
            }
        }
        break;

    case 'get':
        $members = $memberOps->getAllMembers();
        echo json_encode(['success' => true, 'data' => $members]);
        break;

    case 'search':
        $searchTerm = $_GET['term'] ?? '';
        $members = $memberOps->searchMembers($searchTerm);
        echo json_encode(['success' => true, 'data' => $members]);
        break;

    case 'filter':
        $department = $_GET['department'] ?? 'All Departments';
        $memberType = $_GET['memberType'] ?? 'All Member Types';
        $status = $_GET['status'] ?? 'All Status';
        
        $members = $memberOps->filterMembers($department, $memberType, $status);
        echo json_encode(['success' => true, 'data' => $members]);
        break;

    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'first_name' => $_POST['firstName'],
                'last_name' => $_POST['lastName'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'department' => $_POST['department'],
                'member_type' => $_POST['memberType'],
                'bio' => $_POST['memberBio'],
                'status' => $_POST['status']
            ];

            if ($memberOps->updateMember($id, $data)) {
                echo json_encode(['success' => true, 'message' => 'Member updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update member']);
            }
        }
        break;

    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            if ($memberOps->deleteMember($id)) {
                echo json_encode(['success' => true, 'message' => 'Member deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete member']);
            }
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}
?> 