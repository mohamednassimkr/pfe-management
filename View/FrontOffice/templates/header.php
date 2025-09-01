<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Scholify</title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#3b82f6',secondary:'#60a5fa'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        .hero-section {
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.8) 50%, rgba(255,255,255,0.4) 100%);
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #3b82f6;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .custom-cursor {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: rgba(59, 130, 246, 0.5);
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease;
            display: none;
        }
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background-color: #3b82f6;
            z-index: 9999;
            width: 0%;
        }
        input:focus, button:focus {
            outline: none;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }
        .custom-checkbox:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        .custom-checkbox:checked::after {
            content: "";
            position: absolute;
            top: 2px;
            left: 6px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .testimonial-card {
            transition: transform 0.3s ease;
        }
        .testimonial-card:hover {
            transform: scale(1.03);
        }
        .blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');
    
    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', function(e) {
            e.preventDefault();
            userMenu.classList.toggle('hidden');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuButton.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }
});
</script>
<body class="bg-white">
<div class="scroll-progress"></div>
<div class="custom-cursor"></div>
<!-- Navigation -->
<nav class="fixed top-0 left-0 w-full bg-white bg-opacity-95 shadow-sm z-50 backdrop-blur-sm">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <a href="index.php" class="flex items-center">
            <img src="../assets/images/logo.png" alt="Scholify Logo" style="height:40px; display:inline; vertical-align:middle; margin-right:8px;"><span class="text-2xl font-['Pacifico'] text-primary align-middle">Scholify</span>
        </a>
        <?php if (isset($_SESSION['user_id'])): ?>
          <div class="flex flex-col items-start">
      <?php
        $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown';
        $role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Unknown';
      ?>
      <span class="font-semibold text-blue-900 text-base"><?php echo $username; ?></span>
      <?php
$roleColors = [
    'admin' => 'text-red-600 bg-red-50 border-red-200',
    'etudiant' => 'text-blue-500 bg-blue-50 border-blue-200',
    'enseignant' => 'text-green-600 bg-green-50 border-green-200',
];
$roleLabel = isset($role) ? ucfirst($role) : 'Role';
$roleClass = isset($roleColors[$role]) ? $roleColors[$role] : 'text-gray-600 bg-gray-100 border-gray-300';
?>
<span class="text-xs rounded px-2 py-0.5 mt-1 border font-semibold <?php echo $roleClass; ?>"><?php echo $roleLabel; ?></span>
    </div>
        <?php endif; ?>
        <div class="flex-1"></div>
        <div class="hidden md:flex items-center space-x-4">
            <a href="index.php" class="nav-link text-gray-800 font-medium hover:text-primary transition-colors">Home</a>
            <a href="sujets.php" class="nav-link text-gray-800 font-medium hover:text-primary transition-colors">Sujets</a>
            <a href="services.php" class="nav-link text-gray-800 font-medium hover:text-primary transition-colors">Services</a>
            <a href="blogs.php" class="nav-link text-gray-800 font-medium hover:text-primary transition-colors">Blog</a>
            <div class="relative" style="z-index:1000;">
                <button id="user-menu-button" class="flex items-center space-x-2 text-gray-700 hover:text-primary border border-gray-300 bg-white px-2 py-1 rounded-full shadow-sm text-sm font-medium transition focus:outline-none" style="z-index:1001; min-width:0;">
                    <span class="inline-flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-600 mr-1">
      
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1112 21a8.963 8.963 0 01-6.879-3.196z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                    <?php if (isset($_SESSION['username'])): ?>
                        <span class="truncate max-w-[90px] font-medium"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <?php endif; ?>
                </button>
                <div id="user-menu" class="absolute right-0 mt-2 w-40 rounded-md shadow bg-white border border-gray-200" style="background:#fff; min-width:8rem;">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                        <a href="/Scholify/profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit Profile</a>
                        <a href="/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
                    </div>
                </div>
                <noscript>
                    <div class="absolute right-0 mt-2 w-40 rounded-md shadow bg-white border border-red-400">
                        <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700">Edit Profile</a>
                        <a href="/logout.php" class="block px-4 py-2 text-sm text-gray-700">Logout</a>
                    </div>
                </noscript>
            </div>
        </div>
      
        
    </div>
    <div class="md:hidden hidden bg-white w-full absolute top-full left-0 shadow-md" id="mobile-menu">
        <div class="container mx-auto px-4 py-2 flex flex-col space-y-4">
            <a href="index.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Home</a>
            <a href="sujets.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Sujets</a>
            <?php if (isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'etudiant'): ?>
            <a href="soumettre_document.php" class="text-primary font-medium py-2 hover:text-blue-700 transition-colors">Soumettre un Livrable</a>
            <?php endif; ?>
            <a href="services.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Services</a>
            <a href="blogs.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Blog</a>
            <a href="contact.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Contact</a>
        </div>
    </div>
</nav>

<script id="mobileMenuScript">
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenuButton.innerHTML = '<i class="ri-menu-line ri-lg"></i>';
        } else {
            mobileMenuButton.innerHTML = '<i class="ri-close-line ri-lg"></i>';
        }
    });
    // Close mobile menu when clicking on a link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            mobileMenuButton.innerHTML = '<i class="ri-menu-line ri-lg"></i>';
        });
    });
});
</script>

<script id="scrollProgressScript">
document.addEventListener('DOMContentLoaded', function() {
    const scrollProgress = document.querySelector('.scroll-progress');
    window.addEventListener('scroll', function() {
        const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollPercentage = (scrollTop / scrollHeight) * 100;
        scrollProgress.style.width = scrollPercentage + '%';
    });
});
</script>

<script id="customCursorScript">
document.addEventListener('DOMContentLoaded', function() {
    const cursor = document.querySelector('.custom-cursor');
    document.addEventListener('mousemove', function(e) {
        cursor.style.display = 'block';
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
    });
    document.addEventListener('mouseout', function() {
        cursor.style.display = 'none';
    });
    const links = document.querySelectorAll('a, button');
    links.forEach(link => {
        link.addEventListener('mouseenter', function() {
            cursor.style.transform = 'translate(-50%, -50%) scale(1.5)';
            cursor.style.backgroundColor = 'rgba(59, 130, 246, 0.3)';
        });
        link.addEventListener('mouseleave', function() {
            cursor.style.transform = 'translate(-50%, -50%) scale(1)';
            cursor.style.backgroundColor = 'rgba(59, 130, 246, 0.5)';
        });
    });
});
</script>

<script id="smoothScrollScript">
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>

<?php
// If this is the first page load, set active page
if (!isset($activePage)) {
    $activePage = basename($_SERVER['PHP_SELF'], '.php');
    if ($activePage === 'index') $activePage = 'home';
}
?>
