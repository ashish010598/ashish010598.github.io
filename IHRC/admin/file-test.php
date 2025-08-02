<?php
// Quick diagnostic for team.js access
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Team.js File Access Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .status { padding: 10px; border-radius: 5px; margin: 10px 0; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        .code { background: #f8f9fa; padding: 15px; border-radius: 5px; font-family: monospace; white-space: pre-wrap; overflow-x: auto; }
        h1 { color: #333; }
        h2 { color: #666; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Team.js File Access Diagnostic</h1>
        
        <?php
        $teamJsPath = '../js/team.js';
        $absolutePath = realpath($teamJsPath);
        
        echo "<h2>📂 File Path Information</h2>";
        echo "<div class='info'>Relative Path: {$teamJsPath}</div>";
        echo "<div class='info'>Absolute Path: " . ($absolutePath ? $absolutePath : 'Could not resolve') . "</div>";
        echo "<div class='info'>Current Directory: " . getcwd() . "</div>";
        echo "<div class='info'>Admin Directory: " . __DIR__ . "</div>";
        
        // Test file existence
        echo "<h2>📋 File Tests</h2>";
        
        if (file_exists($teamJsPath)) {
            echo "<div class='success'>✅ File exists</div>";
            
            if (is_readable($teamJsPath)) {
                echo "<div class='success'>✅ File is readable</div>";
                
                $fileSize = filesize($teamJsPath);
                echo "<div class='info'>📊 File size: {$fileSize} bytes</div>";
                
                if (is_writable($teamJsPath)) {
                    echo "<div class='success'>✅ File is writable</div>";
                } else {
                    echo "<div class='error'>❌ File is NOT writable</div>";
                    echo "<div class='info'>💡 Solution: Try running: chmod 644 {$absolutePath}</div>";
                }
                
                // Try to read the file
                echo "<h2>📖 File Content Preview</h2>";
                $content = file_get_contents($teamJsPath);
                
                if ($content !== false) {
                    echo "<div class='success'>✅ Successfully read file content</div>";
                    echo "<div class='info'>📏 Content length: " . strlen($content) . " characters</div>";
                    
                    // Show first 500 characters
                    $preview = substr($content, 0, 500);
                    echo "<div class='code'>" . htmlspecialchars($preview) . 
                         (strlen($content) > 500 ? "\n\n... (truncated, total length: " . strlen($content) . " chars)" : "") . 
                         "</div>";
                    
                    // Test if we can find the members array
                    if (strpos($content, 'teamMembers') !== false) {
                        echo "<div class='success'>✅ Found 'teamMembers' array in file</div>";
                    } else {
                        echo "<div class='error'>❌ Could not find 'teamMembers' array in file</div>";
                    }
                    
                } else {
                    echo "<div class='error'>❌ Failed to read file content</div>";
                }
                
            } else {
                echo "<div class='error'>❌ File is NOT readable</div>";
                echo "<div class='info'>💡 Solution: Try running: chmod 644 {$absolutePath}</div>";
            }
            
        } else {
            echo "<div class='error'>❌ File does not exist</div>";
            
            // Check if js directory exists
            $jsDir = '../js';
            if (is_dir($jsDir)) {
                echo "<div class='info'>📁 JS directory exists, listing contents:</div>";
                $files = scandir($jsDir);
                echo "<div class='code'>";
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        echo "- {$file}\n";
                    }
                }
                echo "</div>";
            } else {
                echo "<div class='error'>❌ JS directory does not exist at: {$jsDir}</div>";
            }
        }
        
        // PHP Configuration Info
        echo "<h2>⚙️ PHP Configuration</h2>";
        echo "<div class='info'>PHP Version: " . phpversion() . "</div>";
        echo "<div class='info'>Upload Max Filesize: " . ini_get('upload_max_filesize') . "</div>";
        echo "<div class='info'>Post Max Size: " . ini_get('post_max_size') . "</div>";
        echo "<div class='info'>File Uploads: " . (ini_get('file_uploads') ? 'Enabled' : 'Disabled') . "</div>";
        
        // Try creating a test file to check write permissions
        echo "<h2>✏️ Write Permission Test</h2>";
        $testFile = 'test_write.tmp';
        if (file_put_contents($testFile, 'test')) {
            echo "<div class='success'>✅ Can create files in admin directory</div>";
            unlink($testFile); // Clean up
        } else {
            echo "<div class='error'>❌ Cannot create files in admin directory</div>";
        }
        ?>
        
        <h2>🚀 Next Steps</h2>
        <div class='info'>
            <strong>If all tests pass:</strong> Try accessing the admin panel again<br>
            <strong>If file doesn't exist:</strong> Make sure team.js is in the correct location<br>
            <strong>If permission errors:</strong> Fix file permissions using chmod<br>
            <strong>If still having issues:</strong> Try the simple admin panel below
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="simple.html" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">📱 Try Simple Admin Panel</a>
            <a href="test.php" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-left: 10px;">🔧 Full Diagnostics</a>
        </div>
    </div>
</body>
</html>
