<?php

require_once _DIR_ . '/../../Model/sujet.php';
require_once _DIR_ . '/../../config.php';
$pdo = config::getConnexion();
session_start();
$pageTitle = 'Sujets';
$pageDescription = 'Liste des sujets de PFE disponibles';
$activePage = 'sujets';


$sujets = Sujet::getAll($pdo);

include 'templates/header.php';
?>
<main class="container mx-auto px-2 md:px-8 py-12 min-h-screen">
    <h1 class="text-3xl font-bold mb-8 text-center">Sujets de Projet de Fin d'Études</h1>
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($sujets as $sujet): ?>
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 flex flex-col justify-between h-full">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs text-gray-400">ID #<?= htmlspecialchars($sujet['id']) ?></span>
                    <span class="text-xs px-2 py-1 rounded bg-blue-50 text-primary font-semibold">
                        <?= htmlspecialchars($sujet['enseignant_name']) ?>
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 mb-2 truncate" title="<?= htmlspecialchars($sujet['titre']) ?>">
                    <?= htmlspecialchars($sujet['titre']) ?>
                </h2>
                <p class="text-gray-700 text-sm mb-4 break-words" title="<?= htmlspecialchars($sujet['description']) ?>">
                    <?= htmlspecialchars($sujet['description']) ?>
                </p>
                <div class="mb-2">
                    <span class="text-gray-500 text-xs">Étudiant : </span>
                    <span class="font-medium <?= $sujet['etudiant_name'] ? 'text-green-600' : 'text-gray-400' ?>">
                        <?= $sujet['etudiant_name'] ? htmlspecialchars($sujet['etudiant_name']) : 'Non attribué' ?>
                    </span>
                </div>
                <a href="soumettre_document.php?sujet_id=<?= $sujet['id'] ?>" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition block text-center mt-2">Soumettre un Livrable</a>
            </div>
            <div class="flex flex-col gap-2 mt-4">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'etudiant' && !$sujet['etudiant_name']): ?>
                    <form method="post" action="choisir_sujet.php" class="w-full">
                        <input type="hidden" name="sujet_id" value="<?= $sujet['id'] ?>">
                        <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Choisir ce sujet</button>
                    </form>
                <?php endif; ?>
                <a href="documents.php?sujet_id=<?= $sujet['id'] ?>" class="w-full bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 text-center transition">Voir les documents</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include 'templates/footer.php'; ?>