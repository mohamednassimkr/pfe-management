<?php $pageTitle = 'Blogs'; include __DIR__ . '/templates/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs Management</title>
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

     
        .blog-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-5px);
        }

        .blog-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-meta {
            padding: 1.5rem;
        }

        .blog-meta .date {
            color: #64748b;
            font-size: 0.875rem;
        }


        .action-buttons {
            display: none;
            transition: opacity 0.3s ease;
        }

        .blog-card:hover .action-buttons {
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
            width: 600px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

       
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4b5563;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .blog-card img {
                height: 150px;
            }
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
                <h2 class="text-lg font-semibold">School News Management</h2>
                <button onclick="openModal('addBlogModal')" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                    <i class="ri-add-line ri-lg mr-2"></i>
                    Add News
                </button>
            </div>
        </div>
    </header>
    <main class="main-content pt-16 min-h-screen">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="blogsContainer">
              
            </div>
        </div>
    </main>

   
    <div id="addBlogModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 w-full max-w-2xl">
            <h3 class="text-xl font-semibold mb-4">Add News Article</h3>
            <form id="addBlogForm" class="space-y-4">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Title</label>
                    <input type="text" id="blogTitle" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Featured Image URL</label>
                    <input type="text" id="blogImage" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Publication Date</label>
                    <input type="date" id="blogDate" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Content</label>
                    <textarea id="blogContent" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary h-48" required></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('addBlogModal')" class="text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-600">Add News</button>
                </div>
            </form>
        </div>
    </div>

   
    <div id="editBlogModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 w-full max-w-2xl">
            <h3 class="text-xl font-semibold mb-4">Edit News Article</h3>
            <form id="editBlogForm" class="space-y-4">
                <input type="hidden" id="editBlogId">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Title</label>
                    <input type="text" id="editBlogTitle" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Featured Image URL</label>
                    <input type="text" id="editBlogImage" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Publication Date</label>
                    <input type="date" id="editBlogDate" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Content</label>
                    <textarea id="editBlogContent" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary h-48" required></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('editBlogModal')" class="text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-600">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        
        let blogs = [
            {
                id: 1,
                title: 'Annual Science Fair Winners Announced',
                featuredImage: 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=600&h=400&auto=format&fit=crop',
                date: '2025-07-01',
                content: 'Congratulations to all participants in our annual science fair. The projects showcased incredible creativity and scientific understanding.'
            },
            {
                id: 2,
                title: 'New Athletic Facilities Now Open',
                featuredImage: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&h=400&auto=format&fit=crop',
                date: '2025-06-25',
                content: 'Our new state-of-the-art athletic facilities are now open for student use, featuring a renovated gym and outdoor sports complex.'
            },
            {
                id: 3,
                title: 'Summer Reading Program Launch',
                featuredImage: 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=600&h=400&auto=format&fit=crop',
                date: '2025-06-18',
                content: 'Join our summer reading challenge to keep students engaged with literature during the break. Prizes available for top readers!'
            }
        ];

        
        function formatDisplayDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }

        
        function initializeBlogCards() {
            const blogsContainer = document.getElementById('blogsContainer');
            if (!blogsContainer) return;

            blogsContainer.innerHTML = '';
            blogs.forEach(blog => {
                const blogCard = document.createElement('div');
                blogCard.className = 'blog-card bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow';
                blogCard.dataset.id = blog.id;
                blogCard.innerHTML = `
                    <div class="mb-4">
                        <img src="${blog.featuredImage}" alt="${blog.title}" class="w-full h-48 object-cover rounded-lg">
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-sm text-gray-500">${formatDisplayDate(blog.date)}</div>
                        <div class="action-buttons">
                            <button class="text-blue-500 hover:text-blue-600" onclick="editBlog(${blog.id})">
                                <i class="ri-edit-2-line ri-lg"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-600 ml-2" onclick="deleteBlog(${blog.id})">
                                <i class="ri-delete-bin-line ri-lg"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">${blog.title}</h3>
                    <p class="text-gray-600">${blog.content}</p>
                `;
                blogsContainer.appendChild(blogCard);
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
                
               
                if (modalId === 'addBlogModal') {
                    document.getElementById('addBlogForm').reset();
                } else if (modalId === 'editBlogModal') {
                    document.getElementById('editBlogForm').reset();
                }
            }
        }

        document.getElementById('addBlogForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newBlog = {
                id: blogs.length > 0 ? Math.max(...blogs.map(b => b.id)) + 1 : 1,
                title: document.getElementById('blogTitle').value,
                featuredImage: document.getElementById('blogImage').value,
                date: document.getElementById('blogDate').value,
                content: document.getElementById('blogContent').value
            };

            blogs.push(newBlog);
            initializeBlogCards();
            closeModal('addBlogModal');
            showNotification('News article added successfully!');
        });

        
        document.getElementById('editBlogForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const blogId = parseInt(document.getElementById('editBlogId').value);
            const blogIndex = blogs.findIndex(b => b.id === blogId);

            if (blogIndex !== -1) {
                blogs[blogIndex] = {
                    id: blogId,
                    title: document.getElementById('editBlogTitle').value,
                    featuredImage: document.getElementById('editBlogImage').value,
                    date: document.getElementById('editBlogDate').value,
                    content: document.getElementById('editBlogContent').value
                };

                initializeBlogCards();
                closeModal('editBlogModal');
                showNotification('News article updated successfully!');
            }
        });

        
        function deleteBlog(id) {
            if (confirm('Are you sure you want to delete this news article?')) {
                const blogIndex = blogs.findIndex(b => b.id === id);
                if (blogIndex !== -1) {
                    blogs.splice(blogIndex, 1);
                    initializeBlogCards();
                    showNotification('News article deleted successfully!');
                }
            }
        }

     
        function editBlog(id) {
            const blog = blogs.find(b => b.id === id);
            if (!blog) return;

         
            document.getElementById('editBlogId').value = blog.id;
            document.getElementById('editBlogTitle').value = blog.title;
            document.getElementById('editBlogImage').value = blog.featuredImage;
            document.getElementById('editBlogDate').value = blog.date;
            document.getElementById('editBlogContent').value = blog.content;

            openModal('editBlogModal');
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
            initializeBlogCards();
        });
    </script>
</body>
</html>