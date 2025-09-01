<?php
session_start();
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown';
$role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Unknown';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#60a5fa',
                        danger: '#ef4444',
                        success: '#22c55e',
                        warning: '#f59e0b',
                        dark: '#1e293b',
                        light: '#f8fafc'
                    },
                    borderRadius: {
                        '4xl': '2rem',
                    },
                    boxShadow: {
                        'soft': '0 10px 15px -3px rgba(0, 0, 0, 0.05)',
                        'hard': '0 4px 6px -1px rgba(0, 0, 0, 0.1)'
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        :root {
            --sidebar-width: 280px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            z-index: 20;
        }

        .sidebar-header {
            background: white;
            padding: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #e2e8f0;
        }

        .sidebar-header h1 {
            font-family: 'Pacifico', cursive;
            font-size: 1.5rem;
            margin: 0;
            color: #3b82f6;
        }

        .sidebar-nav {
            padding: 1rem;
            height: calc(100% - 6rem);
            overflow-y: auto;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #1e293b;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar-nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #3b82f6;
            transition: width 0.3s ease;
        }

        .sidebar-nav a:hover::after {
            width: 100%;
        }

        .sidebar-nav a.active {
            color: #3b82f6;
            font-weight: 500;
        }

        .sidebar-nav a i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            background: #f8fafc;
        }

        .sidebar-footer a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .sidebar-footer a:hover {
            color: #3b82f6;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
            background: #f8fafc;
            position: relative;
        }

        /* Header Styles */
        .main-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1.5rem 2rem;
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Table Styles */
        .users-table-container {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin: 2rem;
            position: relative;
        }

        .users-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .users-table thead {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .users-table th {
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }

        .users-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
        }

        .users-table tr:last-child td {
            border-bottom: none;
        }

        .users-table tr:hover td {
            background-color: #f8fafc;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-pending {
            background-color: #fef9c3;
            color: #854d0e;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-edit {
            color: #3b82f6;
            background-color: #e0f2fe;
        }

        .btn-edit:hover {
            background-color: #bae6fd;
            transform: translateY(-2px);
        }

        .btn-delete {
            color: #ef4444;
            background-color: #fee2e2;
        }

        .btn-delete:hover {
            background-color: #fecaca;
            transform: translateY(-2px);
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 50;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .modal-content {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #334155;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-control:focus {
            border-color: #93c5fd;
            outline: none;
            box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.3);
            background-color: white;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background-color: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background-color: #cbd5e1;
            transform: translateY(-2px);
        }

        /* Creative Elements */
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            border-radius: 50%;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #3b82f6, transparent 70%);
            top: -100px;
            right: -100px;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, #10b981, transparent 70%);
            bottom: -50px;
            left: -50px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 30;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    .custom-input {
  border: 1px solid #e2e8f0;
  background-color: #f8fafc;
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
  cursor: text;
  min-height: 44px;
  display: flex;
  align-items: center;
  position: relative;
  margin-bottom: 0.5rem;
}
.custom-input:focus-within, .custom-input.active {
  border-color: #93c5fd;
  background-color: #fff;
  box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.3);
}
.input-display {
  color: #475569;
  font-size: 1rem;
  flex: 1;
  outline: none;
  background: transparent;
}
.input-display.placeholder {
  color: #a0aec0;
}
</style>
</head>
<body class="bg-gray-50 font-['Inter']">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

 
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1>Admin Panel</h1>
        </div>
        <nav class="px-4">
            <a href="./index.php" class="flex items-center px-4 py-3 text-gray-900 bg-blue-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-dashboard-line ri-lg"></i>
                </div>
                <span class="ml-3 font-medium">Dashboard</span>
            </a>
            <a href="./sujets.php" class="flex items-center px-4 py-3 text-gray-900 bg-blue-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-dashboard-line ri-lg"></i>
                </div>
                <span class="ml-3 font-medium">Sujets</span>
            </a>
          
            <a href="./document_create.php" class="flex items-center px-4 py-3 text-gray-900 bg-blue-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-dashboard-line ri-lg"></i>
                </div>
                <span class="ml-3 font-medium">Add Document</span>
            </a>
            
            <a href="./users.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-user-3-line ri-lg"></i>
                </div>
                <span class="ml-3">Users</span>
            </a>
            <a href="./services.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-service-line ri-lg"></i>
                </div>
                <span class="ml-3">Services</span>
            </a>
            
            <a href="./blogs.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-article-line ri-lg"></i>
                </div>
                <span class="ml-3">Blogs</span>
                
            </a>
            <a href="../../View/FrontOffice/index.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
            <i class="ri-home-4-line"></i>
                <span>Home</span>
            </a>
            
        
            <div class="mt-auto pt-4 border-t border-gray-200 mx-4">
              <a href="/Scholify/logout.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
  <div class="w-8 h-8 flex items-center justify-center">
    <i class="ri-logout-box-line ri-lg"></i>
  </div>
  <span class="ml-3">Logout</span>
