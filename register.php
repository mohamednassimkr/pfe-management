<?php
session_start();
require_once 'config.php';
require_once 'Controller/UserController.php';

$userController = new UserController();
$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    if ($_POST['password'] !== $_POST['confirm-password']) {
        $error = "Les mots de passe ne correspondent pas";
    } else {
        try {
            if ($userController->register(
                $_POST['username'],
                $_POST['password'],
                $_POST['email'],
                $_POST['role'],
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['telephone'],
                $_POST['adresse'] ?? null,
                $_POST['poste'] ?? null
            )) {
                $success = "Inscription réussie! Vous pouvez maintenant vous connecter.";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Vitrine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .register-header i {
            font-size: 2.5rem;
            color: #764ba2;
            margin-bottom: 1rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.8rem;
        }
        .btn-primary {
            background: #764ba2;
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background: #667eea;
        }
        .link {
            color: #764ba2;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .role-selector {
            margin-bottom: 1.5rem;
        }
        .role-selector select {
            padding: 0.8rem;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .form-group {
            flex: 1;
        }
        .form-group label {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <i class="fas fa-store-alt"></i>
                <h2 class="mb-0">Scholify</h2>
                <p class="text-muted">Inscription</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <div id="custom-error-message" style="display:none;" class="alert alert-danger"></div>
            <form method="POST" action="" id="registerForm">
                <div class="role-selector">
                    <label for="role">Type de compte:</label>
                    <select name="role" id="role">
                        <option value="etudiants">Etudiant</option>
                        <option value="enseignants">Enseignant</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <div class="custom-input-group"><input type="text" id="username" name="username"></div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
<div class="d-flex align-items-center" style="display: flex; align-items: center; gap: 2px;">
    <div class="custom-input-group" style="display: flex; align-items: center; gap: 2px;"><input type="text" id="emailLocal" style="width: 50%;" placeholder="nom.prenom"><span style="margin: 0 4px; font-weight: bold;">@</span><span style="font-weight: bold;">exemple</span><span style="margin: 0 4px; font-weight: bold;">.com</span><input type="hidden" id="email" name="email"></div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateHiddenEmail() {
        let local = document.getElementById('emailLocal').value.trim().replace(/@.*/, '').replace(/\.com$/, '');
        document.getElementById('email').value = local ? local + '@exemple.com' : '';
    }
    document.getElementById('emailLocal').addEventListener('input', updateHiddenEmail);
    updateHiddenEmail();
});
</script>
                </div>

                <div class="form-row">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <div class="custom-input-group"><input type="text" id="nom" name="nom"></div>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <div class="custom-input-group"><input type="text" id="prenom" name="prenom"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <div class="custom-input-group"><input type="text" id="telephone" name="telephone"></div>
                </div>

                <div id="client-fields" style="display: none;">
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <div class="custom-input-group"><input type="text" id="adresse" name="adresse"></div>
                    </div>
                </div>

                <div id="employe-fields" style="display: none;">
                    <div class="mb-3">
                        <label for="poste" class="form-label">Poste</label>
                        <div class="custom-input-group"><input type="text" id="poste" name="poste"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="custom-input-group"><input type="password" id="password" name="password"></div>
                </div>

                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirmer le mot de passe</label>
                    <div class="custom-input-group"><input type="password" id="confirm-password" name="confirm-password"></div>
                </div>

                <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
            </form>

            <div class="text-center mt-3">
                <p>Vous avez déjà un compte? <a href="login.php" class="link">Se connecter</a></p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
    const clientFields = document.getElementById('client-fields'); // now for etudiants
    const employeFields = document.getElementById('employe-fields'); // now for enseignants
    if (this.value === 'etudiants') {
        clientFields.style.display = 'block';
        employeFields.style.display = 'none';
    } else if (this.value === 'enseignants') {
        clientFields.style.display = 'none';
        employeFields.style.display = 'block';
    } else {
        clientFields.style.display = 'none';
        employeFields.style.display = 'none';
    }
});
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            var role = document.getElementById('role').value;
            var requiredFields = [
                'username', 'emailLocal', 'nom', 'prenom', 'telephone',
                (role === 'etudiants' ? 'adresse' : null),
                (role === 'enseignants' ? 'poste' : null),
                'password', 'confirm-password'
            ].filter(Boolean);
            var missing = [];
            requiredFields.forEach(function(id) {
                var el = document.getElementById(id);
                if (el && el.offsetParent === null) return; 
                if (!el || !el.value.trim()) missing.push(id);
            });
            if (missing.length > 0) {
                e.preventDefault();
                var msg = document.getElementById('custom-error-message');
                msg.style.display = 'block';
                msg.textContent = 'Tous les champs sont obligatoires.';
                if (document.getElementById(missing[0])) document.getElementById(missing[0]).focus();
                return;
            }

            var telephone = document.getElementById('telephone').value;
            if (!/^\d{1,8}$/.test(telephone)) {
                e.preventDefault();
                var msg = document.getElementById('custom-error-message');
                msg.style.display = 'block';
                msg.textContent = 'Le numéro de téléphone doit contenir uniquement des chiffres et au maximum 8 chiffres.';
                document.getElementById('telephone').focus();
                return;
            }

            var password = document.getElementById('password').value;
            var passwordError = '';
            if (!(/[A-Z]/.test(password))) {
                passwordError = 'Le mot de passe doit contenir au moins une majuscule.';
            } else if (!(/[0-9]/.test(password))) {
                passwordError = 'Le mot de passe doit contenir au moins un chiffre.';
            } else if (!(/[!@#$%^&*(),.?":{}|<>\[\]\\/;'_+=~-]/.test(password))) {
                passwordError = 'Le mot de passe doit contenir au moins un caractère spécial.';
            }
            if (passwordError) {
                e.preventDefault();
                var msg = document.getElementById('custom-error-message');
                msg.style.display = 'block';
                msg.textContent = passwordError;
                document.getElementById('password').focus();
                return;
            } else {
                var msg = document.getElementById('custom-error-message');
                msg.style.display = 'none';
            }
        });

        var telInput = document.getElementById('telephone');
        telInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^\d]/g, '').slice(0,8);
        });
    });
    </script>
</body>
</html>
