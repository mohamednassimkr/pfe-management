<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services -Scholify</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#3b82f6',secondary:'#60a5fa'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        .service-card, .product-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }
        .service-card:hover, .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .service-icon, .product-icon {
            width: 64px;
            height: 64px;
            background: #f0f9ff;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .service-icon i, .product-icon i {
            font-size: 1.5rem;
            color: #3b82f6;
        }
        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
        }
        .modal-content {
            max-width: 800px;
            width: 90%;
            margin: 2rem auto;
        }
        .modal-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
        }
        .modal-close-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.1);
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.2s ease;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .modal-close-button:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .modal-close-button i {
            font-size: 1.25rem;
            color: #64748b;
        }
        .modal-close-button:hover i {
            color: #3b82f6;
        }
        .close-button {
            position: absolute;
            top: 12px;
            right: 12px;
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.1);
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.2s ease;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .close-button:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .close-button i {
            font-size: 1.25rem;
            color: #64748b;
        }
        .close-button:hover i {
            color: #3b82f6;
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php 
    $pageTitle = "Services";
    $pageDescription = "Discover our comprehensive range of digital services designed to help your business thrive in the digital landscape";
    $activePage = "services";
    require_once 'templates/header.php'; ?>
<?php if (isset($_SESSION['role']) && (strtolower($_SESSION['role']) === 'admin' || strtolower($_SESSION['role']) === 'employe')): ?>
  <style>.nav-link.dashboard-btn{background:#60a5fa;color:#fff;padding:0.5rem 1rem;border-radius:8px;margin-left:0.5rem;transition:background 0.2s;} .nav-link.dashboard-btn:hover{background:#3b82f6;}</style>
<?php endif; ?>

<main class="main-content">
        <section class="hero-section py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our School Services</h1>
                    <p class="text-xl text-gray-700">Supporting student success through comprehensive educational programs and resources</p>
                </div>
            </div>
        </section>

        <section class="services-section py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Student Support Services</h2>
                    <p class="text-gray-600 max-w-3xl mx-auto">
                        We offer a wide range of services designed to support our students' academic, social, and emotional development throughout their educational journey.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Service Cards -->
                    <div class="service-card bg-white p-8 rounded-lg shadow-md relative" data-id="1">
                        <button onclick="closeCard(this)" class="close-button">
                            <i class="ri-close-line"></i>
                        </button>
                        <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=600&h=400&auto=format&fit=crop" alt="Academic Counseling" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-graduation-cap-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Academic Counseling</h3>
                        <p class="text-gray-600 mb-6">
                            Personalized guidance to help students navigate course selection, college planning, and academic challenges.
                        </p>
                        <button onclick="viewService(1)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                    <div class="service-card bg-white p-8 rounded-lg shadow-md" data-id="2">
                        <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=600&h=400&auto=format&fit=crop" alt="Tutoring Programs" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-book-open-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Tutoring Programs</h3>
                        <p class="text-gray-600 mb-6">
                            One-on-one and small group tutoring sessions to help students excel in challenging subjects.
                        </p>
                        <button onclick="viewService(2)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                    <div class="service-card bg-white p-8 rounded-lg shadow-md" data-id="3">
                        <img src="https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?w=600&h=400&auto=format&fit=crop" alt="Special Education" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-user-heart-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Special Education</h3>
                        <p class="text-gray-600 mb-6">
                            Individualized education plans and specialized support for students with diverse learning needs.
                        </p>
                        <button onclick="viewService(3)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                    <div class="service-card bg-white p-8 rounded-lg shadow-md" data-id="4">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&auto=format&fit=crop" alt="College Preparation" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-building-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">College Preparation</h3>
                        <p class="text-gray-600 mb-6">
                            Comprehensive support for college applications, test preparation, and scholarship opportunities.
                        </p>
                        <button onclick="viewService(4)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                    <div class="service-card bg-white p-8 rounded-lg shadow-md" data-id="5">
                        <img src="https://images.unsplash.com/photo-1519457431-44ccd64a579b?w=600&h=400&auto=format&fit=crop" alt="Career Guidance" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-briefcase-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Career Guidance</h3>
                        <p class="text-gray-600 mb-6">
                            Exploration of career paths, internship opportunities, and development of essential workplace skills.
                        </p>
                        <button onclick="viewService(5)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                    <div class="service-card bg-white p-8 rounded-lg shadow-md" data-id="6">
                        <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?w=600&h=400&auto=format&fit=crop" alt="Health Services" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-heart-pulse-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Health Services</h3>
                        <p class="text-gray-600 mb-6">
                            On-site nursing, mental health support, and wellness programs to keep students healthy and thriving.
                        </p>
                        <button onclick="viewService(6)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                </div>

                <div class="text-center mb-12 mt-20">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Academic Programs</h2>
                    <p class="text-gray-600 max-w-3xl mx-auto">
                        Our diverse curriculum offers specialized programs to meet the unique interests and talents of every student.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="program-card bg-white p-8 rounded-lg shadow-md relative" data-id="1">
                        <button onclick="closeCard(this)" class="close-button">
                            <i class="ri-close-line"></i>
                        </button>
                        <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=600&h=400&auto=format&fit=crop" alt="STEM Program" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-microscope-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">STEM Program</h3>
                        <p class="text-gray-600 mb-6">
                            Advanced courses in science, technology, engineering, and mathematics with hands-on laboratory experiences.
                        </p>
                        <button onclick="viewProgram(1)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                    <div class="program-card bg-white p-8 rounded-lg shadow-md" data-id="2">
                        <img src="https://images.unsplash.com/photo-1517607648415-b431854daa86?w=600&h=400&auto=format&fit=crop" alt="Arts & Music" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-paint-brush-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Arts & Music</h3>
                        <p class="text-gray-600 mb-6">
                            Creative arts programs including visual arts, theater, choir, band, and orchestra for aspiring artists.
                        </p>
                        <button onclick="viewProgram(2)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                    <div class="program-card bg-white p-8 rounded-lg shadow-md" data-id="3">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&h=400&auto=format&fit=crop" alt="Athletics" class="card-image">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="ri-basketball-line ri-xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Athletics</h3>
                        <p class="text-gray-600 mb-6">
                            Competitive sports teams and physical education programs promoting teamwork and healthy lifestyles.
                        </p>
                        <button onclick="viewProgram(3)" class="text-primary font-medium flex items-center">
                            View Details
                            <i class="ri-arrow-right-line ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section py-16 bg-primary bg-opacity-10">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Ready to Explore Our School Community?</h2>
                    <p class="text-gray-600 mb-8">
                        Schedule a tour, meet our educators, and discover how our programs can help your student thrive.
                    </p>
                    <button class="bg-primary text-white px-8 py-4 rounded-button font-medium hover:bg-blue-600 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-transform whitespace-nowrap">
                        Schedule a Visit
                    </button>
                </div>
            </div>
        </section>
    </main>

    <div id="serviceDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Service Details</h2>
                    <button onclick="closeServiceDetails()" class="modal-close-button">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div id="serviceDetailsContent">
                </div>
            </div>
        </div>
    </div>

    <div id="programDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Program Details</h2>
                    <button onclick="closeProgramDetails()" class="modal-close-button">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div id="programDetailsContent">
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Scholify</h3>
                    <p class="text-gray-400">123 Education Lane<br>Learningville, CA 94305<br>Phone: (555) 123-4567</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Academics</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Admissions</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="ri-facebook-fill ri-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="ri-twitter-fill ri-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="ri-instagram-line ri-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="ri-youtube-fill ri-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 Scholify. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const services = {
            1: {
                title: "Academic Counseling",
                image: "https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=600&h=400&auto=format&fit=crop",
                description: "Our academic counseling program provides personalized guidance to help students navigate their educational journey, from course selection to college planning.",
                features: [
                    "Individualized education planning",
                    "College and career guidance",
                    "Academic intervention strategies",
                    "Study skills development",
                    "Progress monitoring",
                    "Parent-teacher consultation"
                ]
            },
            2: {
                title: "Tutoring Programs",
                image: "https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=600&h=400&auto=format&fit=crop",
                description: "We offer comprehensive tutoring services to support students who need extra help in specific subjects or want to excel beyond the standard curriculum.",
                features: [
                    "One-on-one tutoring sessions",
                    "Small group study sessions",
                    "Peer tutoring programs",
                    "Subject-specific specialists",
                    "Flexible scheduling",
                    "Progress tracking and reporting"
                ]
            },
            3: {
                title: "Special Education",
                image: "https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?w=600&h=400&auto=format&fit=crop",
                description: "Our special education program provides individualized support and accommodations for students with diverse learning needs and abilities.",
                features: [
                    "Individualized Education Plans (IEPs)",
                    "Learning disability support",
                    "Speech and language therapy",
                    "Occupational therapy",
                    "Adaptive technology resources",
                    "Inclusive classroom strategies"
                ]
            },
            4: {
                title: "College Preparation",
                image: "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&auto=format&fit=crop",
                description: "Our college preparation program guides students through the entire college application process, from test preparation to application submission.",
                features: [
                    "SAT/ACT test preparation",
                    "College application assistance",
                    "Essay writing workshops",
                    "Financial aid guidance",
                    "College visit coordination",
                    "Scholarship search support"
                ]
            },
            5: {
                title: "Career Guidance",
                image: "https://images.unsplash.com/photo-1519457431-44ccd64a579b?w=600&h=400&auto=format&fit=crop",
                description: "Our career guidance program helps students explore various career paths and develop the skills needed for future success in the workplace.",
                features: [
                    "Career aptitude assessments",
                    "Internship opportunities",
                    "Job shadowing programs",
                    "Resume writing workshops",
                    "Interview skill development",
                    "Industry professional networking"
                ]
            },
            6: {
                title: "Health Services",
                image: "https://images.unsplash.com/photo-1516549655169-df83a0774514?w=600&h=400&auto=format&fit=crop",
                description: "Our comprehensive health services support the physical and mental well-being of all students through various programs and resources.",
                features: [
                    "On-site nursing care",
                    "Mental health counseling",
                    "Wellness education programs",
                    "Nutrition guidance",
                    "Emergency care coordination",
                    "Health screening services"
                ]
            }
        };

        const programs = {
            1: {
                title: "STEM Program",
                image: "https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=600&h=400&auto=format&fit=crop",
                description: "Our STEM program offers advanced courses and hands-on experiences in science, technology, engineering, and mathematics.",
                features: [
                    "Advanced Placement courses",
                    "Robotics and coding clubs",
                    "Science research opportunities",
                    "Engineering design challenges",
                    "Math competition teams",
                    "Industry partnerships"
                ]
            },
            2: {
                title: "Arts & Music",
                image: "https://images.unsplash.com/photo-1517607648415-b431854daa86?w=600&h=400&auto=format&fit=crop",
                description: "Our arts program nurtures creative expression through comprehensive visual and performing arts education.",
                features: [
                    "Studio art courses",
                    "Digital media arts",
                    "Theater productions",
                    "Choir and vocal ensembles",
                    "Instrumental music programs",
                    "Annual art exhibitions"
                ]
            },
            3: {
                title: "Athletics",
                image: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&h=400&auto=format&fit=crop",
                description: "Our athletics program promotes physical fitness, teamwork, and sportsmanship through competitive and recreational sports.",
                features: [
                    "Varsity and junior varsity teams",
                    "Intramural sports programs",
                    "Fitness and conditioning",
                    "Sports medicine support",
                    "Athletic scholarship guidance",
                    "Leadership development"
                ]
            }
        };

        function viewService(id) {
            const service = services[id];
            if (!service) return;

            const modal = document.getElementById('serviceDetailsModal');
            const content = document.getElementById('serviceDetailsContent');

            content.innerHTML = '';
            
            const container = document.createElement('div');
            container.className = 'modal-content';
            container.innerHTML = `
                <div class="relative">
                    <img src="${service.image}" alt="${service.title}" class="modal-image">
                    <div class="absolute top-4 right-4">
                        <button onclick="closeServiceDetails()" class="modal-close-button">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-4">${service.title}</h3>
                <p class="text-gray-600 mb-6">${service.description}</p>
                <h4 class="text-lg font-semibold mb-4">Program Features:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    ${service.features.map(feature => `
                        <div class="flex items-start">
                            <i class="ri-check-line text-primary mr-2 mt-1"></i>
                            <span class="text-gray-600">${feature}</span>
                        </div>
                    `).join('')}
                </div>
            `;
            
            content.appendChild(container);
            
            modal.classList.add('transition-all', 'duration-300');
            
            modal.classList.remove('hidden');
            
            setTimeout(() => {
                const closeBtn = document.querySelector('.modal-close-button');
                if (closeBtn) closeBtn.focus();
            }, 100);
        }

        function closeServiceDetails() {
            const modal = document.getElementById('serviceDetailsModal');
            const content = document.getElementById('serviceDetailsContent');
            
            modal.classList.add('transition-all', 'duration-300');
            modal.classList.add('hidden');
            
            content.innerHTML = '';
        }

        function viewProgram(id) {
            const program = programs[id];
            if (!program) return;

            const modal = document.getElementById('programDetailsModal');
            const content = document.getElementById('programDetailsContent');

            content.innerHTML = '';
            
          
            const container = document.createElement('div');
            container.className = 'modal-content';
            container.innerHTML = `
                <div class="relative">
                    <img src="${program.image}" alt="${program.title}" class="modal-image">
                    <div class="absolute top-4 right-4">
                        <button onclick="closeProgramDetails()" class="modal-close-button">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-4">${program.title}</h3>
                <p class="text-gray-600 mb-6">${program.description}</p>
                <h4 class="text-lg font-semibold mb-4">Program Features:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    ${program.features.map(feature => `
                        <div class="flex items-start">
                            <i class="ri-check-line text-primary mr-2 mt-1"></i>
                            <span class="text-gray-600">${feature}</span>
                        </div>
                    `).join('')}
                </div>
            `;
            
            content.appendChild(container);
            
          
            modal.classList.add('transition-all', 'duration-300');
            
           
            modal.classList.remove('hidden');
            
         
            setTimeout(() => {
                const closeBtn = document.querySelector('.modal-close-button');
                if (closeBtn) closeBtn.focus();
            }, 100);
        }
   
        function closeProgramDetails() {
            const modal = document.getElementById('programDetailsModal');
            const content = document.getElementById('programDetailsContent');
            
       
            modal.classList.add('transition-all', 'duration-300');
            modal.classList.add('hidden');
            
          
            content.innerHTML = '';
        }

       
        function closeCard(button) {
            const card = button.closest('.service-card, .program-card');
            if (card) {
                card.style.display = 'none';
                setTimeout(() => card.remove(), 300);
            }
        }
    </script>
</body>
</html>