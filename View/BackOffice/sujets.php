<?php

require_once __DIR__ . '/../../Controller/SujetController.php';

require_once __DIR__ . '/../../config.php';
$pdo = config::getConnexion();
$sujets = Sujet::getAll($pdo);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Sujets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="bg-gray-50 font-['Inter'] min-h-screen flex">

    <aside class="w-64 bg-white shadow-lg flex flex-col min-h-screen">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-blue-600">Admin Panel</h1>
        </div>
        <nav class="px-4">
            <a href="./index.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-dashboard-line ri-lg"></i>
                </div>
                <span class="ml-3">Dashboard</span>
            </a>
            <a href="./Sujets.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-dashboard-line ri-lg"></i>
                </div>
                <span class="ml-3">Sujets</span>
            </a>
            <a href="./document_create.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-dashboard-line ri-lg"></i>
                </div>
                <span class="ml-3">Add Document</span>
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
            <a href="./blogs.php" class="flex items-center px-4 py-3 text-gray-900 bg-blue-50 rounded-lg mb-2">
                <div class="w-8 h-8 flex items-center justify-center">
                    <i class="ri-article-line ri-lg"></i>
                </div>
                <span class="ml-3 font-medium">Blogs</span>
            </a>
            <a href="../../View/FrontOffice/index.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
            <i class="ri-home-4-line"></i>
                <span>Home</span>
            </a>
            <div class="mt-auto pt-4 border-t border-gray-200 mx-4">
                <a href="../../login.php" class="flex items-center px-4 py-3 text-red-500 hover:bg-red-50 rounded-lg">
                    <div class="w-8 h-8 flex items-center justify-center">
                        <i class="ri-logout-box-line ri-lg"></i>
                    </div>
                    <span class="ml-3">Logout</span>
                </a>
            </div>
        </nav>
    </aside>
    <main class="flex-1 p-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Gestion des Sujets</h1>
            <a href="sujet_create.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Ajouter un sujet</a>
        </div>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Enseignant</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Etudiant</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date création</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($sujets as $sujet): ?>
            <tr>
                <td><?= htmlspecialchars($sujet['id']) ?></td>
                <td><?= htmlspecialchars($sujet['titre']) ?></td>
                <td><?= htmlspecialchars($sujet['description']) ?></td>
                <td><?= htmlspecialchars($sujet['enseignant_name']) ?></td>
                <td><?= htmlspecialchars($sujet['etudiant_name']) ?></td>
                <td><?= htmlspecialchars($sujet['statut']) ?></td>
                <td><?= htmlspecialchars($sujet['date_creation']) ?></td>
                <td class="space-x-2">
                <a href="documents.php?sujet_id=<?= $sujet['id'] ?>" class="w-full bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 text-center transition">Voir les documents</a>

    <a href="sujet_edit.php?id=<?= $sujet['id'] ?>" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded transition">Modifier</a>
    <a href="sujet_delete.php?id=<?= $sujet['id'] ?>" onclick="return confirm('Supprimer ce sujet ?')" class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">Supprimer</a>
</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