</a>
            </div>
    
  </nav>
    </aside>

   
    <main class="main-content">
   
        <header class="main-header flex flex-row justify-between items-center">
  <h1 class="text-2xl font-semibold text-gray-800">Users Management</h1>
  <div class="flex items-center gap-3">
    <a  class="relative flex items-center justify-center w-11 h-11 rounded-full hover:bg-blue-100 transition-colors mr-2" title="View Messages">
      <i class="ri-notification-3-line text-2xl text-blue-600"></i>
    </a>
    <?php if ($role !== 'enseignant'): ?>
    <button onclick="openModal('addUserModal')" class="btn btn-primary">
      <i class="ri-add-line"></i>
      Add New User
    </button>
    <?php endif; ?>
    <div class="flex items-center gap-2 bg-gradient-to-r from-blue-100 to-blue-50 rounded-xl px-4 py-2 shadow-sm border border-blue-200">
      <div class="w-9 h-9 rounded-full bg-blue-200 flex items-center justify-center">
        <i class="ri-user-3-line text-blue-600 text-lg"></i>
      </div>
      <div class="flex flex-col items-start">
        <?php
          $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown';
          $role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Unknown';
        ?>
        <span class="font-semibold text-blue-900 text-base"><?php echo $username; ?></span>
        <span class="text-xs text-blue-500 bg-blue-50 rounded px-2 py-0.5 mt-1 border border-blue-200"><?php echo ucfirst($role); ?></span>
      </div>
    </div>
  </div>
</header>

<!-- Statistics Section -->
<div class="w-full flex flex-col md:flex-row gap-8 px-4 mt-6 mb-4">
  <div class="flex-1 bg-white rounded-lg shadow p-4 flex flex-col items-center">
    <h2 class="font-semibold text-lg mb-2">Users by Role</h2>
    <canvas id="rolesPieChart" width="220" height="220"></canvas>
  </div>
  <div class="flex-1 bg-white rounded-lg shadow p-4 flex flex-col items-center">
    <h2 class="font-semibold text-lg mb-2">Users by Status</h2>
    <canvas id="statusPieChart" width="220" height="220"></canvas>
  </div>
</div>


        <!-- Users Table Controls -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4 px-4">
  <div class="flex flex-col md:flex-row items-start md:items-center justify-between w-full">
  <div class="flex flex-col md:flex-row gap-2 items-start md:items-center">
    <input id="userSearchInput" type="text" placeholder="Search users..." class="form-control w-64" />
    <div class="flex gap-2 mt-2 md:mt-0">
      <button class="btn btn-secondary btn-sm" onclick="sortUsers('id')">Sort by ID</button>
      <button class="btn btn-secondary btn-sm" onclick="sortUsers('username')">Sort by Username</button>
      <button class="btn btn-secondary btn-sm" onclick="sortUsers('email')">Sort by Email</button>
    </div>
  </div>
  <button class="btn btn-primary btn-sm ml-auto mt-2 md:mt-0" style="min-width:unset;" onclick="exportUsersPDF()"><i class="ri-file-pdf-line mr-2"></i>Export PDF</button>
</div>
</div>
<!-- Users Table -->
        <div class="users-table-container animate-fade-in">
            <div class="overflow-x-auto">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <!-- Users will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal-overlay">
        <div class="modal-content">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Add New User</h2>
            <form id="addUserForm">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <div class="custom-input" id="addUsernameDiv">
  <span id="addUsernameDisplay" class="input-display" contenteditable="true" data-placeholder="Enter Username"></span>
  <input type="hidden" id="addUsernameInput" name="username" required>
