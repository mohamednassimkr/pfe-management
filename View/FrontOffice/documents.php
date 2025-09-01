<?php

require_once __DIR__ . '/../../Model/document.php';
require_once __DIR__ . '/../../config.php';
$pdo = config::getConnexion();
session_start();
$pageTitle = 'Documents';
$pageDescription = 'Liste des documents du sujet';
$activePage = 'documents';

$sujet_id = $_GET['sujet_id'] ?? null;
if (!$sujet_id) die('Sujet manquant');
$documents = Document::getAllBySujet($pdo, $sujet_id);

include 'templates/header.php';
?>
<main class="container mx-auto px-2 md:px-8 py-12 min-h-screen">
    <h1 class="text-3xl font-bold mb-8 text-center">Documents du Sujet</h1>
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($documents as $doc): ?>
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 flex flex-col justify-between h-full">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs text-gray-400">ID #<?= htmlspecialchars($doc['id']) ?></span>
                    <span class="text-xs px-2 py-1 rounded bg-blue-50 text-primary font-semibold">
                        <?= htmlspecialchars($doc['type_document']) ?>
                    </span>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 mb-2 truncate" title="<?= htmlspecialchars($doc['nom_fichier']) ?>">
                    <?= htmlspecialchars($doc['nom_fichier']) ?>
                </h2>
                <div class="mb-2">
                    <span class="text-gray-500 text-xs">Étudiant : </span>
                    <span class="font-medium text-blue-700">
                        <?= htmlspecialchars($doc['etudiant_name']) ?>
                    </span>
                </div>
                <div class="mb-2">
                    <span class="text-gray-500 text-xs">Date de soumission : </span>
                    <span class="font-medium text-gray-700">
                        <?= htmlspecialchars($doc['date_soumission']) ?>
                    </span>
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-4">
                <a href="/Scholify/download.php?file=<?= urlencode($doc['chemin_fichier']) ?>" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-center transition">Télécharger</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include 'templates/footer.php'; ?>
