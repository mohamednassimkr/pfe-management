<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scholify</title>
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
<body class="bg-white">
<div class="scroll-progress"></div>
<div class="custom-cursor"></div>

<nav class="fixed top-0 left-0 w-full bg-white bg-opacity-95 shadow-sm z-50 backdrop-blur-sm">
<div class="container mx-auto px-4 py-4 flex items-center justify-between">
<a href="index.php" class="flex items-center">
    <img src="../assets/images/logo.png" alt="Scholify Logo" style="height:40px; display:inline; vertical-align:middle; margin-right:8px;"><span class="text-2xl font-['Pacifico'] text-primary align-middle">Scholify</span>
</a>
<div class="flex-1"></div>
<div class="hidden md:flex items-center space-x-4">
<a href="index.php" class="nav-link text-gray-800 font-medium hover:text-primary transition-colors">Home</a>
<a href="sujets.php" class="nav-link text-gray-800 font-medium hover:text-primary transition-colors">Sujets</a>

<a href="services.php" class="nav-link text-gray-800 font-medium hover:text-primary transition-colors">Services</a>
<a href="blogs.php" class="nav-link text-gray-800 font-medium hover:text-primary transition-colors">Blog</a>

<?php if (isset($_SESSION['user_id'])): ?>
  <?php
    $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown';
    $role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Unknown';

    $roleColors = [
        'admin' => 'text-red-600 bg-red-50 border-red-200',
        'etudiant' => 'text-blue-500 bg-blue-50 border-blue-200',
        'enseignant' => 'text-green-600 bg-green-50 border-green-200',
    ];
    $roleLabel = isset($role) ? ucfirst($role) : 'Role';
    $roleClass = isset($roleColors[$role]) ? $roleColors[$role] : 'text-gray-600 bg-gray-100 border-gray-300';
  ?>

  <div class="relative ml-2 flex items-center space-x-2" style="z-index:1000;">
    <button id="user-menu-button-index" 
      class="flex items-center text-gray-700 hover:text-primary border border-gray-300 bg-white px-2 py-1 rounded-full shadow-sm text-sm font-medium transition focus:outline-none" 
      style="z-index:1001; min-width:0;">
      <span class="inline-flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-600">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1112 21a8.963 8.963 0 01-6.879-3.196z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
      </span>
      <span class="ml-2 font-semibold text-blue-900"><?php echo $username; ?></span>
    </button>

    <div id="user-menu-index" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow bg-white border border-gray-200" style="background:#fff; min-width:12rem;">
      <div class="py-2 px-4 border-b border-gray-200">
        <span class="text-xs rounded px-2 py-0.5 border font-semibold <?php echo $roleClass; ?>">
          <?php echo $roleLabel; ?>
        </span>
      </div>

      <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button-index">
        <a href="/Scholify/profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit Profile</a>
        <a href="/Scholify/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
      </div>
    </div>

    <noscript>
      <div class="absolute right-0 mt-2 w-40 rounded-md shadow bg-white border border-red-400">
        <a href="/Scholify/profile.php" class="block px-4 py-2 text-sm text-gray-700">Edit Profile</a>
        <a href="/Scholify/logout.php" class="block px-4 py-2 text-sm text-gray-700">Logout</a>
      </div>
    </noscript>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userMenuButton = document.getElementById('user-menu-button-index');
      const userMenu = document.getElementById('user-menu-index');
      if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', function(e) {
          e.stopPropagation();
          userMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', function(e) {
          if (!userMenu.contains(e.target) && e.target !== userMenuButton) {
            userMenu.classList.add('hidden');
          }
        });
      }
    });
  </script>
<?php endif; ?>


</div>