</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="custom-input" id="addEmailDiv">
  <span id="addEmailDisplay" class="input-display" contenteditable="true" data-placeholder="Enter Email"></span>
  <input type="hidden" id="addEmailInput" name="email" required>
</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="relative">
                        <div class="custom-input relative" id="addPasswordDiv">
  <span id="addPasswordDisplay" class="input-display" contenteditable="true" data-placeholder="Enter Password"></span>
  <input type="hidden" id="addPasswordInput" name="password" required>
  <button type="button" onclick="togglePasswordDisplay('addPasswordDiv')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
    <i class="ri-eye-line"></i>
  </button>
</div>
                        <button type="button" onclick="togglePassword('addPassword')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <i class="ri-eye-line"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <div class="custom-dropdown" id="addRoleDropdown">
  <div class="dropdown-selected" onclick="toggleDropdown('addRoleDropdown')">Select Role</div>
  <ul class="dropdown-options hidden">
    <li data-value="enseignant">enseignant</li>
    <li data-value="etudiant">etudiant</li>
    <li data-value="admin" class="hidden">admin</li>
  </ul>
  <input type="hidden" id="addRoleInput" name="role" required>
</div>
<script>
fetch('user_crud.php?action=session_role')
  .then(r => r.json())
  .then(data => {
    if (data.role === 'admin') {
      document.querySelector('#addRoleDropdown .dropdown-options li[data-value="admin"]').classList.remove('hidden');
    }
  });
</script>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div class="custom-dropdown" id="addStatusDropdown">
  <div class="dropdown-selected" onclick="toggleDropdown('addStatusDropdown')">Select Status</div>
  <ul class="dropdown-options hidden">
    <li data-value="active">Active</li>
    <li data-value="inactive">Inactive</li>
    <li data-value="pending">Pending</li>
  </ul>
  <input type="hidden" id="addStatusInput" name="status" value="active" required>
</div>
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" onclick="closeModal('addUserModal')" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal-overlay">
        <div class="modal-content">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Edit User</h2>
            <form id="editUserForm">
                <input type="hidden" id="editUserId">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <div class="custom-input" id="editUsernameDiv">
  <span id="editUsernameDisplay" class="input-display" contenteditable="true" data-placeholder="Enter Username"></span>
  <input type="hidden" id="editUsernameInput" name="username" required>
</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="custom-input" id="editEmailDiv">
  <span id="editEmailDisplay" class="input-display" contenteditable="true" data-placeholder="Enter Email"></span>
  <input type="hidden" id="editEmailInput" name="email" required>
</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Password (leave blank to keep current)</label>
                    <div class="relative">
                        <div class="custom-input relative" id="editPasswordDiv">
  <span id="editPasswordDisplay" class="input-display" contenteditable="true" data-placeholder="Enter Password"></span>
  <input type="hidden" id="editPasswordInput" name="password">
  <button type="button" onclick="togglePasswordDisplay('editPasswordDiv')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
    <i class="ri-eye-line"></i>
  </button>
</div>
                        <button type="button" onclick="togglePassword('editPassword')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <i class="ri-eye-line"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <div class="custom-dropdown" id="editRoleDropdown">
  <div class="dropdown-selected" onclick="toggleDropdown('editRoleDropdown')">Select Role</div>
  <ul class="dropdown-options hidden">
    <li data-value="enseignant">enseignant</li>
    <li data-value="etudiant">etudiant</li>
    <li data-value="admin" class="hidden">admin</li>
  </ul>
  <input type="hidden" id="editRoleInput" name="role" required>
</div>
<script>
fetch('user_crud.php?action=session_role')
  .then(r => r.json())
  .then(data => {
    if (data.role === 'admin') {
      document.querySelector('#editRoleDropdown .dropdown-options li[data-value="admin"]').classList.remove('hidden');
    }
  });
</script>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div class="custom-dropdown" id="editStatusDropdown">
  <div class="dropdown-selected" onclick="toggleDropdown('editStatusDropdown')">Select Status</div>
  <ul class="dropdown-options hidden">
    <li data-value="active">Active</li>
    <li data-value="inactive">Inactive</li>
    <li data-value="pending">Pending</li>
  </ul>
  <input type="hidden" id="editStatusInput" name="status" required>
