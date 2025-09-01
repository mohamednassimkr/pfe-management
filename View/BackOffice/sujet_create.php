<?php
// View: Create a Sujet (BackOffice, for admin/enseignant)
require_once __DIR__ . '/../../Controller/SujetController.php';
$sujetController = new SujetController();
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sujetController->create($_POST);
        header('Location: sujets.php');
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
// Fetch enseignants for dropdown
require_once __DIR__ . '/../../config.php';
$pdo = config::getConnexion();
$enseignants = $pdo->query("SELECT id, username FROM users WHERE role='enseignant'")->fetchAll(PDO::FETCH_ASSOC);
$etudiants = $pdo->query("SELECT id, username FROM users WHERE role='etudiant'")->fetchAll(PDO::FETCH_ASSOC);
?>
<?php $pageTitle = 'Créer Sujet'; include __DIR__ . '/templates/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Sujet</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        :root {
            --sidebar-width: 280px;
        }
        .sidebar { width: var(--sidebar-width); position: fixed; top: 0; left: 0; height: 100vh; background: white; box-shadow: 2px 0 10px rgba(0,0,0,0.05); z-index: 20; }
        .sidebar-header { background: white; padding: 1.5rem; text-align: center; border-bottom: 1px solid #e2e8f0; }
        .sidebar-header h1 { font-family: 'Pacifico', cursive; font-size: 1.5rem; color: #3b82f6; }
        .sidebar-nav { padding: 1rem; height: calc(100% - 6rem); overflow-y: auto; }
        .sidebar-nav a { display: flex; align-items: center; padding: 0.75rem 1rem; color: #1e293b; text-decoration: none; transition: all 0.3s ease; position: relative; }
        .sidebar-nav a.active { color: #3b82f6; font-weight: 500; }
        .sidebar-nav a i { margin-right: 0.75rem; font-size: 1.1rem; }
        .sidebar-footer { padding: 1.5rem; border-top: 1px solid #e2e8f0; text-align: center; background: #f8fafc; }
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; background: #f8fafc; position: relative; padding: 2rem 2rem; }
    </style>
</head>
<body class="bg-gray-50 font-['Inter']">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1>Admin Panel</h1>
        </div>
        <nav class="sidebar-nav">
            <a href="./index.php"><i class="ri-dashboard-line"></i><span>Dashboard</span></a>
            <a href="./sujets.php" class="active"><i class="ri-service-line"></i><span>Sujets</span></a>
            <a href="./document_create.php"><i class="ri-service-line"></i><span>Document</span></a>
            <a href="./services.php"><i class="ri-service-line"></i><span>Services</span></a>
            <a href="./blogs.php"><i class="ri-article-line"></i><span>Blogs</span></a>
            <a href="./users.php"><i class="ri-user-3-line"></i><span>Users</span></a>
            <a href="../../View/FrontOffice/index.php"><i class="ri-home-4-line"></i><span>Home</span></a>
            <div class="mt-auto pt-4 border-t border-gray-200">
                <a href="../../login.php" class="text-red-500 hover:bg-red-50"><i class="ri-logout-box-line"></i><span>Logout</span></a>
            </div>
        </nav>
    </aside>
    <!-- Main Content -->
    <main class="main-content">
        <h1 class="text-2xl font-semibold text-gray-800 mb-8">Ajouter un Sujet</h1>
        <?php if ($error): ?><div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post" id="sujet-form" class="max-w-xl bg-white rounded-lg shadow-md p-8">
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" name="titre" id="titre" required class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm" placeholder="Titre du sujet">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm" placeholder="Description du sujet"></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Enseignant</label>
                <select name="enseignant_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="">-- Choisir --</option>
                    <?php foreach ($enseignants as $ens): ?>
                        <option value="<?= $ens['id'] ?>"><?= htmlspecialchars($ens['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Etudiant (optionnel)</label>
                <select name="etudiant_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="">-- Aucun --</option>
                    <?php foreach ($etudiants as $etu): ?>
                        <option value="<?= $etu['id'] ?>"><?= htmlspecialchars($etu['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="statut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="proposé">Proposé</option>
                    <option value="validé">Validé</option>
                    <option value="refusé">Refusé</option>
                    <option value="attribué">Attribué</option>
                </select>
            </div>
            <div class="flex gap-4">
                <button type="submit" class="btn btn-primary !bg-blue-600 !text-white font-bold px-6 py-2 rounded shadow" style="opacity:1; visibility:visible;">Ajouter</button>
                <a href="sujets.php" class="btn btn-secondary bg-gray-200 text-gray-700 px-6 py-2 rounded shadow hover:bg-gray-300">Retour</a>
            </div>
        </form>
    </main>
    <script>
    // Inline editing for sujet fields
    function makeEditable(div, inputId, multiline) {
        const currentValue = div.textContent.trim();
        let input;
        if (multiline) {
            input = document.createElement('textarea');
            input.rows = 3;
            input.style.resize = 'vertical';
        } else {
            input = document.createElement('input');
            input.type = 'text';
        }
        input.value = currentValue;
        input.className = div.className + ' bg-white';
        input.style.outline = 'none';
        input.onblur = saveEdit;
        input.onkeydown = function(e) {
            if (!multiline && e.key === 'Enter') {
                input.blur();
            }
        };
        div.replaceWith(input);
        input.focus();
        function saveEdit() {
            const newValue = input.value;
            document.getElementById(inputId).value = newValue;
            const newDiv = document.createElement('div');
            newDiv.className = div.className;
            newDiv.textContent = newValue;
            newDiv.setAttribute('data-field', div.getAttribute('data-field'));
            newDiv.onclick = () => makeEditable(newDiv, inputId, multiline);
            input.replaceWith(newDiv);
        }
    }
    document.querySelectorAll('.editable-field').forEach(div => {
        const field = div.getAttribute('data-field');
        const multiline = (field === 'description');
        div.onclick = () => makeEditable(div, 'input-' + field, multiline);
    });
    </script>
</body>
</html>
