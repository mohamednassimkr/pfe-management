<?php
session_start();
require_once 'config.php';
$conn = config::getConnexion();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();


$extra = [];
if ($user['role'] === 'etudiant') {
    $extra_query = "SELECT * FROM etudiants WHERE user_id = ?";
    $stmt = $conn->prepare($extra_query);
    $stmt->execute([$user_id]);
    $extra = $stmt->fetch();
} elseif ($user['role'] === 'enseignant') {
    $extra_query = "SELECT * FROM enseignants WHERE user_id = ?";
    $stmt = $conn->prepare($extra_query);
    $stmt->execute([$user_id]);
    $extra = $stmt->fetch();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $errors = [];

 
    if ($username === '' || strlen($username) < 3) {
        $errors[] = 'Username is required and must be at least 3 characters.';
    }
  
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }

   
    if ($user['role'] === 'etudiant') {
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $adresse = trim($_POST['adresse'] ?? '');
        if ($nom === '' || strlen($nom) < 2) {
            $errors[] = 'Nom is required and must be at least 2 characters.';
        }
        if ($prenom === '' || strlen($prenom) < 2) {
            $errors[] = 'Prénom is required and must be at least 2 characters.';
        }
        if ($telephone !== '' && !preg_match('/^[0-9\-\s\+]{6,20}$/', $telephone)) {
            $errors[] = 'Téléphone must be a valid phone number.';
        }

        if ($adresse !== '' && strlen($adresse) > 255) {
            $errors[] = 'Adresse is too long (max 255 characters).';
        }
    } elseif ($user['role'] === 'enseignant') {
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $poste = trim($_POST['poste'] ?? '');
        if ($nom === '' || strlen($nom) < 2) {
            $errors[] = 'Nom is required and must be at least 2 characters.';
        }
        if ($prenom === '' || strlen($prenom) < 2) {
            $errors[] = 'Prénom is required and must be at least 2 characters.';
        }
        if ($poste !== '' && strlen($poste) > 100) {
            $errors[] = 'Poste is too long (max 100 characters).';
        }
    }

    if (!empty($errors)) {
        $error_message = implode('<br>', $errors);
    } else {

        $update_query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->execute([$username, $email, $user_id]);


        if ($user['role'] === 'etudiant') {
            $update_etudiant = "UPDATE etudiants SET nom = ?, prenom = ?, telephone = ?, adresse = ? WHERE user_id = ?";
            $stmt = $conn->prepare($update_etudiant);
            $stmt->execute([$nom, $prenom, $telephone, $adresse, $user_id]);
        } elseif ($user['role'] === 'enseignant') {
            $update_enseignant = "UPDATE enseignants SET nom = ?, prenom = ?, poste = ? WHERE user_id = ?";
            $stmt = $conn->prepare($update_enseignant);
            $stmt->execute([$nom, $prenom, $poste, $user_id]);
        }
        $_SESSION['success_message'] = "Profile updated successfully!";
        header('Location: profile.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Vitrine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: '#97c3a2',
              'primary-dark': '#86b391',
            }
          }
        }
      }
    </script>
</head>
<body class="bg-gray-100">
<?php if (basename($_SERVER['PHP_SELF']) !== 'profile.php'): ?>
    <?php include 'View/FrontOffice/templates/header.php'; ?>
<?php endif; ?>
<div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>
            
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php 
                    echo $_SESSION['success_message'];
                    unset($_SESSION['success_message']);
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" id="profile-form" class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Username</label>
        <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="username">
            <?php echo isset($user['username']) ? htmlspecialchars($user['username']) : ''; ?>
        </div>
        <input type="hidden" name="username" id="input-username" value="<?php echo isset($user['username']) ? htmlspecialchars($user['username']) : ''; ?>">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="email">
            <?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>
        </div>
        <input type="hidden" name="email" id="input-email" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>">
    </div>
                <?php if ($user['role'] === 'etudiant'): ?>
    <div>
        <label class="block text-sm font-medium text-gray-700">Nom</label>
        <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="nom">
            <?php echo isset($extra['nom']) ? htmlspecialchars($extra['nom']) : ''; ?>
        </div>
        <input type="hidden" name="nom" id="input-nom" value="<?php echo isset($extra['nom']) ? htmlspecialchars($extra['nom']) : ''; ?>">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Prénom</label>
        <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="prenom">
            <?php echo isset($extra['prenom']) ? htmlspecialchars($extra['prenom']) : ''; ?>
        </div>
        <input type="hidden" name="prenom" id="input-prenom" value="<?php echo isset($extra['prenom']) ? htmlspecialchars($extra['prenom']) : ''; ?>">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Téléphone</label>
        <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="telephone">
            <?php echo isset($extra['telephone']) ? htmlspecialchars($extra['telephone']) : ''; ?>
        </div>
        <input type="hidden" name="telephone" id="input-telephone" value="<?php echo isset($extra['telephone']) ? htmlspecialchars($extra['telephone']) : ''; ?>">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Adresse</label>
        <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="adresse">
            <?php echo isset($extra['adresse']) ? htmlspecialchars($extra['adresse']) : ''; ?>
        </div>
        <input type="hidden" name="adresse" id="input-adresse" value="<?php echo isset($extra['adresse']) ? htmlspecialchars($extra['adresse']) : ''; ?>">
    </div>
<?php elseif ($user['role'] === 'enseignant'): ?>
                <div>
    <label class="block text-sm font-medium text-gray-700">Nom</label>
    <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="nom">
        <?php echo isset($extra['nom']) ? htmlspecialchars($extra['nom']) : ''; ?>
    </div>
    <input type="hidden" name="nom" id="input-nom" value="<?php echo isset($extra['nom']) ? htmlspecialchars($extra['nom']) : ''; ?>">
</div>
<div>
    <label class="block text-sm font-medium text-gray-700">Prénom</label>
    <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="prenom">
        <?php echo isset($extra['prenom']) ? htmlspecialchars($extra['prenom']) : ''; ?>
    </div>
    <input type="hidden" name="prenom" id="input-prenom" value="<?php echo isset($extra['prenom']) ? htmlspecialchars($extra['prenom']) : ''; ?>">
</div>
<div>
    <label class="block text-sm font-medium text-gray-700">Poste</label>
    <div class="editable-field mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 shadow-sm cursor-pointer hover:bg-gray-100" data-field="poste">
        <?php echo isset($extra['poste']) ? htmlspecialchars($extra['poste']) : ''; ?>
    </div>
    <input type="hidden" name="poste" id="input-poste" value="<?php echo isset($extra['poste']) ? htmlspecialchars($extra['poste']) : ''; ?>">
</div>
<?php endif; ?>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Update Profile
                </button>
            </form>
        <div class="mt-4 flex justify-center">
            <button onclick="window.history.back();" type="button" class="inline-block px-6 py-2 text-white bg-primary hover:bg-primary-dark rounded shadow font-medium transition-colors duration-150">Back</button>
        </div>
        </div>
    </div>
<script>

function makeEditable(div, inputId) {
    const currentValue = div.textContent.trim();
    const input = document.createElement('input');
    input.type = 'text';
    input.value = currentValue;
    input.className = div.className + ' bg-white';
    input.style.outline = 'none';
    input.onblur = saveEdit;
    input.onkeydown = function(e) {
        if (e.key === 'Enter') {
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
        newDiv.onclick = () => makeEditable(newDiv, inputId);
        input.replaceWith(newDiv);
    }
}
document.querySelectorAll('.editable-field').forEach(div => {
    const field = div.getAttribute('data-field');
    div.onclick = () => makeEditable(div, 'input-' + field);
});
</script>
</body>
</html>