</div>
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" onclick="closeModal('editUserModal')" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>

    <script>
// Set currentUserRole from PHP session for JS usage
window.currentUserRole = '<?php echo isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Unknown'; ?>';

function toggleDropdown(id) {
  const dropdown = document.getElementById(id);
  const options = dropdown.querySelector('.dropdown-options');
  options.classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
  // Add User Role Dropdown
  setupCustomDropdown('addRoleDropdown', 'addRoleInput');
  setupCustomDropdown('addStatusDropdown', 'addStatusInput');
  // Edit User Role Dropdown
  setupCustomDropdown('editRoleDropdown', 'editRoleInput');
  setupCustomDropdown('editStatusDropdown', 'editStatusInput');
});

function setupCustomDropdown(dropdownId, inputId) {
  const dropdown = document.getElementById(dropdownId);
  if (!dropdown) return;
  const selected = dropdown.querySelector('.dropdown-selected');
  const options = dropdown.querySelectorAll('.dropdown-options li');
  const input = dropdown.querySelector('input[type="hidden"]');
  options.forEach(option => {
    option.addEventListener('click', function() {
      selected.textContent = this.textContent;
      input.value = this.getAttribute('data-value');
      dropdown.querySelector('.dropdown-options').classList.add('hidden');
    });
  });
  // Set default if input has value
  if (input.value) {
    const opt = Array.from(options).find(o => o.getAttribute('data-value') === input.value);
    if (opt) selected.textContent = opt.textContent;
  }
  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    if (!dropdown.contains(e.target)) {
      dropdown.querySelector('.dropdown-options').classList.add('hidden');
    }
  });
}

        let users = []; 
let filteredUsers = [];
let currentSort = { key: '', asc: true };

 
        function fetchUsers() {
  
            fetch('user_crud.php?action=list')
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        users = data.users.map(u => ({
                            ...u,
                            avatar: u.avatar || getRandomAvatar(),
                            status: u.status || 'active', 
                        }));
                        filteredUsers = [...users];
                        updateUsersTable();
                        updateCharts && updateCharts();
                    } else {
                        showNotification(data.error || 'Failed to fetch users', 'error');
                        console.error('Backend error:', data.error);
                    }
                })
                .catch(error => {
                    showNotification('Error fetching users: ' + error.message, 'error');
                    console.error('Fetch error:', error);
                });
        }

       
        document.addEventListener('DOMContentLoaded', function() {
    fetchUsers();
    document.getElementById('userSearchInput').addEventListener('input', function(e) {
        searchUsers(e.target.value);
    });
});

function searchUsers(term) {
    console.log('[DEBUG] searchUsers called with term:', term);
    term = term.toLowerCase();
    filteredUsers = users.filter(u =>
        String(u.id).includes(term) ||
        (u.username && u.username.toLowerCase().includes(term)) ||
        (u.email && u.email.toLowerCase().includes(term)) ||
        (u.role && u.role.toLowerCase().includes(term))
    );
    updateUsersTable();
}

function sortUsers(key) {
    console.log('[DEBUG] sortUsers called with key:', key, 'currentSort:', currentSort);
    currentSort.asc = currentSort.key === key ? !currentSort.asc : true;
    currentSort.key = key;
    const searchActive = document.getElementById('userSearchInput') && document.getElementById('userSearchInput').value.trim() !== '';
    const arr = searchActive ? filteredUsers : users;
    arr.sort((a, b) => {
        if (key === 'id') {
            return currentSort.asc ? (Number(a.id) - Number(b.id)) : (Number(b.id) - Number(a.id));
        } else {
            let valA = (a[key] || '').toString().toLowerCase();
            let valB = (b[key] || '').toString().toLowerCase();
            if (valA < valB) return currentSort.asc ? -1 : 1;
            if (valA > valB) return currentSort.asc ? 1 : -1;
            return 0;
        }
    });
    updateUsersTable();
}

