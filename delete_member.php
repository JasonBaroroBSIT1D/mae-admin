<?php
require_once 'config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['member_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$memberId = $_POST['member_id'];

try {
    // First get the member's profile image if any
    $stmt = $pdo->prepare("SELECT profile_image FROM members WHERE id = ?");
    $stmt->execute([$memberId]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Delete the member
    $stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
    $stmt->execute([$memberId]);
    
    // If member had a profile image, delete it
    if ($member && !empty($member['profile_image'])) {
        $imagePath = 'uploads/members/' . $member['profile_image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?> 