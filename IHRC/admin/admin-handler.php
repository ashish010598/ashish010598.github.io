<?php
require_once 'auth.php';

// Determine if this is an AJAX request or form submission
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

// For AJAX requests, check authentication differently
if ($isAjax || (isset($_REQUEST['action']) && $_REQUEST['action'] === 'load')) {
    // Allow loading for AJAX requests if authenticated
    if (!isAuthenticated()) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Authentication required']);
        exit;
    }
    // Set JSON header only for AJAX requests
    header('Content-Type: application/json');
} else {
    // For form submissions, require auth normally - no JSON header
    requireAuth();
}

class TeamManager {
    private $jsFilePath;
    
    public function __construct() {
        $this->jsFilePath = __DIR__ . '/../js/team.js';
    }
    
    public function handleRequest() {
        $action = $_REQUEST['action'] ?? '';
        
        switch ($action) {
            case 'load':
                return $this->loadMembers();
            case 'add':
                return $this->addMember();
            case 'edit':
                return $this->editMember();
            case 'delete':
                return $this->deleteMember();
            default:
                return $this->jsonResponse(false, 'Invalid action');
        }
    }
    
    private function loadMembers() {
        $members = $this->extractMembersFromJS();
        if ($members === false) {
            return $this->jsonResponse(false, 'Could not read team data');
        }
        
        return $this->jsonResponse(true, 'Members loaded successfully', $members);
    }
    
    private function addMember() {
        $newMember = $this->validateMemberData();
        if (!$newMember) {
            return $this->redirectWithError('Invalid member data provided');
        }
        
        $members = $this->extractMembersFromJS();
        if ($members === false) {
            return $this->redirectWithError('Could not read existing team data');
        }
        
        // Generate new ID
        $maxId = 0;
        foreach ($members as $member) {
            if ($member['id'] > $maxId) {
                $maxId = $member['id'];
            }
        }
        $newMember['id'] = $maxId + 1;
        
        // Add new member
        $members[] = $newMember;
        
        if ($this->updateMembersInJS($members)) {
            return $this->redirectWithSuccess('Member added successfully');
        } else {
            return $this->redirectWithError('Failed to add member');
        }
    }
    
    private function editMember() {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) {
            return $this->redirectWithError('Invalid member ID');
        }
        
        $updatedMember = $this->validateMemberData();
        if (!$updatedMember) {
            return $this->redirectWithError('Invalid member data provided');
        }
        
        $members = $this->extractMembersFromJS();
        if ($members === false) {
            return $this->redirectWithError('Could not read existing team data');
        }
        
        // Find and update member
        $found = false;
        for ($i = 0; $i < count($members); $i++) {
            if ($members[$i]['id'] == $id) {
                $updatedMember['id'] = $id;
                $members[$i] = $updatedMember;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            return $this->redirectWithError('Member not found');
        }
        
        if ($this->updateMembersInJS($members)) {
            return $this->redirectWithSuccess('Member updated successfully');
        } else {
            return $this->redirectWithError('Failed to update member');
        }
    }
    
    private function deleteMember() {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) {
            return $this->redirectWithError('Invalid member ID');
        }
        
        $members = $this->extractMembersFromJS();
        if ($members === false) {
            return $this->redirectWithError('Could not read existing team data');
        }
        
        // Filter out the member to delete
        $originalCount = count($members);
        $members = array_filter($members, function($member) use ($id) {
            return $member['id'] != $id;
        });
        
        if (count($members) == $originalCount) {
            return $this->redirectWithError('Member not found');
        }
        
        // Reindex array
        $members = array_values($members);
        
