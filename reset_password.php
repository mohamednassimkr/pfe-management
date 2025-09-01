<?php
session_start();
require_once 'config.php';
require_once 'Controller/UserController.php';

$userController = new UserController();
$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = $_POST['email'];
        
        // Generate temporary password (using the same method as in UserController)
        $tempPassword = bin2hex(random_bytes(6));
        
        // Update user password
        $userController->resetPassword($email, $tempPassword);
        
        // For now, just display the temporary password (in production, this would be sent via email)
        $success = "Votre nouveau mot de passe temporaire est: " . $tempPassword;
        $success .= "\nVeuillez vous connecter avec ce mot de passe et le modifier immédiatement.";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe - Vitrine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .reset-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
        .reset-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .reset-header i {
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
    </style>
</head>
<body>
    <div class="container">
        <div class="reset-container">
            <div class="reset-header">
                <i class="fas fa-key"></i>
                <h2 class="mb-0">Vitrine</h2>
                <p class="text-muted">Réinitialisation du mot de passe</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email">
                </div>

                <button type="submit" class="btn btn-primary w-100">Envoyer</button>
            </form>

            <div class="text-center mt-3">
                <p><a href="login.php" class="link">Retour à la connexion</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
