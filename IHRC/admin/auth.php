<?php
session_start();

// Simple authentication - you can change these credentials
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'ihrc2025');

function isAuthenticated() {
    return isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'] === true;
}

function authenticate($username, $password) {
    return $username === ADMIN_USERNAME && $password === ADMIN_PASSWORD;
}

function requireAuth() {
    if (!isAuthenticated()) {
        header('Location: login.php');
        exit;
    }
}

function logout() {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}

// If this file is accessed directly and user is not authenticated, redirect to login
if (basename($_SERVER['PHP_SELF']) === 'auth.php' && !isAuthenticated()) {
    header('Location: login.php');
    exit;
}
?>
