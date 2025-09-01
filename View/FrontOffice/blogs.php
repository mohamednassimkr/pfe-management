<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Scholify</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#3b82f6',secondary:'#60a5fa'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        .blog-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .blog-image {
            height: 200px;
            overflow: hidden;
        }
        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .blog-card:hover .blog-image img {
            transform: scale(1.05);
        }
        .comment-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .comment-form textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .comment-form button {
            background: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .comment-form button:hover {
            background: #2563eb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php 
    $pageTitle = "Blog";
    $pageDescription = "Découvrez nos articles sur la mobilité durable";
    $activePage = "blog";
    require_once 'templates/header.php'; ?>
<?php if (isset($_SESSION['role']) && (strtolower($_SESSION['role']) === 'admin' || strtolower($_SESSION['role']) === 'employe')): ?>
  <style>.nav-link.dashboard-btn{background:#60a5fa;color:#fff;padding:0.5rem 1rem;border-radius:8px;margin-left:0.5rem;transition:background 0.2s;} .nav-link.dashboard-btn:hover{background:#3b82f6;}</style>
<?php endif; ?>

    <main class="main-content">
        <section class="hero-section py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Blog</h1>
                    <p class="text-xl text-gray-700">Stay updated with the latest trends, insights, and news from the digital world</p>
                </div>
                <div class="flex justify-between items-center mb-8">
                </div>
            </div>
        </section>

        <section class="blog-grid py-20">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold">All Blogs</h2>
                    <button id="addBlogButton" onclick="showAddBlogModal()" class="bg-primary text-white px-6 py-3 rounded-button font-medium hover:bg-blue-600 transition-colors">
                        <i class="ri-add-line mr-2"></i>Add Blog
                    </button>
                </div>
                <div id="blogList" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                </div>
            </div>
        </section>


        <div id="addBlogModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-lg p-8 w-full max-w-2xl">
                <div class="flex justify-between items-center mb-6">

                    <button onclick="hideAddBlogModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="ri-close-line ri-xl"></i>
                    </button>
                </div>
                <form id="addBlogForm" onsubmit="return addBlog(event)">
                    <div class="mb-6">
                        <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                        <input type="text" id="title" name="title" class="w-full px-4 py-3 border border-gray-300 rounded focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-colors" required>
                    </div>
                    <div class="mb-6">
                        <label for="content" class="block text-gray-700 font-medium mb-2">Content</label>
                        <textarea id="content" name="content" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-colors" required></textarea>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="hideAddBlogModal()" class="px-6 py-3 text-gray-600 hover:text-gray-800">Cancel</button>
                        <button type="submit" class="bg-primary text-white px-6 py-3 rounded-button font-medium hover:bg-blue-600 transition-colors">Add Blog</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="blogDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-lg p-8 w-full max-w-4xl">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Blog Details</h2>
                    <button onclick="closeBlogDetails()" class="text-gray-400 hover:text-gray-600">
                        <i class="ri-close-line ri-xl"></i>
                    </button>
                </div>
                <div id="blogDetailsContent">
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-4">Comments</h3>
                    <div id="commentsList">
                    </div>
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold mb-4">Leave a Comment</h4>
                        <form id="commentForm" onsubmit="return addComment(event)">
                            <textarea id="commentContent" name="commentContent" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-colors" required></textarea>
                            <button type="submit" class="mt-4 bg-primary text-white px-6 py-3 rounded-button font-medium hover:bg-blue-600 transition-colors">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let blogs = [
            {
                id: 1,
                title: "The Importance of Effective Study Habits",
                content: "Discover how developing good study habits can improve learning outcomes and help students succeed academically.",
                date: "June 15, 2025",
                image: "https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&auto=format",
                comments: []
            },
            {
                id: 2,
                title: "How Teachers Can Use Technology in the Classroom",
                content: "Explore practical ways teachers can integrate digital tools to make lessons more engaging and interactive.",
                date: "June 18, 2025",
                image: "https://images.unsplash.com/photo-1556761175-4b46a572b786?w=600&h=400&auto=format",
                comments: []
            },
            {
                id: 3,
                title: "The Importance of Effective Study Habits",
                content: "Discover how developing good study habits can improve learning outcomes and help students succeed academically.",
                date: "June 22, 2025",
                image: "https://images.unsplash.com/photo-1519681393784-d120267933ba?w=600&h=400&auto=format",
                comments: []
            },
           
        ];
        function initializeBlogList() {
            const blogList = document.getElementById('blogList');
            blogList.innerHTML = blogs.map(blog => `
                <div class="blog-card relative" data-id="${blog.id}">
                    <button class="close-button absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <i class="ri-close-line ri-xl"></i>
                    </button>
                    <div class="blog-image">
                        <img src="${blog.image}" alt="${blog.title}" class="w-full h-48 object-cover">
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-500 mb-2">${blog.date}</div>
                        <h3 class="text-xl font-semibold mb-3">${blog.title}</h3>
                        <p class="text-gray-600 mb-4">${blog.content}</p>
                        <div class="flex space-x-4">
                            <button onclick="viewBlog(${blog.id})" class="text-primary font-medium flex items-center">
                                View Details
                                <i class="ri-arrow-right-line ml-2"></i>
                            </button>
                            <button onclick="deleteBlog(${blog.id})" class="text-red-500 hover:text-red-700">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            const closeButtons = document.querySelectorAll('.close-button');
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const blogCard = this.closest('.blog-card');
                    const id = blogCard.dataset.id;
                    closeBlogCard(id);
                });
            });
        }

        function addBlog(event) {
            event.preventDefault();
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            const date = new Date().toLocaleDateString();
            
            const newBlog = {
                id: blogs.length + 1,
                title: title,
                content: content,
                date: date,
                image: "https://via.placeholder.com/600x400",
                comments: []
            };

            blogs.push(newBlog);
            initializeBlogList();
            hideAddBlogModal();
            return false;
        }

        function deleteBlog(id) {
            if (confirm('Are you sure you want to delete this blog?')) {
                blogs = blogs.filter(blog => blog.id !== id);
                initializeBlogList();
            }
        }

        function viewBlog(id) {
            const blog = blogs.find(b => b.id === id);
            if (blog) {
                window.location.hash = id; 
                const blogDetailsContent = document.getElementById('blogDetailsContent');
                blogDetailsContent.innerHTML = `
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold mb-4">${blog.title}</h1>
                        <div class="text-sm text-gray-500 mb-6">${blog.date}</div>
                        <div class="mb-6">
                            <img src="${blog.image}" alt="${blog.title}" class="w-full rounded-lg">
                        </div>
                        <p class="text-gray-600 mb-8">${blog.content}</p>
                        <button onclick="deleteBlog(${blog.id})" class="text-red-500 hover:text-red-700">
                            <i class="ri-delete-bin-line"></i> Delete Blog
                        </button>
                    </div>
                `;
                
                const commentsList = document.getElementById('commentsList');
                commentsList.innerHTML = blog.comments.map(comment => `
                    <div class="comment-card">
                        <div class="text-sm text-gray-500 mb-2">${comment.date}</div>
                        <p class="text-gray-600">${comment.content}</p>
                    </div>
                `).join('');
                
                document.getElementById('blogDetailsModal').classList.remove('hidden');
            }
        }

        function deleteComment(blogId, commentId) {
            const blog = blogs.find(b => b.id === blogId);
            if (blog) {
                blog.comments = blog.comments.filter(comment => comment.id !== commentId);
                
                const commentsList = document.getElementById('commentsList');
                commentsList.innerHTML = blog.comments.map(comment => `
                    <div class="comment-card">
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500">${comment.date}</div>
                            <button onclick="deleteComment(${blogId}, ${comment.id})" class="text-red-500 hover:text-red-700">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                        <p class="text-gray-600">${comment.content}</p>
                    </div>
                `).join('');
            }
        }

        function addComment(event) {
            event.preventDefault();
            const commentContent = document.getElementById('commentContent').value;
            const blogId = parseInt(window.location.hash.replace('#', ''));
            if (!blogId) return;
            
            const blog = blogs.find(b => b.id === blogId);
            if (blog) {
                const newComment = {
                    id: blog.comments.length + 1,
                    content: commentContent,
                    date: new Date().toLocaleDateString()
                };
                
                blog.comments.push(newComment);
                
                const commentsList = document.getElementById('commentsList');
                commentsList.innerHTML = blog.comments.map(comment => `
                    <div class="comment-card">
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500">${comment.date}</div>
                            <button onclick="deleteComment(${blogId}, ${comment.id})" class="text-red-500 hover:text-red-700">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                        <p class="text-gray-600">${comment.content}</p>
                    </div>
                `).join('');
                
                document.getElementById('commentContent').value = '';
            }
            return false;
        }

        function showAddBlogModal() {
            document.getElementById('addBlogModal').classList.remove('hidden');
        }

        function hideAddBlogModal() {
            document.getElementById('addBlogModal').classList.add('hidden');
            document.getElementById('addBlogForm').reset();
        }

        document.addEventListener('DOMContentLoaded', initializeBlogList);
        function closeBlogCard(id) {

            const blogCard = document.querySelector(`.blog-card[data-id="${id}"]`);
            if (blogCard) {
                blogCard.remove();

                blogs = blogs.filter(blog => blog.id !== id);

                initializeBlogList();
            }
        }


        function closeBlogDetails() {
            const modal = document.getElementById('blogDetailsModal');
            modal.classList.add('hidden');

            const content = document.getElementById('blogDetailsContent');
            content.innerHTML = '';
        }

    </script>

    <?php require_once 'templates/footer.php'; ?>

    <script src="../assets/js/main.js"></script>
</body>
</html>

    <?php require_once 'templates/footer.php'; ?>

    <script src="../assets/js/main.js"></script>
</body>
</html>