function exportUsersPDF() {
    let jsPDFConstructor = window.jspdf && window.jspdf.jsPDF ? window.jspdf.jsPDF : window.jsPDF;
    if (!jsPDFConstructor) {
        showNotification('jsPDF library not loaded!', 'error');
        return;
    }
    const doc = new jsPDFConstructor();
    doc.setFontSize(14);
    doc.text('Users List', 10, 10);
    const headers = [['ID', 'Username', 'Email', 'Role', 'Status']];
    const searchActive = document.getElementById('userSearchInput') && document.getElementById('userSearchInput').value.trim() !== '';
    const arr = searchActive ? filteredUsers : users;
    const data = arr.map(u => [u.id, u.username, u.email, u.role, u.status]);
    if (doc.autoTable) {
        doc.autoTable({ head: headers, body: data, startY: 20 });
    } else if (typeof window.jspdf !== 'undefined' && window.jspdf.autoTable) {
        window.jspdf.autoTable(doc, { head: headers, body: data, startY: 20 });
    } else {
        let y = 20;
        headers.concat(data).forEach(row => {
            doc.text(row.join(' | '), 10, y);
            y += 10;
        });
    }
    doc.save('users.pdf');
    console.log('[DEBUG] PDF generated and download should start.');
}


        function updateUsersTable() {
    console.log('[DEBUG] updateUsersTable called. users:', users, 'filteredUsers:', filteredUsers);
    const searchInput = document.getElementById('userSearchInput');
    if (searchInput) {
        console.log('[DEBUG] userSearchInput value:', searchInput.value);
    }
    const arr = document.getElementById('userSearchInput') && document.getElementById('userSearchInput').value.trim() !== '' ? filteredUsers : users;
            const tbody = document.getElementById('usersTableBody');
            tbody.innerHTML = '';

            if (arr.length === 0) {
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="6" class="text-center py-8 text-gray-400">No users found.</td>`;
                tbody.appendChild(row);
                return;
            }
            arr.forEach(user => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors';
                row.innerHTML = `
                    <td class="font-medium text-gray-900">#${user.id}</td>
                    <td>
                        <span>${user.username}</span>
                    </td>
                    <td>${user.email}</td>
                    <td>
                        <span class="px-2 py-1 rounded-full text-xs ${user.role === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'}">
                            ${user.role}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge ${getStatusClass(user.status)}">
                            <i class="ri-${getStatusIcon(user.status)}-fill mr-1"></i>
                            ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            ${window.currentUserRole !== 'enseignant' ? `
                            <button class="action-btn btn-edit" onclick="openEditModal(${user.id})" title="Edit">
                                <i class="ri-edit-line"></i>
                            </button>
                            <button class="action-btn btn-delete" onclick="deleteUser(${user.id})" title="Delete">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                            ` : ''}
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

       
        function getStatusClass(status) {
            switch(status) {
                case 'active': return 'status-active';
                case 'inactive': return 'status-inactive';
                case 'pending': return 'status-pending';
                default: return '';
            }
        }

        function getStatusIcon(status) {
            switch(status) {
                case 'active': return 'check';
                case 'inactive': return 'close';
                case 'pending': return 'time';
                default: return 'question';
            }
        }

     
        function openModal(modalId) {
            if (window.currentUserRole === 'enseignant' && (modalId === 'addUserModal' || modalId === 'editUserModal')) {
                showNotification('You do not have permission to perform this action.', 'error');
                return;
            }
            document.getElementById(modalId).classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.body.style.overflow = '';
        }

       
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('ri-eye-line', 'ri-eye-off-line');
            } else {
                input.type = 'password';
                icon.classList.replace('ri-eye-off-line', 'ri-eye-line');
            }
        }

     
        document.getElementById('addUserForm').addEventListener('submit', function(e) {
            if (window.currentUserRole === 'enseignant') {
                showNotification('You do not have permission to add users.', 'error');
                return;
            }
            e.preventDefault();
            
            const payload = {
                username: document.getElementById('addUsernameInput').value,
                email: document.getElementById('addEmailInput').value,
                password: document.getElementById('addPasswordInput').value,
                role: document.getElementById('addRoleInput').value,
                status: document.getElementById('addStatusInput').value
            };

            fetch('user_crud.php?action=add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchUsers();
                    closeModal('addUserModal');
                    showNotification('User added successfully!', 'success');
                    document.getElementById('addUserForm').reset();
                } else {
                    showNotification(data.error || 'Failed to add user', 'error');
                }
            });
        });

        
        function getRandomAvatar() {
            const randomId = Math.floor(Math.random() * 1000);
            return `https://i.pravatar.cc/150?img=${randomId}`;
        }

     
        function openEditModal(userId) {
            const user = users.find(u => u.id == userId);
            if (!user) return;

            document.getElementById('editUserId').value = user.id;
            // Username
            document.getElementById('editUsernameInput').value = user.username;
            const editUsernameDisplay = document.getElementById('editUsernameDisplay');
            editUsernameDisplay.textContent = user.username;
            editUsernameDisplay.classList.remove('placeholder');
            // Email
            document.getElementById('editEmailInput').value = user.email;
            const editEmailDisplay = document.getElementById('editEmailDisplay');
            editEmailDisplay.textContent = user.email;
            editEmailDisplay.classList.remove('placeholder');
            // Password - clear for security
            document.getElementById('editPasswordInput').value = '';
            const editPasswordDisplay = document.getElementById('editPasswordDisplay');
            editPasswordDisplay.textContent = editPasswordDisplay.getAttribute('data-placeholder');
            editPasswordDisplay.classList.add('placeholder');
            editPasswordDisplay.dataset.reveal = '';
            // Role
            document.getElementById('editRoleInput').value = user.role;
            document.querySelector('#editRoleDropdown .dropdown-selected').textContent = user.role.charAt(0).toUpperCase() + user.role.slice(1);
            // Status
            document.getElementById('editStatusInput').value = user.status || 'active';
            document.querySelector('#editStatusDropdown .dropdown-selected').textContent = (user.status || 'active').charAt(0).toUpperCase() + (user.status || 'active').slice(1);

            openModal('editUserModal');
        }

        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            if (window.currentUserRole === 'enseignant') {
                showNotification('You do not have permission to edit users.', 'error');
                return;
            }
            e.preventDefault();
            
            const payload = {
                id: document.getElementById('editUserId').value,
                username: document.getElementById('editUsernameInput').value,
                email: document.getElementById('editEmailInput').value,
                role: document.getElementById('editRoleInput').value,
                status: document.getElementById('editStatusInput').value,
                password: document.getElementById('editPasswordInput').value
            };

            fetch('user_crud.php?action=edit', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchUsers();
                    closeModal('editUserModal');
                    showNotification('User updated successfully!', 'success');
                } else {
                    showNotification(data.error || 'Failed to update user', 'error');
                }
            });
        });

       
        function deleteUser(userId) {
            if (window.currentUserRole === 'enseignant') {
                showNotification('You do not have permission to delete users.', 'error');
                return;
            }
            if (confirm('Are you sure you want to delete this user?')) {
                fetch('user_crud.php?action=delete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id=' + encodeURIComponent(userId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchUsers();
                        showNotification('User deleted successfully!', 'success');
                    } else {
                        showNotification(data.error || 'Failed to delete user', 'error');
                    }
                });
            }
        }

        
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed bottom-6 right-6 px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 ${type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
            
            const icon = document.createElement('i');
            icon.className = type === 'success' ? 'ri-checkbox-circle-fill' : 'ri-error-warning-fill';
            
            notification.appendChild(icon);
            notification.appendChild(document.createTextNode(message));
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('opacity-0', 'translate-y-2');
                notification.addEventListener('transitionend', () => notification.remove());
            }, 3000);
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            updateUsersTable();
            
            
            setTimeout(() => {
                document.querySelectorAll('#usersTableBody tr').forEach((row, index) => {
                    row.style.animationDelay = `${index * 0.05}s`;
                    row.classList.add('animate-fade-in');
                });
            }, 100);
        });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.7.0/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let rolesChart, statusChart;
