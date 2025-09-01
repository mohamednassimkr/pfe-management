<?php
// View: Soumission d'un document (FrontOffice, pour étudiant)
require_once __DIR__ . '/../../Model/sujet.php';
require_once __DIR__ . '/../../Model/document.php';
require_once __DIR__ . '/../../config.php';
$pdo = config::getConnexion();
session_start();
$pageTitle = 'Soumettre un Document';
$pageDescription = 'Soumission de livrable PFE';
$activePage = 'soumettre_document';

// L'étudiant ne peut soumettre que pour son sujet
$etudiant_id = $_SESSION['user_id'] ?? null;
$sujet = null;
$error = null;

// Accept sujet_id from GET if present
if (isset($_GET['sujet_id'])) {
    $sujet_id = intval($_GET['sujet_id']);
    $sujet = $pdo->query('SELECT * FROM sujets WHERE id = ' . $sujet_id . ' AND etudiant_id = ' . intval($etudiant_id))->fetch(PDO::FETCH_ASSOC);
    if (!$sujet) {
        $error = "Ce sujet ne vous est pas attribué ou n'existe pas.";
    }
} else {
    $sujet = $pdo->query('SELECT * FROM sujets WHERE etudiant_id = ' . intval($etudiant_id))->fetch(PDO::FETCH_ASSOC);
    if (!$sujet) {
        $error = "Aucun sujet attribué. Veuillez choisir un sujet avant de soumettre un document.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $sujet) {
    try {
        if (empty($_POST['type_document']) || empty($_FILES['fichier']['name'])) {
            throw new Exception('Tous les champs sont obligatoires.');
        }
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $filename = uniqid() . '_' . basename($_FILES['fichier']['name']);
        $targetPath = $uploadDir . $filename;
        if (!move_uploaded_file($_FILES['fichier']['tmp_name'], $targetPath)) {
            throw new Exception("Erreur lors de l'upload du fichier.");
        }
        Document::create($pdo, $sujet['id'], $etudiant_id, 'uploads/' . $filename, $_FILES['fichier']['name'], $_POST['type_document']);
        header('Location: documents.php?sujet_id=' . $sujet['id']);
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
include 'templates/header.php';
?>
<main class="container mx-auto px-4 py-12 max-w-xl">
    <h1 class="text-2xl font-bold mb-6 text-center">Soumettre un Document</h1>
    <?php if ($error): ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-center"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($sujet): ?>
    <form method="post" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-lg p-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sujet</label>
            <input type="text" value="#<?= htmlspecialchars($sujet['id']) ?> - <?= htmlspecialchars($sujet['titre']) ?>" class="form-control bg-gray-100" readonly>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type de document</label>
            <select name="type_document" required class="form-control">
                <option value="rapport">Rapport</option>
                <option value="code">Code</option>
                <option value="autre">Autre</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fichier</label>
            <input type="file" name="fichier" required class="form-control">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-blue-700 transition">Soumettre</button>
        </div>
    </form>
    <?php endif; ?>
</main>
<?php include 'templates/footer.php'; ?>
