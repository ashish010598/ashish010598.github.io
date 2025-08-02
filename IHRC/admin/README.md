# IHRC Team Management System

A dynamic team management system that allows you to add, edit, and delete team members through an admin panel without using any backend database. The system directly modifies the JavaScript file to maintain the member data.

## Features

### 🎯 **Admin Panel**

- **Secure Authentication** - Username/Password protection
- **Add New Members** - Complete member information form
- **Edit Existing Members** - Modify any member details
- **Delete Members** - Remove members with confirmation
- **Real-time Statistics** - View team stats and member counts
- **Photo Management** - Support for member photos with fallback avatars

### 📊 **Team Display**

- **Dynamic Loading** - Members loaded from JavaScript file
- **Search Functionality** - Search by name, position, or state
- **State Filtering** - Filter members by state/location
- **Pagination** - Navigate through multiple pages
- **Responsive Design** - Works on all devices
- **Professional Cards** - Clean member card layout

### 🔧 **Technical Features**

- **No Database Required** - Data stored directly in JavaScript
- **PHP-Based Admin** - Server-side processing for security
- **File Modification** - Direct editing of existing files
- **Session Management** - Secure admin sessions
- **Error Handling** - Comprehensive error messages

## Installation & Setup

### 1. **File Structure**

```
IHRC/
├── admin/
│   ├── index.php          # Main admin panel
│   ├── login.php          # Login page
│   ├── auth.php           # Authentication handler
│   └── admin-handler.php  # Data processing
├── js/
│   └── team.js           # Team data and functionality
├── css/
│   └── team.css          # Team page styles
├── screens/
│   └── team.html         # Public team page
└── img/team/             # Member photos
```

### 2. **Server Requirements**

- **PHP 7.0+** - For admin panel processing
- **Web Server** - Apache/Nginx with PHP support
- **File Permissions** - Write access to `js/team.js`

### 3. **Default Login Credentials**

```
Username: admin
Password: ihrc2025
```

**⚠️ Important:** Change these credentials in `admin/auth.php`:

```php
define('ADMIN_USERNAME', 'your-username');
define('ADMIN_PASSWORD', 'your-secure-password');
```

## How It Works

### 🔄 **Data Management Process**

1. **Data Storage**: Team member data is stored as a JavaScript array in `js/team.js`
2. **Admin Operations**: PHP scripts read, parse, and modify the JavaScript file directly
3. **Real-time Updates**: Changes are immediately reflected on the team page
4. **No Database**: Everything works with file-based storage

### 📝 **Adding/Editing Members**

1. Access admin panel: `http://your-domain/admin/`
2. Login with credentials
3. Use "Add New Member" or edit existing members
4. Fill required fields (Name, Position, State)
5. Optionally add email, phone, and photo path
6. Changes are saved directly to the JavaScript file

### 🖼️ **Photo Management**

- **Photo Path**: Relative to the main website root (e.g., `img/team/member.jpg`)
- **Fallback**: If no photo or photo fails to load, shows initials avatar
- **Format**: Supports common image formats (JPG, PNG, WebP)

## File Modification Logic

### 🎯 **How PHP Modifies JavaScript**

The system uses regex patterns to:

1. **Extract Members**: Parse the JavaScript array structure
2. **Parse Objects**: Extract individual member properties
3. **Generate Code**: Rebuild the JavaScript array with new data
4. **Replace Content**: Update the original file with new array

### 🔍 **Example Modification**

**Before:**

```javascript
this.members = [
  {
    id: 1,
    name: "John Doe",
    post: "Manager",
    state: "Delhi",
  },
];
```

**After Adding Member:**

```javascript
this.members = [
  {
    id: 1,
    name: "John Doe",
    post: "Manager",
    state: "Delhi",
  },
  {
    id: 2,
    name: "Jane Smith",
    post: "Coordinator",
    state: "Mumbai",
  },
];
```

## Usage Instructions

### 👨‍💼 **For Administrators**

1. **Access Admin Panel**

   ```
   http://your-website.com/admin/
   ```

2. **Login Process**

   - Enter username and password
   - Click "Login to Admin Panel"

3. **Managing Members**

   - **Add**: Click "Add New Member" button
   - **Edit**: Click edit icon next to member
   - **Delete**: Click delete icon (with confirmation)

4. **Required Fields**

   - Name (Full name of the member)
   - Position/Post (Job title or role)
   - State (Location/State)

5. **Optional Fields**
   - Email (Contact email)
   - Phone (Contact number)
   - Photo (Path to member's photo)

### 👥 **For Visitors**

1. **View Team Page**

   ```
   http://your-website.com/screens/team.html
   ```

2. **Search Members**

   - Use search box to find specific members
   - Search works on name, position, and state

3. **Filter by State**

   - Use dropdown to filter by specific states
   - Shows "All States" by default

4. **Navigate Pages**
   - Use pagination controls to browse multiple pages
   - Shows 12 members per page

## Security Features

### 🔒 **Authentication**

- Session-based login system
- Password protection for admin access
- Auto-logout functionality
- Secure session management

### 🛡️ **Data Protection**

- Input validation and sanitization
- SQL injection prevention (no database = no SQL injection)
- XSS protection with proper escaping
- File permission checks

### 🔐 **Best Practices**

- Change default credentials immediately
- Use strong passwords
- Regular security updates
- Monitor admin access logs

## Troubleshooting

### ❗ **Common Issues**

1. **Cannot Login**

   - Check credentials in `auth.php`
   - Ensure sessions are working on server
   - Check file permissions

2. **Changes Not Saving**

   - Verify write permissions on `js/team.js`
   - Check PHP error logs
   - Ensure proper file paths

3. **Photos Not Loading**

   - Check photo file paths are correct
   - Verify image files exist
   - Ensure proper file permissions

4. **Admin Panel Not Loading**
   - Confirm PHP is working on server
   - Check for PHP syntax errors
   - Verify all admin files are uploaded

### 🔧 **File Permissions**

```bash
# Set correct permissions
chmod 644 js/team.js          # Read/write for owner
chmod 755 admin/              # Execute permissions for directory
chmod 644 admin/*.php         # Read permissions for PHP files
```

## Customization

### 🎨 **Styling**

- Modify `css/team.css` for team page appearance
- Edit inline CSS in `admin/index.php` for admin panel
- Customize colors, fonts, and layouts

### ⚙️ **Functionality**

- Adjust pagination in `js/team.js` (`membersPerPage`)
- Modify search behavior and filters
- Add new member fields in both admin and display

### 🖼️ **Photo Settings**

- Default avatar colors in CSS
- Photo dimensions and styling
- Fallback behavior for missing images

## Support & Maintenance

### 📞 **Getting Help**

- Check server error logs for PHP issues
- Use browser developer tools for JavaScript errors
- Verify file permissions and paths

### 🔄 **Regular Maintenance**

- Backup `js/team.js` file regularly
- Monitor admin access and usage
- Update credentials periodically
- Keep PHP version updated

### 📈 **Scaling Considerations**

- Current system handles hundreds of members efficiently
- For thousands of members, consider database migration
- Monitor file size and loading performance

---

**© 2025 IHRC - Indian Human Rights Commission**

_This system provides a simple, database-free solution for managing team members with full administrative control._
