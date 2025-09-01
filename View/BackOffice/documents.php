<?php
// View: List all Documents for a Sujet (BackOffice)
require_once __DIR__ . '/../../Controller/DocumentController.php';
$documentController = new DocumentController();
$sujet_id = $_GET['sujet_id'] ?? null;
if (!$sujet_id) die('Sujet manquant');
$documents = $documentController->getAllBySujet($sujet_id);
?>
<?php session_start(); $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown'; $role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Unknown'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Documents du Sujet</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        :root { --sidebar-width: 280px; }
        .sidebar { width: var(--sidebar-width); position: fixed; top: 0; left: 0; height: 100vh; background: white; box-shadow: 2px 0 10px rgba(0,0,0,0.05); transition: all 0.3s ease; z-index: 20; }
        .sidebar-header { background: white; padding: 1.5rem; text-align: center; border-bottom: 1px solid #e2e8f0; }
        .sidebar-header h1 { font-family: 'Pacifico', cursive; font-size: 1.5rem; color: #3b82f6; }
        .sidebar-nav { padding: 1rem; height: calc(100% - 6rem); overflow-y: auto; }
        .sidebar-nav a { display: flex; align-items: center; padding: 0.75rem 1rem; color: #1e293b; text-decoration: none; transition: all 0.3s ease; position: relative; }
        .sidebar-nav a.active { color: #3b82f6; font-weight: 500; }
        .sidebar-nav a i { margin-right: 0.75rem; font-size: 1.1rem; }
        .sidebar-footer { padding: 1.5rem; border-top: 1px solid #e2e8f0; text-align: center; background: #f8fafc; }
        .sidebar-footer a { color: #64748b; text-decoration: none; transition: color 0.2s ease; }
        .sidebar-footer a:hover { color: #3b82f6; }
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; transition: all 0.3s ease; background: #f8fafc; position: relative; padding: 2rem; }
        .main-header { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 1.5rem 2rem; position: sticky; top: 0; z-index: 10; display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body class="bg-gray-50 font-['Inter']">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1>Admin Panel</h1>
        </div>
        <nav class="sidebar-nav">
            <a href="./index.php" class="flex items-center"><i class="ri-dashboard-line"></i><span>Dashboard</span></a>
            <a href="./sujets.php" class="flex items-center"><i class="ri-service-line"></i><span>Sujets</span></a>
            <a href="./document_create.php" class="flex items-center active"><i class="ri-service-line"></i><span>Document</span></a>
            <a href="./services.php" class="flex items-center"><i class="ri-service-line"></i><span>Services</span></a>
            <a href="./blogs.php" class="flex items-center"><i class="ri-article-line"></i><span>Blogs</span></a>
            <a href="./users.php" class="flex items-center"><i class="ri-user-3-line"></i><span>Users</span></a>
            <a href="../../View/FrontOffice/index.php" class="flex items-center"><i class="ri-home-4-line"></i><span>Home</span></a>
            <div class="mt-auto pt-4 border-t border-gray-200">
                <a href="../../login.php" class="flex items-center text-red-500 hover:bg-red-50"><i class="ri-logout-box-line"></i><span>Logout</span></a>
            </div>
        </nav>
    </aside>
    <main class="main-content">
        <header class="main-header flex flex-row justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Documents du Sujet #<?= htmlspecialchars($sujet_id) ?></h1>
            <div class="flex items-center gap-3">
                <span class="font-semibold text-blue-900 text-base"><?php echo $username; ?></span>
                <span class="text-xs text-blue-500 bg-blue-50 rounded px-2 py-0.5 border border-blue-200"><?php echo ucfirst($role); ?></span>
            </div>
        </header>
        <div class="flex justify-between items-center my-4">
            <a href="document_create.php?sujet_id=<?= $sujet_id ?>" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Ajouter un document</a>
            <a href="sujets.php" class="btn btn-secondary bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">Retour aux sujets</a>
        </div>
        <div class="overflow-x-auto bg-white rounded-lg shadow p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom du fichier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Etudiant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de soumission</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fichier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($documents as $doc): ?>
            <tr>
                <td><?= htmlspecialchars($doc['id']) ?></td>
                <td><?= htmlspecialchars($doc['nom_fichier']) ?></td>
                <td><?= htmlspecialchars($doc['type_document']) ?></td>
                <td><?= htmlspecialchars($doc['etudiant_name']) ?></td>
                <td><?= htmlspecialchars($doc['date_soumission']) ?></td>
                <td><a href="/<?= htmlspecialchars($doc['chemin_fichier']) ?>" target="_blank">Télécharger</a></td>
                <td>
                    <a href="document_delete.php?id=<?= $doc['id'] ?>&sujet_id=<?= $sujet_id ?>" onclick="return confirm('Supprimer ce document ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="sujets.php">Retour aux sujets</a>
</body>
</html>
