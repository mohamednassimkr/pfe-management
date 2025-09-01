<?php
session_start();
require_once 'config.php';
require_once 'Controller/UserController.php';

$userController = new UserController();
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user = $userController->login($username, $password);
        
        if ($user) {
            // Verify role
            if ($user['role'] !== 'etudiant' && $user['role'] !== 'enseignant' && $user['role'] !== 'admin') {
                throw new Exception("Type de compte invalide");
            }
            
            // Start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect to appropriate page based on role
            if ($user['role'] === 'etudiant') {
                header('Location: View/FrontOffice/index.php');
            } else if ($user['role'] === 'enseignant' || $user['role'] === 'admin') {
                header('Location: View/BackOffice/index.php');
            }
            exit();
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect";
        }
    } catch (Exception $e) {
        $error = "Erreur lors de la connexion: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Scholify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            backdrop-filter: blur(10px);
        }
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .login-header i {
            font-size: 3rem;
            color: #764ba2;
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }
        .login-header h2 {
            color: #333;
            margin-bottom: 0.5rem;
        }
        .login-header p {
            color: #666;
            font-size: 0.9rem;
        }
        .form-control {
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
        }
        .btn-primary {
            background: #764ba2;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.3);
        }
        .link {
            color: #764ba2;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .link:hover {
            color: #667eea;
        }
        .alert {
            border-radius: 12px;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border: none;
        }
        .alert-danger {
            background: #ffebee;
            color: #c62828;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <img src="View/assets/images/logo.png" alt="Scholify Logo" style="height:48px; margin-bottom: 1rem;"><br><h2>Scholify</h2>
                <p>Connexion à votre compte</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>

            <div class="text-center mt-4">
                <p class="mb-2">Pas encore de compte? <a href="register.php" class="link">S'inscrire</a></p>
                <p><a href="reset_password.php" class="link">Mot de passe oublié?</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
