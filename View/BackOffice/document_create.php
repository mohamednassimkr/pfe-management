<?php
require_once __DIR__ . '/../../Controller/DocumentController.php';
require_once __DIR__ . '/../../config.php';
$pdo = config::getConnexion();
require_once __DIR__ . '/../../Model/sujet.php';
$documentController = new DocumentController();
$error = null;
$sujets = Sujet::getAll($pdo);
$etudiants = $pdo->query("SELECT id, username FROM users WHERE role='etudiant'")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $documentController->create($_POST, $_FILES);
        header('Location: documents.php?sujet_id=' . $_POST['sujet_id']);
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<?php session_start(); $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown'; $role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Unknown'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Document</title>
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
   
        .custom-dropdown { position: relative; }
        .dropdown-list {
            position: absolute;
            left: 0;
            right: 0;
            top: 110%;
            z-index: 50;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 0.25rem 0;
            margin-top: 0.25rem;
            min-width: 100%;
        }
        .dropdown-list li {
            padding: 0.5rem 1rem;
            cursor: pointer;
            color: #1e293b;
            transition: background 0.2s, color 0.2s;
        }
        .dropdown-list li:hover, .dropdown-list li.active {
            background: #e0e7ff;
            color: #3b82f6;
        }
    </style>
</head>
<body class="bg-gray-50 font-['Inter']">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1>Admin Panel</h1>
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
    <main class="main-content">
        <header class="main-header flex flex-row justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Ajouter un Document</h1>
            <div class="flex items-center gap-3">
                <span class="font-semibold text-blue-900 text-base"><?php echo $username; ?></span>
                <?php
$roleColors = [
    'admin' => 'text-red-600 bg-red-50 border-red-200',
    'etudiant' => 'text-blue-500 bg-blue-50 border-blue-200',
    'enseignant' => 'text-green-600 bg-green-50 border-green-200',
];
$roleLabel = isset($role) ? ucfirst($role) : 'Role';
$roleClass = isset($roleColors[$role]) ? $roleColors[$role] : 'text-gray-600 bg-gray-100 border-gray-300';
?>
<span class="text-xs rounded px-2 py-0.5 border font-semibold <?php echo $roleClass; ?>"><?php echo $roleLabel; ?></span>
            </div>
        </header>
        <?php if ($error): ?><div class="mb-4 p-3 bg-red-100 text-red-700 rounded"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <div class="bg-white rounded-lg shadow p-6 max-w-xl mx-auto">
            <form method="post" enctype="multipart/form-data" class="space-y-4">
                <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Sujet</label>
    <div class="custom-dropdown" data-dropdown="sujet">
    <div class="dropdown-selected flex items-center justify-between px-3 py-2 rounded border border-gray-400 bg-white shadow-sm cursor-pointer hover:bg-blue-50 focus:bg-blue-100 transition"><span>-- Choisir --</span><svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg></div>
    <ul class="dropdown-list hidden">
        <?php foreach ($sujets as $sujet): ?>
            <li data-value="<?= $sujet['id'] ?>">#<?= $sujet['id'] ?> - <?= htmlspecialchars($sujet['titre']) ?></li>
        <?php endforeach; ?>
    </ul>
    <input type="hidden" name="sujet_id" id="input-sujet_id" value="">
</div>
</div>
                <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Etudiant</label>
    <div class="custom-dropdown" data-dropdown="etudiant">
    <div class="dropdown-selected flex items-center justify-between px-3 py-2 rounded border border-gray-400 bg-white shadow-sm cursor-pointer hover:bg-blue-50 focus:bg-blue-100 transition"><span>-- Choisir --</span><svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg></div>
    <ul class="dropdown-list hidden">
        <?php foreach ($etudiants as $etu): ?>
            <li data-value="<?= $etu['id'] ?>"><?= htmlspecialchars($etu['username']) ?></li>
        <?php endforeach; ?>
    </ul>
    <input type="hidden" name="etudiant_id" id="input-etudiant_id" value="">
