<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Services Management</title>
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
                        warning: '#f59e0b'
                    },
                    spacing: {
                        '128': '32rem',
                        '144': '36rem',
                    },
                    borderRadius: {
                        '4xl': '2rem',
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
            --sidebar-width: 260px;
        }

        
        .sidebar {
            width: var(--sidebar-width);
            transition: all 0.3s ease;
        }

        .sidebar-header {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .sidebar-header h1 {
            font-family: 'Pacifico', cursive;
            font-size: 1.5rem;
        }

        .sidebar-nav a {
            transition: all 0.3s ease;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }

        .sidebar-nav a:hover {
            background-color: #f3f4f6;
        }

        .sidebar-nav a.active {
            background-color: #f0f9ff;
            color: #3b82f6;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }

       
        .service-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-icon {
            width: 48px;
            height: 48px;
            background: #f0f9ff;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Action Buttons */
        .action-buttons {
            display: none;
            transition: opacity 0.3s ease;
        }

        .service-card:hover .action-buttons {
            display: flex;
            opacity: 1;
        }

        .btn-edit, .btn-delete {
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #e0f2fe;
        }

        .btn-delete:hover {
            background-color: #fee2e2;
        }

       
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
        }

        .modal-content {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            max-width: 90%;
            width: 500px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

     
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50">
    <aside class="sidebar fixed top-0 left-0 h-screen bg-white border-r border-gray-200 z-30">
        <div class="p-6">
            <h1 class="text-2xl font-['Pacifico'] text-primary">School Admin</h1>
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
    <header class="fixed top-0 right-0 left-[260px] h-16 bg-white border-b border-gray-200 z-20">
        <div class="flex items-center justify-between h-full px-6">
            <div class="flex items-center space-x-4">
                <h2 class="text-lg font-semibold">School Services Management</h2>
                <button onclick="openModal('addServiceModal')" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                    <i class="ri-add-line ri-lg mr-2"></i>
                    Add Service
                </button>
            </div>
        </div>
    </header>
    <main class="main-content pt-16 min-h-screen">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="servicesContainer">
                
            </div>
        </div>
    </main>

    
    <div id="addServiceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 w-full max-w-md">
            <h2 class="text-xl font-semibold mb-6">Add New School Service</h2>
            <form id="addServiceForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter service title" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Image URL</label>
                    <input type="text" id="image" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter image URL" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea id="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" rows="3" placeholder="Enter service description" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Features (one per line)</label>
                    <textarea id="features" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" rows="4" placeholder="Enter features, one per line" required></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('addServiceModal')" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition-colors">Add Service</button>
                </div>
            </form>
        </div>
    </div>

 
    <div id="editServiceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 w-full max-w-md">
            <h2 class="text-xl font-semibold mb-6">Edit School Service</h2>
            <form id="editServiceForm" class="space-y-4">
                <input type="hidden" id="editId">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" id="editTitle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter service title" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Image URL</label>
                    <input type="text" id="editImage" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter image URL" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea id="editDescription" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" rows="3" placeholder="Enter service description" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Features (one per line)</label>
                    <textarea id="editFeatures" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" rows="4" placeholder="Enter features, one per line" required></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('editServiceModal')" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition-colors">Update Service</button>
                </div>
            </form>
        </div>
    </div>

    <script>
       
        let services = [
            {
                id: 1,
                title: "Academic Programs",
                image: "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&h=400&auto=format",
                description: "Comprehensive curriculum designed to foster intellectual growth and prepare students for higher education and future careers.",
                features: [
                    "STEM-focused courses",
                    "Advanced Placement options",
                    "College preparatory classes",
                    "Honors programs",
                    "Foreign language studies",
                    "Arts and music education"
                ]
            },
            {
                id: 2,
                title: "Student Counseling",
                image: "https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=600&h=400&auto=format",
                description: "Professional guidance services to support students' academic, social, and emotional development throughout their educational journey.",
                features: [
                    "Academic advising",
                    "Career planning",
                    "College application assistance",
                    "Personal counseling",
                    "Crisis intervention",
                    "Peer mediation programs"
                ]
            },
            {
                id: 3,
                title: "Extracurricular Activities",
                image: "https://images.unsplash.com/photo-1543269865-cbf427effbad?w=600&h=400&auto=format",
                description: "Diverse clubs, sports, and organizations that enrich the student experience and promote holistic development.",
                features: [
                    "Athletic teams",
                    "Academic clubs",
                    "Performing arts",
                    "Student government",
                    "Community service",
                    "Leadership programs"
                ]
            },
            {
                id: 4,
                title: "Library Resources",
                description: "Modern library facilities with extensive collections and digital resources to support learning and research.",
                image: "https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=600&h=400&auto=format",
                features: [
                    "Extensive book collection",
                    "Digital databases",
                    "Research assistance",
                    "Study spaces",
                    "Computer access",
                    "Reading programs"
                ]
            },
            {
                id: 5,
                title: "Technology Integration",
                description: "Cutting-edge technology resources and training to enhance learning experiences and digital literacy.",
                image: "https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=600&h=400&auto=format",
                features: [
                    "Computer labs",
                    "1:1 device programs",
                    "Interactive whiteboards",
                    "Coding classes",
                    "Digital citizenship education",
                    "Online learning platforms"
                ]
            },
            {
                id: 6,
                title: "Parent Involvement",
                description: "Programs and opportunities designed to engage families in the educational process and school community.",
                image: "https://images.unsplash.com/photo-1577896851231-70ef18861754?w=600&h=400&auto=format",
                features: [
                    "PTA/PTO meetings",
                    "Parent-teacher conferences",
                    "Volunteer opportunities",
                    "Family workshops",
                    "School event participation",
                    "Communication portals"
                ]
            }
        ];

      
        function initializeServiceCards() {
            const servicesContainer = document.getElementById('servicesContainer');
            if (!servicesContainer) return;

            servicesContainer.innerHTML = '';
            services.forEach(service => {
                const serviceCard = document.createElement('div');
                serviceCard.className = 'service-card bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow';
                serviceCard.dataset.id = service.id;
                serviceCard.innerHTML = `
                    <div class="relative mb-6">
                        <img src="${service.image}" alt="${service.title}" class="w-full h-48 object-cover rounded-lg">
                        <div class="absolute top-4 right-4">
                            <button onclick="deleteService(${service.id})" class="btn-delete">
                                <i class="ri-delete-bin-line ri-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="service-icon mb-4">
                        <i class="ri-book-open-line ri-xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">${service.title}</h3>
                    <p class="text-gray-600 mb-4">
                        ${service.description}
                    </p>
                    <div class="flex justify-end">
                        <button onclick="editService(${service.id})" class="btn-edit">
                            <i class="ri-edit-line ri-lg"></i>
                        </button>
                    </div>
                `;
                servicesContainer.appendChild(serviceCard);
            });
        }

       
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                
               
                if (modalId === 'addServiceModal') {
                    document.getElementById('addServiceForm').reset();
                } else if (modalId === 'editServiceModal') {
                    document.getElementById('editServiceForm').reset();
                }
            }
        }

        document.getElementById('addServiceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const service = {
                id: services.length > 0 ? Math.max(...services.map(s => s.id)) + 1 : 1,
                title: document.getElementById('title').value,
                image: document.getElementById('image').value,
                description: document.getElementById('description').value,
                features: document.getElementById('features').value.split('\n').filter(feature => feature.trim() !== '')
            };

            services.push(service);
            initializeServiceCards();
            closeModal('addServiceModal');
            showNotification('Service added successfully!');
        });

        
        document.getElementById('editServiceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const serviceId = parseInt(document.getElementById('editId').value);
            const serviceIndex = services.findIndex(s => s.id === serviceId);

            if (serviceIndex !== -1) {
                services[serviceIndex] = {
                    ...services[serviceIndex],
                    title: document.getElementById('editTitle').value,
                    image: document.getElementById('editImage').value,
                    description: document.getElementById('editDescription').value,
                    features: document.getElementById('editFeatures').value.split('\n').filter(feature => feature.trim() !== '')
                };

                initializeServiceCards();
                closeModal('editServiceModal');
                showNotification('Service updated successfully!');
            }
        });

       
        function deleteService(id) {
            if (confirm('Are you sure you want to delete this service?')) {
                const serviceIndex = services.findIndex(s => s.id === id);
                if (serviceIndex !== -1) {
                    services.splice(serviceIndex, 1);
                    initializeServiceCards();
                    showNotification('Service deleted successfully!');
                }
            }
        }

      
        function editService(id) {
            const service = services.find(s => s.id === id);
            if (!service) return;

            
            document.getElementById('editId').value = service.id;
            document.getElementById('editTitle').value = service.title;
            document.getElementById('editImage').value = service.image;
            document.getElementById('editDescription').value = service.description;
            document.getElementById('editFeatures').value = service.features.join('\n');

            openModal('editServiceModal');
        }

        
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed bottom-4 right-4 p-4 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            initializeServiceCards();
        });
    </script>
</body>
</html>