        if ($this->updateMembersInJS($members)) {
            return $this->redirectWithSuccess('Member deleted successfully');
        } else {
            return $this->redirectWithError('Failed to delete member');
        }
    }
    
    private function extractMembersFromJS() {
        if (!file_exists($this->jsFilePath)) {
            return false;
        }
        
        $jsContent = file_get_contents($this->jsFilePath);
        if ($jsContent === false) {
            return false;
        }
        
        // Find the teamMembers array using regex
        $pattern = '/const\s+teamMembers\s*=\s*\[(.*?)\];/s';
        if (!preg_match($pattern, $jsContent, $matches)) {
            return false;
        }
        
        $membersString = $matches[1];
        
        // Extract individual member objects
        $memberPattern = '/\{(.*?)\}/s';
        preg_match_all($memberPattern, $membersString, $memberMatches);
        
        $members = [];
        foreach ($memberMatches[1] as $memberString) {
            $member = $this->parseMemberObject($memberString);
            if ($member) {
                $members[] = $member;
            }
        }
        
        return $members;
    }
    
    private function parseMemberObject($memberString) {
        $member = [];
        
        // Extract each property
        $patterns = [
            'id' => '/id:\s*(\d+)/',
            'name' => '/name:\s*["\']([^"\']*)["\']/',
            'post' => '/post:\s*["\']([^"\']*)["\']/',
            'state' => '/state:\s*["\']([^"\']*)["\']/',
            'email' => '/email:\s*["\']([^"\']*)["\']/',
            'phone' => '/phone:\s*["\']([^"\']*)["\']/',
            'photo' => '/photo:\s*["\']([^"\']*)["\']/'
        ];
        
        foreach ($patterns as $key => $pattern) {
            if (preg_match($pattern, $memberString, $matches)) {
                $member[$key] = $key === 'id' ? intval($matches[1]) : $matches[1];
            } else {
                $member[$key] = $key === 'id' ? 0 : '';
            }
        }
        
        return $member['id'] > 0 ? $member : null;
    }
    
    private function updateMembersInJS($members) {
        if (!file_exists($this->jsFilePath)) {
            return false;
        }
        
        $jsContent = file_get_contents($this->jsFilePath);
        if ($jsContent === false) {
            return false;
        }
        
        // Generate new members array string
        $membersString = $this->generateMembersArrayString($members);
        
        // Replace the existing teamMembers array
        $pattern = '/(const\s+teamMembers\s*=\s*)\[(.*?)\];/s';
        $replacement = '$1[' . $membersString . '];';
        
        $newJsContent = preg_replace($pattern, $replacement, $jsContent);
        
        if ($newJsContent === null) {
            return false;
        }
        
        // Write back to file
        return file_put_contents($this->jsFilePath, $newJsContent) !== false;
    }
    
    private function generateMembersArrayString($members) {
        $memberStrings = [];
        
        foreach ($members as $member) {
            $memberString = "\n  {\n";
            $memberString .= "    id: {$member['id']},\n";
            $memberString .= "    name: \"" . addslashes($member['name']) . "\",\n";
            $memberString .= "    post: \"" . addslashes($member['post']) . "\",\n";
            $memberString .= "    state: \"" . addslashes($member['state']) . "\",\n";
            $memberString .= "    email: \"" . addslashes($member['email']) . "\",\n";
            $memberString .= "    phone: \"" . addslashes($member['phone']) . "\",\n";
            $memberString .= "    photo: \"" . addslashes($member['photo']) . "\"\n";
            $memberString .= "  }";
            
            $memberStrings[] = $memberString;
        }
        
        return implode(',', $memberStrings) . "\n";
    }
    
    private function validateMemberData() {
        $name = trim($_POST['name'] ?? '');
        $post = trim($_POST['post'] ?? '');
        $state = trim($_POST['state'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $photo = trim($_POST['photo'] ?? '');
        
        if (empty($name) || empty($post) || empty($state)) {
            return false;
        }
        
        return [
            'name' => $name,
            'post' => $post,
            'state' => $state,
            'email' => $email,
            'phone' => $phone,
            'photo' => $photo
        ];
    }
    
    private function jsonResponse($success, $message, $data = null) {
        $response = [
            'success' => $success,
            'message' => $message
        ];
        
        if ($data !== null) {
            $response['members'] = $data;
        }
        
        echo json_encode($response);
        exit;
    }
    
    private function redirectWithSuccess($message) {
        header('Location: index.php?success=' . urlencode($message));
        exit;
    }
    
    private function redirectWithError($message) {
        header('Location: index.php?error=' . urlencode($message));
        exit;
    }
}

// Handle the request
$teamManager = new TeamManager();
$teamManager->handleRequest();
?>
