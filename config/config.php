<?php
// Application settings
define('APP_NAME', 'ACCESS Admin Dashboard');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/mae-admin');
define('APP_ROOT', dirname(__DIR__));

// Session settings
define('SESSION_NAME', 'access_admin_session');
define('SESSION_LIFETIME', 3600); // 1 hour
define('SESSION_PATH', '/');
define('SESSION_DOMAIN', '');
define('SESSION_SECURE', false);
define('SESSION_HTTP_ONLY', true);

// File upload settings
define('UPLOAD_MAX_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('GALLERY_UPLOAD_DIR', 'uploads/gallery/');
define('PROFILE_UPLOAD_DIR', 'uploads/profiles/');

// Pagination settings
define('ITEMS_PER_PAGE', 10);

// Date and time settings
define('DEFAULT_DATE_FORMAT', 'Y-m-d');
define('DEFAULT_TIME_FORMAT', 'H:i:s');
define('DEFAULT_DATETIME_FORMAT', 'Y-m-d H:i:s');

// Security settings
define('PASSWORD_MIN_LENGTH', 8);
define('PASSWORD_REQUIRE_SPECIAL', true);
define('PASSWORD_REQUIRE_NUMBER', true);
define('PASSWORD_REQUIRE_UPPERCASE', true);
define('PASSWORD_REQUIRE_LOWERCASE', true);

// Email settings
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');
define('SMTP_FROM_EMAIL', '');
define('SMTP_FROM_NAME', APP_NAME);

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', APP_ROOT . '/logs/error.log');

// Create logs directory if it doesn't exist
if (!file_exists(APP_ROOT . '/logs')) {
    mkdir(APP_ROOT . '/logs', 0777, true);
}

// Initialize session with custom settings
session_name(SESSION_NAME);
session_set_cookie_params(
    SESSION_LIFETIME,
    SESSION_PATH,
    SESSION_DOMAIN,
    SESSION_SECURE,
    SESSION_HTTP_ONLY
);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set default timezone
date_default_timezone_set('Asia/Manila');

// Include required files
require_once APP_ROOT . '/includes/Database.php';
require_once APP_ROOT . '/includes/User.php';
require_once APP_ROOT . '/includes/Member.php';
require_once APP_ROOT . '/includes/Event.php';
require_once APP_ROOT . '/includes/Announcement.php';
require_once APP_ROOT . '/includes/Gallery.php';
require_once APP_ROOT . '/includes/Feedback.php';
require_once APP_ROOT . '/includes/Utils.php';
?> 