</div>
<div class="md:hidden hidden bg-white w-full absolute top-full left-0 shadow-md" id="mobile-menu">
<div class="container mx-auto px-4 py-2 flex flex-col space-y-4">
<a href="index.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Home</a>
<a href="about.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">About</a>
<a href="services.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Services</a>
<a href="blogs.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Blog</a>
<a href="contact.php" class="text-gray-800 font-medium py-2 hover:text-primary transition-colors">Contact</a>
</div>
</div>
</nav>
<section class="hero-section min-h-screen flex items-center pt-16" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-4 w-full">
            <div class="hero-content flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 mb-10 md:mb-0 text-white">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">SCHOLIFY ACADEMY</h1>
                    <h2 class="text-xl md:text-2xl mb-8">Shaping tomorrow's leaders through excellence in education.</h2>
                    <button class="bg-primary text-white px-6 py-3 rounded-button font-medium hover:bg-blue-600 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-transform whitespace-nowrap">Enroll Now</button>
                </div>
                <div class="w-full md:w-1/2">
                </div>
            </div>
        </div>
    </section>


    <?php if (isset($_SESSION['role']) && (strtolower($_SESSION['role']) === 'admin' || strtolower($_SESSION['role']) === 'teacher')): ?>
        <div class="flex justify-center my-8">
            <a href="../BackOffice/index.php" class="bg-secondary text-white px-6 py-3 rounded-button font-semibold shadow hover:bg-blue-400 transition-colors text-lg dashboard-btn">
                Go to Dashboard
            </a>
        </div>
    <?php endif; ?>

    <section id="about" class="py-20 bg-gradient-to-r from-blue-50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">About Our School</h2>
                <p class="text-xl text-gray-600">Discover what makes Scholify Academy special</p>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-gray-800">
                    <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed">
                        At Scholify Academy, we believe in nurturing young minds to become critical thinkers, compassionate leaders, and lifelong learners. Our mission is to provide a holistic education that balances academic excellence with character development, preparing students to thrive in a rapidly changing world while staying true to timeless values.
                    </p>
        </div>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold mb-6">Our History</h3>
                    <p class="text-gray-600 mb-6">
                        Founded in 1995, Scholify Academy has grown from a small community school to a premier educational institution serving students from diverse backgrounds. Our journey has been marked by academic excellence, innovation in teaching, and a commitment to our core values.
                    </p>
                    <p class="text-gray-600">
                        We've proudly graduated over 5,000 students who have gone on to attend top universities and make meaningful contributions to their communities. Our alumni network spans the globe, with graduates excelling in various fields from medicine and engineering to arts and public service.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <h4 class="text-4xl font-bold text-primary mb-2">95%</h4>
                        <p class="text-gray-600">University Acceptance</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <h4 class="text-4xl font-bold text-primary mb-2">25+</h4>
                        <p class="text-gray-600">Years of Excellence</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <h4 class="text-4xl font-bold text-primary mb-2">50+</h4>
                        <p class="text-gray-600">Qualified Teachers</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <h4 class="text-4xl font-bold text-primary mb-2">5,000+</h4>
                        <p class="text-gray-600">Successful Graduates</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
</div>
</div>
</div>
</section>
<section class="py-20 bg-primary bg-opacity-10">
<div class="container mx-auto px-4">

</div>
</section>
<footer class="bg-gray-900 text-white py-12">
<div class="container mx-auto px-4">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
<div>
<div class="mb-6">

</div>
<p class="text-gray-400 mb-6">
Empowering young minds to shape a better future. We specialize in providing a holistic education that nurtures academic excellence, character, and lifelong learning.
</p>
<div class="flex space-x-4">
<a href="#" class="text-gray-400 hover:text-white transition-colors">
<i class="ri-facebook-fill"></i>
</a>
<a href="#" class="text-gray-400 hover:text-white transition-colors">
<i class="ri-twitter-fill"></i>
</a>
<a href="#" class="text-gray-400 hover:text-white transition-colors">
<i class="ri-linkedin-fill"></i>
</a>
<a href="#" class="text-gray-400 hover:text-white transition-colors">
<i class="ri-instagram-fill"></i>
</a>
</div>
</div>
<div>
<h4 class="text-lg font-semibold mb-6">Quick Links</h4>
<ul class="space-y-3">
<li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
<li><a href="#about" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
<li><a href="#services" class="text-gray-400 hover:text-white transition-colors">Services</a></li>
<li><a href="#blog" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
</ul>
</div>
<div>
<h4 class="text-lg font-semibold mb-6">Services</h4>
<ul class="space-y-3">
<li><a href="#" class="text-gray-400 hover:text-white transition-colors">Web Development</a></li>
<li><a href="#" class="text-gray-400 hover:text-white transition-colors">Mobile App Development</a></li>
<li><a href="#" class="text-gray-400 hover:text-white transition-colors">UI/UX Design</a></li>
<li><a href="#" class="text-gray-400 hover:text-white transition-colors">Digital Marketing</a></li>
<li><a href="#" class="text-gray-400 hover:text-white transition-colors">E-Commerce Solutions</a></li>
</ul>
</div>
<div>
<h4 class="text-lg font-semibold mb-6">Newsletter</h4>
<p class="text-gray-400 mb-4">
Subscribe to our newsletter to receive the latest updates and news.
</p>
<form class="flex">
<input type="email" placeholder="Your email" class="w-full px-4 py-2 bg-gray-800 border-none rounded-l text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary">
<button type="submit" class="bg-primary px-4 py-2 rounded-r hover:bg-blue-600 transition-colors whitespace-nowrap">Subscribe</button>
</form>
</div>
</div>
<div class="border-t border-gray-800 pt-8">
<div class="flex flex-col md:flex-row justify-between items-center">
<p class="text-gray-400 mb-4 md:mb-0">
&copy; 2025 Scholify. All rights reserved.
</p>
<div class="flex space-x-6">
<a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
<a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
<a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
</div>
</div>
</div>
</div>
</footer>
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
</body>
</html>