</div>
                <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Type de document</label>
    <div class="custom-dropdown" data-dropdown="type_document">
    <div class="dropdown-selected flex items-center justify-between px-3 py-2 rounded border border-gray-400 bg-white shadow-sm cursor-pointer hover:bg-blue-50 focus:bg-blue-100 transition">
    <span>Rapport</span>
    <svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
</div>
    <ul class="dropdown-list hidden">
        <li data-value="rapport">Rapport</li>
        <li data-value="code">Code</li>
        <li data-value="autre">Autre</li>
    </ul>
    <input type="hidden" name="type_document" value="rapport">
</div>
    <input type="hidden" name="type_document" id="input-type_document" value="rapport">
</div>
                <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Fichier</label>
    <div class="relative flex items-center gap-2">
    <div class="file-label flex-1 px-3 py-2 rounded border border-gray-300 bg-gray-50 text-gray-700 truncate">Aucun fichier choisi</div>
    <button type="button" class="btn bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 file-custom-btn">Choisir</button>
    <input type="file" name="fichier" class="file-hidden" style="display:none;">
</div>
<div id="file-modal" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded p-6 shadow-lg">
        <div class="text-lg font-semibold mb-4">Fichier sélectionné :</div>
        <div class="file-modal-name mb-4"></div>
        <button type="button" class="btn bg-blue-600 text-white px-4 py-2 rounded close-file-modal">OK</button>
    </div>
</div>
</div>
                <div class="flex justify-between">
                    <button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Ajouter</button>
                    <a href="documents.php?sujet_id=<?= isset($sujet_id) ? htmlspecialchars($sujet_id) : '' ?>" class="btn btn-secondary bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">Retour</a>
                </div>
            <script>

const dropdowns = document.querySelectorAll('.custom-dropdown');
document.body.addEventListener('click', function(e) {
    
    if (e.target.classList.contains('dropdown-selected')) {
        document.querySelectorAll('.dropdown-list').forEach(list => list.classList.add('hidden'));
        const parent = e.target.closest('.custom-dropdown');
        parent.querySelector('.dropdown-list').classList.toggle('hidden');
    } else if (e.target.closest('.dropdown-list')) {
  
        const option = e.target;
        if (option.tagName === 'LI') {
            const parent = option.closest('.custom-dropdown');
            parent.querySelector('.dropdown-selected').textContent = option.textContent;
        
            if (parent.getAttribute('data-dropdown') === 'sujet') {
                document.getElementById('input-sujet_id').value = option.getAttribute('data-value');
            } else if (parent.getAttribute('data-dropdown') === 'etudiant') {
                document.getElementById('input-etudiant_id').value = option.getAttribute('data-value');
            } else {
                parent.querySelector('input[type=hidden]').value = option.getAttribute('data-value');
            }
            parent.querySelector('.dropdown-list').classList.add('hidden');
        }
    } else {
      
        document.querySelectorAll('.dropdown-list').forEach(list => list.classList.add('hidden'));
    }
});

const fileContainers = document.querySelectorAll('.file-label');
document.querySelectorAll('.file-custom-btn').forEach((btn, idx) => {
    btn.addEventListener('click', function() {
        const fileInput = btn.parentElement.querySelector('.file-hidden');
        fileInput.click();
    });
});
document.querySelectorAll('.file-hidden').forEach((input, idx) => {
    input.addEventListener('change', function() {
        const fileName = input.files.length ? input.files[0].name : 'Aucun fichier choisi';
        input.parentElement.querySelector('.file-label').textContent = fileName;
        const modal = document.getElementById('file-modal');
        modal.querySelector('.file-modal-name').textContent = fileName;
        modal.classList.remove('hidden');
    });
});
document.querySelectorAll('.close-file-modal').forEach(btn => {
    btn.addEventListener('click', function() {
        btn.closest('#file-modal').classList.add('hidden');
    });
});
</script>
</form>
        </div>
    </main>
</body>
</html>
