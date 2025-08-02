<?php
// Simple diagnostic page to test PHP functionality

echo "<h1>IHRC Admin Panel Diagnostics</h1>";
echo "<hr>";

// Check PHP version
echo "<h2>PHP Information</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' . "</p>";

// Check file permissions
echo "<h2>File Permissions</h2>";
$files_to_check = [
    'auth.php',
    'index.php', 
    'login.php',
    'admin-handler.php',
    '../js/team.js'
];

foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        $perms = substr(sprintf('%o', fileperms($file)), -4);
        echo "<p><strong>$file:</strong> Exists (Permissions: $perms)</p>";
    } else {
        echo "<p><strong>$file:</strong> <span style='color: red;'>NOT FOUND</span></p>";
    }
}

// Check if sessions work
echo "<h2>Session Test</h2>";
session_start();
if (session_status() === PHP_SESSION_ACTIVE) {
    echo "<p><span style='color: green;'>✓ Sessions are working</span></p>";
} else {
    echo "<p><span style='color: red;'>✗ Sessions are not working</span></p>";
}

// Check write permissions on team.js
echo "<h2>Write Permissions Test</h2>";
$team_js_path = '../js/team.js';
if (file_exists($team_js_path)) {
    if (is_writable($team_js_path)) {
        echo "<p><span style='color: green;'>✓ team.js is writable</span></p>";
    } else {
        echo "<p><span style='color: red;'>✗ team.js is NOT writable</span></p>";
        echo "<p>Fix with: chmod 644 js/team.js</p>";
    }
} else {
    echo "<p><span style='color: red;'>✗ team.js not found</span></p>";
}

// Navigation links
echo "<hr>";
echo "<h2>Quick Links</h2>";
echo "<p><a href='login.php'>Go to Login Page</a></p>";
echo "<p><a href='index.php'>Try Admin Panel</a></p>";

// Show current directory and files
echo "<h2>Current Directory Contents</h2>";
$files = scandir('.');
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo "<p>$file</p>";
    }
}

?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h1, h2 { color: #333; }
p { margin: 5px 0; }
hr { margin: 20px 0; }
a { color: #007bff; text-decoration: none; }
a:hover { text-decoration: underline; }
</style>