function updateCharts() {
    
    const roleCounts = { enseignant: 0, etudiant: 0, admin: 0 };
    const statusCounts = { active: 0, inactive: 0, pending: 0 };
    users.forEach(u => {
        if (roleCounts.hasOwnProperty(u.role)) roleCounts[u.role]++;
        if (statusCounts.hasOwnProperty(u.status)) statusCounts[u.status]++;
    });
    
    const roleData = {
        labels: ['Employe', 'Client', 'Admin'],
        datasets: [{
            data: [roleCounts.enseignant, roleCounts.etudiant, roleCounts.admin],
            backgroundColor: ['#2563eb', '#22d3ee', '#f59e42'],
        }]
    };
    if (rolesChart) rolesChart.destroy();
    rolesChart = new Chart(document.getElementById('rolesPieChart'), {
        type: 'pie',
        data: roleData,
        options: { responsive: false, plugins: { legend: { position: 'bottom' } } }
    });
    
    const statusData = {
        labels: ['Active', 'Inactive', 'Pending'],
        datasets: [{
            data: [statusCounts.active, statusCounts.inactive, statusCounts.pending],
            backgroundColor: ['#22c55e', '#f43f5e', '#fbbf24'],
        }]
    };
    if (statusChart) statusChart.destroy();
    statusChart = new Chart(document.getElementById('statusPieChart'), {
        type: 'pie',
        data: statusData,
        options: { responsive: false, plugins: { legend: { position: 'bottom' } } }
    });
}

