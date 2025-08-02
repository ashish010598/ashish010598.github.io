<?php
require_once 'auth.php';
requireAuth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IHRC Team Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .admin-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .admin-controls {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #28a745;
        }

        .btn-success:hover {
            background: #1e7e34;
        }

        .btn-danger {
            background: #dc3545;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .members-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .member-photo-small {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
        }

        .avatar-small {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #495057;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #007bff;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1><i class="fas fa-users-cog"></i> IHRC Team Admin Panel</h1>
        <p>Manage team members dynamically</p>
        <div style="position: absolute; top: 20px; right: 20px;">
            <span style="color: rgba(255,255,255,0.8); margin-right: 15px;">
                <i class="fas fa-user"></i> Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
            </span>
            <a href="auth.php?action=logout" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 5px;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <div class="stats" id="stats">
            <!-- Stats will be loaded here -->
        </div>

        <div class="admin-controls">
            <button class="btn btn-success" onclick="openAddModal()">
                <i class="fas fa-plus"></i> Add New Member
            </button>
            <button class="btn btn-warning" onclick="location.reload()">
                <i class="fas fa-refresh"></i> Refresh Data
            </button>
            <a href="../screens/team.html" class="btn" target="_blank">
                <i class="fas fa-eye"></i> View Team Page
            </a>
        </div>

        <div class="members-table">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>State</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="membersTableBody">
                    <!-- Members will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Member Modal -->
    <div id="memberModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add New Member</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <form id="memberForm" method="POST" action="admin-handler.php">
                <input type="hidden" id="actionType" name="action" value="add">
                <input type="hidden" id="memberId" name="id" value="">
                
                <div class="form-group">
                    <label for="memberName">Full Name *</label>
                    <input type="text" id="memberName" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="memberPost">Position/Post *</label>
                    <input type="text" id="memberPost" name="post" required>
                </div>
                
                <div class="form-group">
                    <label for="memberState">State *</label>
                    <input type="text" id="memberState" name="state" required>
                </div>
                
                <div class="form-group">
                    <label for="memberEmail">Email</label>
                    <input type="email" id="memberEmail" name="email">
                </div>
                
                <div class="form-group">
                    <label for="memberPhone">Phone</label>
                    <input type="tel" id="memberPhone" name="phone">
                </div>
                
                <div class="form-group">
                    <label for="memberPhoto">Photo Path</label>
                    <input type="text" id="memberPhoto" name="photo" placeholder="e.g., img/team/member.jpg">
                </div>
                
                <div class="actions">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Member
                    </button>
                    <button type="button" class="btn" onclick="closeModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let members = [];

        // Load members data
        function loadMembers() {
            fetch('admin-handler.php?action=load', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        members = data.members;
                        renderMembersTable();
                        renderStats();
                    } else {
                        alert('Error loading members: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading members data');
                });
        }

        function renderMembersTable() {
            const tbody = document.getElementById('membersTableBody');
            tbody.innerHTML = '';

            members.forEach((member, index) => {
                const initials = member.name.split(' ').map(n => n[0]).join('').toUpperCase();
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        ${member.photo ? 
                            `<img src="../${member.photo}" alt="${member.name}" class="member-photo-small" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                             <div class="avatar-small" style="display:none;">${initials}</div>` :
                            `<div class="avatar-small">${initials}</div>`
                        }
                    </td>
                    <td><strong>${member.name}</strong></td>
                    <td>${member.post}</td>
                    <td><i class="fas fa-map-marker-alt"></i> ${member.state}</td>
                    <td>${member.email || '-'}</td>
                    <td>${member.phone || '-'}</td>
                    <td>
                        <div class="actions">
                            <button class="btn btn-warning" onclick="editMember(${member.id})" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" onclick="deleteMember(${member.id})" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function renderStats() {
            const stats = document.getElementById('stats');
            const totalMembers = members.length;
            const states = [...new Set(members.map(m => m.state))].length;
            const withPhotos = members.filter(m => m.photo && m.photo.trim()).length;

            stats.innerHTML = `
                <div class="stat-card">
                    <div class="stat-number">${totalMembers}</div>
                    <div class="stat-label">Total Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${states}</div>
                    <div class="stat-label">States Covered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${withPhotos}</div>
                    <div class="stat-label">With Photos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${totalMembers - withPhotos}</div>
                    <div class="stat-label">Default Avatars</div>
                </div>
            `;
        }

        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Add New Member';
            document.getElementById('actionType').value = 'add';
            document.getElementById('memberId').value = '';
            document.getElementById('memberForm').reset();
            document.getElementById('memberModal').style.display = 'block';
        }

        function editMember(id) {
            const member = members.find(m => m.id === id);
            if (!member) return;

            document.getElementById('modalTitle').textContent = 'Edit Member';
            document.getElementById('actionType').value = 'edit';
            document.getElementById('memberId').value = member.id;
            document.getElementById('memberName').value = member.name;
            document.getElementById('memberPost').value = member.post;
            document.getElementById('memberState').value = member.state;
            document.getElementById('memberEmail').value = member.email || '';
            document.getElementById('memberPhone').value = member.phone || '';
            document.getElementById('memberPhoto').value = member.photo || '';
            
            document.getElementById('memberModal').style.display = 'block';
        }

        function deleteMember(id) {
            const member = members.find(m => m.id === id);
            if (!member) return;

            if (confirm(`Are you sure you want to delete ${member.name}?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'admin-handler.php';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="${id}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function closeModal() {
            document.getElementById('memberModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('memberModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Load data on page load
        document.addEventListener('DOMContentLoaded', loadMembers);
    </script>
</body>
</html>
