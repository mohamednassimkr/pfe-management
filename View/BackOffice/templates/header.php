<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - BackOffice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold text-primary">BackOffice</span>
                    </div>
                    
                </div>
                
                <div class="flex items-center">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="ml-3 relative">
                            <div>
                                <button type="button" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50">
                                        <?php
    echo htmlspecialchars($_SESSION['username']);
    $roleColors = [
        'admin' => 'text-red-600 bg-red-50 border-red-200',
        'etudiant' => 'text-blue-500 bg-blue-50 border-blue-200',
        'enseignant' => 'text-green-600 bg-green-50 border-green-200',
    ];
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Unknown';
    $roleLabel = ucfirst($role);
    $roleClass = isset($roleColors[$role]) ? $roleColors[$role] : 'text-gray-600 bg-gray-100 border-gray-300';
?>
<span class="ml-2 text-xs rounded px-2 py-0.5 border font-semibold <?php echo $roleClass; ?>"><?php echo $roleLabel; ?></span>
                                        <svg class="ml-2 -mr-1 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            
                            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                                <a href="/Scholify/profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profile</a>
<a href="/Scholify/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <script>
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = userMenuButton.nextElementSibling;
        
        userMenuButton.addEventListener('click', function(e) {
            e.preventDefault();
            userMenu.classList.toggle('hidden');
        });
        
        document.addEventListener('click', function(e) {
            if (!userMenuButton.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