const origFetchUsers = fetchUsers;
fetchUsers = function() {
    origFetchUsers.apply(this, arguments);
    setTimeout(updateCharts, 300);
};
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // For each contenteditable input, sync to hidden input on input/blur
  function syncEditableToInput(editId, inputId, isPassword) {
    const editable = document.getElementById(editId);
    const hidden = document.getElementById(inputId);
    function update() {
      let val = editable.textContent.trim();
      hidden.value = val;
      if (val === '') {
        editable.classList.add('placeholder');
        editable.textContent = editable.getAttribute('data-placeholder');
      } else {
        editable.classList.remove('placeholder');
        if (isPassword && !editable.dataset.reveal) {
          editable.textContent = '*'.repeat(val.length);
        }
      }
    }
    editable.addEventListener('focus', function() {
      if (editable.classList.contains('placeholder')) {
        editable.textContent = '';
        editable.classList.remove('placeholder');
      }
    });
    editable.addEventListener('blur', update);
    editable.addEventListener('input', function(e) {
      if (isPassword && !editable.dataset.reveal) {
        // Only allow typing and keep a true value in hidden
        let oldVal = hidden.value;
        let newVal = '';
        // Only allow single character change
        if (editable.textContent.length > oldVal.length) {
          // Character added
          let diff = editable.textContent.replace(/\*/g, '');
          newVal = oldVal + diff;
        } else if (editable.textContent.length < oldVal.length) {
          // Character removed
          newVal = oldVal.slice(0, editable.textContent.length);
        } else {
          newVal = oldVal;
        }
        hidden.value = newVal;
        editable.textContent = '*'.repeat(newVal.length);
        setCaretToEnd(editable);
      } else {
        hidden.value = editable.textContent;
      }
    });
    // Initialize placeholder
    if (!hidden.value) {
      editable.classList.add('placeholder');
      editable.textContent = editable.getAttribute('data-placeholder');
    }
  }
  function setCaretToEnd(el) {
    let range = document.createRange();
    range.selectNodeContents(el);
    range.collapse(false);
    let sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
  }
  syncEditableToInput('addUsernameDisplay', 'addUsernameInput', false);
  syncEditableToInput('addEmailDisplay', 'addEmailInput', false);
  syncEditableToInput('addPasswordDisplay', 'addPasswordInput', true);
  syncEditableToInput('editUsernameDisplay', 'editUsernameInput', false);
  syncEditableToInput('editEmailDisplay', 'editEmailInput', false);
  syncEditableToInput('editPasswordDisplay', 'editPasswordInput', true);
});

function togglePasswordDisplay(divId) {
  const div = document.getElementById(divId);
  const editable = div.querySelector('.input-display');
  const hidden = div.querySelector('input[type="hidden"]');
  if (!hidden.value) return;
  if (editable.dataset.reveal === '1') {
    editable.dataset.reveal = '';
    editable.textContent = '*'.repeat(hidden.value.length);
  } else {
    editable.dataset.reveal = '1';
    editable.textContent = hidden.value;
  }
}
</script>
</body>
</html>