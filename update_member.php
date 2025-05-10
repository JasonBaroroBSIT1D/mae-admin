<?php
require_once 'config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || $_POST['action'] !== 'update_member') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$memberId = $_POST['member_id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$memberType = $_POST['memberType'];
$status = $_POST['status'];
$bio = $_POST['memberBio'];

try {
    // Start transaction
    $pdo->beginTransaction();
    
    // Update member details
    $stmt = $pdo->prepare("UPDATE members SET 
        first_name = ?, 
        last_name = ?, 
        email = ?, 
        phone = ?, 
        department = ?, 
        member_type = ?, 
        status = ?, 
        bio = ? 
        WHERE id = ?");
    
    $stmt->execute([
        $firstName,
        $lastName,
        $email,
        $phone,
        $department,
        $memberType,
        $status,
        $bio,
        $memberId
    ]);
    
    // Handle profile image upload if present
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === 0) {
        // Get current image
        $stmt = $pdo->prepare("SELECT profile_image FROM members WHERE id = ?");
        $stmt->execute([$memberId]);
        $currentImage = $stmt->fetchColumn();
        
        // Delete current image if exists
        if ($currentImage) {
            $oldImagePath = 'uploads/members/' . $currentImage;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        
        // Upload new image
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
    
    // Commit transaction
    $pdo->commit();
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    // Rollback transaction on error
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?> 