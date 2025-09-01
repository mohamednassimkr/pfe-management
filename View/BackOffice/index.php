<?php
session_start();
?>
<?php $pageTitle = 'Accueil'; include __DIR__ . '/templates/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>tailwind.config={theme:{extend:{colors:{primary:'#3b82f6',secondary:'#60a5fa'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
<style>
:root {
  --sidebar-width: 260px;
}
.sidebar {
  width: var(--sidebar-width);
}
.main-content {
  margin-left: var(--sidebar-width);
}
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
<body class="bg-gray-50">
<aside class="sidebar fixed top-0 left-0 h-screen bg-white border-r border-gray-200 z-30">
  <div class="p-6">
    <h1 class="text-2xl font-['Pacifico'] text-primary">Admin Panel</h1>
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
<header class="fixed top-0 right-0 left-[var(--sidebar-width)] h-16 bg-white border-b border-gray-200 z-20">
  <div class="flex items-center justify-between h-full px-6">
    <div class="flex-1 max-w-lg">
      <div class="relative">
        <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-lg text-sm">
        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 flex items-center justify-center text-gray-400">
          <i class="ri-search-line"></i>
        </div>
      </div>
    </div>
    <div class="flex items-center space-x-4">
      <button class="relative w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-50 rounded-full">
        <i class="ri-notification-3-line ri-lg"></i>
        <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
      </button>
      <div class="flex items-center space-x-3">
        <div class="flex items-center gap-3">
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
  </div>
</div>
        
      </div>
    </div>
  </div>
</header>
<main class="main-content pt-16 min-h-screen">
        <div class="p-6">
            <!-- Welcome Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Welcome to Scholify Academy Dashboard</h1>
                <p class="text-gray-600">Manage your school activities, track performance, and monitor student progress</p>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm stat-card border-l-academic">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-academic">
                            <i class="ri-user-3-line ri-lg"></i>
                        </div>
                        <span class="text-green-500 flex items-center">
                            <i class="ri-arrow-up-line mr-1"></i>
                            8%
                        </span>
                    </div>
                    <h3 class="text-gray-500 text-sm mb-1">Total Students</h3>
                    <p class="text-2xl font-semibold">1,245</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm stat-card border-l-primary">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-primary">
                            <i class="ri-team-line ri-lg"></i>
                        </div>
                        <span class="text-green-500 flex items-center">
                            <i class="ri-arrow-up-line mr-1"></i>
                            5%
                        </span>
                    </div>
                    <h3 class="text-gray-500 text-sm mb-1">Teaching Staff</h3>
                    <p class="text-2xl font-semibold">68</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm stat-card border-l-success">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-success">
                            <i class="ri-book-line ri-lg"></i>
                        </div>
                        <span class="text-green-500 flex items-center">
                            <i class="ri-arrow-up-line mr-1"></i>
                            12%
                        </span>
                    </div>
                    <h3 class="text-gray-500 text-sm mb-1">Courses</h3>
                    <p class="text-2xl font-semibold">42</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm stat-card border-l-secondary">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-secondary">
                            <i class="ri-calendar-event-line ri-lg"></i>
                        </div>
                        <span class="text-red-500 flex items-center">
                            <i class="ri-arrow-down-line mr-1"></i>
                            3%
                        </span>
                    </div>
                    <h3 class="text-gray-500 text-sm mb-1">Absences Today</h3>
                    <p class="text-2xl font-semibold">24</p>
                </div>
            </div>
            
            <!-- Charts and Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold">Academic Performance</h2>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Weekly</button>
                            <button class="px-3 py-1 text-sm text-white bg-primary rounded-lg">Monthly</button>
                            <button class="px-3 py-1 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Yearly</button>
                        </div>
                    </div>
                    <div class="h-80" id="performanceChart">
                        <!-- Chart will be rendered here -->
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center text-gray-500">
                                <i class="ri-line-chart-line text-4xl mb-2 text-blue-200"></i>
                                <p>Academic performance chart will be displayed here</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold mb-6">Recent Activities</h2>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center text-primary mr-4">
                                <i class="ri-user-add-line"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">New student registered</p>
                                <p class="text-xs text-gray-500">2 minutes ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center text-success mr-4">
                                <i class="ri-task-line"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Assignment graded - Mathematics</p>
                                <p class="text-xs text-gray-500">15 minutes ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-500 mr-4">
                                <i class="ri-calendar-event-line"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Parent-Teacher meeting scheduled</p>
                                <p class="text-xs text-gray-500">1 hour ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-purple-50 rounded-full flex items-center justify-center text-academic mr-4">
                                <i class="ri-mail-line"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">New announcement posted</p>
                                <p class="text-xs text-gray-500">2 hours ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-red-50 rounded-full flex items-center justify-center text-red-500 mr-4">
                                <i class="ri-error-warning-line"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Low attendance alert - Grade 10B</p>
                                <p class="text-xs text-gray-500">3 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Upcoming Events -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold mb-6">Upcoming Events</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <h3 class="font-medium">Science Fair</h3>
                        <p class="text-sm text-gray-600">Oct 15, 2023 • 10:00 AM</p>
                        <p class="text-xs text-gray-500">School Auditorium</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 py-2">
                        <h3 class="font-medium">Parent-Teacher Conference</h3>
                        <p class="text-sm text-gray-600">Oct 18, 2023 • 2:00 PM</p>
                        <p class="text-xs text-gray-500">Classrooms</p>
                    </div>
                    <div class="border-l-4 border-purple-500 pl-4 py-2">
                        <h3 class="font-medium">Sports Day</h3>
                        <p class="text-sm text-gray-600">Oct 22, 2023 • 9:00 AM</p>
                        <p class="text-xs text-gray-500">School Ground</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>



<!-- Footer -->

<script id="revenueChartScript">
document.addEventListener('DOMContentLoaded', function() {
  const chartDom = document.getElementById('revenueChart');
  const myChart = echarts.init(chartDom);
  
  const option = {
    animation: false,
    grid: {
      top: '3%',
      right: '3%',
      bottom: '3%',
      left: '3%',
      containLabel: true
    },
    tooltip: {
      trigger: 'axis',
      backgroundColor: 'rgba(255, 255, 255, 0.9)',
      borderColor: '#e5e7eb',
      borderWidth: 1,
      textStyle: {
        color: '#1f2937'
      }
    },
    xAxis: {
      type: 'category',
      data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      axisLine: {
        lineStyle: {
          color: '#e5e7eb'
        }
      },
      axisTick: {
        show: false
      }
    },
    yAxis: {
      type: 'value',
      axisLine: {
        show: false
      },
      axisTick: {
        show: false
      },
      splitLine: {
        lineStyle: {
          color: '#e5e7eb'
        }
      }
    },
    series: [
      {
        name: 'Revenue',
        type: 'line',
        smooth: true,
        data: [3000, 3500, 4200, 4800, 5200, 6000, 5800, 6500, 7000, 7200, 7800, 8500],
        lineStyle: {
          color: 'rgba(87, 181, 231, 1)'
        },
        areaStyle: {
          color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
            {
              offset: 0,
              color: 'rgba(87, 181, 231, 0.1)'
            },
            {
              offset: 1,
              color: 'rgba(87, 181, 231, 0.02)'
            }
          ])
        },
        symbol: 'none'
      }
    ]
  };
  
  myChart.setOption(option);
  
  window.addEventListener('resize', function() {
    myChart.resize();
  });
});
</script>
<script id="sidebarScript">
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