<?php
require_once '../../Controller/UserController.php';
require_once '../../config.php';

header('Content-Type: application/json');

$userController = new UserController();
$pdo = config::getConnexion();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'list':
    
        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'users' => $users]);
        break;

    case 'add':
       
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) $data = $_POST;
        try {
            $username = trim($data['username'] ?? '');
            $password = $data['password'] ?? '';
            $email = trim($data['email'] ?? '');
            $role = trim($data['role'] ?? '');

            // Validation
            $errors = [];
            if ($username === '' || strlen($username) < 3) {
                $errors[] = 'Username is required and must be at least 3 characters.';
            }
            if ($password === '' || strlen($password) < 6) {
                $errors[] = 'Password is required and must be at least 6 characters.';
            }
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'A valid email is required.';
            }
            $validRoles = ['admin', 'enseignant', 'etudiant'];
            if (!in_array($role, $validRoles)) {
                $errors[] = 'Role must be enseignant, etudiant, or admin';
            }
            if (!empty($errors)) {
                echo json_encode(['success' => false, 'error' => implode(' ', $errors)]);
                exit;
            }
            session_start();
            $currentRole = $_SESSION['role'] ?? '';
          
            if ($currentRole === 'enseignant' && $role !== 'etudiant') {
                echo json_encode(['success' => false, 'error' => 'Employe can only create etudiant accounts']);
                exit;
            }
            if ($role === 'admin') {
                if ($currentRole !== 'admin') {
                    echo json_encode(['success' => false, 'error' => 'Only admin can add or edit admin role']);
                    exit;
                }
            } else if ($role !== 'enseignant' && $role !== 'etudiant') {
                echo json_encode(['success' => false, 'error' => 'Role must be enseignant, etudiant, or admin']);
                exit;
            }
            $status = $data['status'] ?? 'active';
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$username, password_hash($password, PASSWORD_BCRYPT), $email, $role, $status]);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'edit':
     
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) $data = $_POST;
        try {
            $id = $data['id'];
            $username = trim($data['username'] ?? '');
            $email = trim($data['email'] ?? '');
            $role = trim($data['role'] ?? '');

            // Validation
            $errors = [];
            if ($username === '' || strlen($username) < 3) {
                $errors[] = 'Username is required and must be at least 3 characters.';
            }
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'A valid email is required.';
            }
            $validRoles = ['admin', 'enseignant', 'etudiant'];
            if (!in_array($role, $validRoles)) {
                $errors[] = 'Role must be enseignant, etudiant, or admin';
            }
            if (!empty($errors)) {
                echo json_encode(['success' => false, 'error' => implode(' ', $errors)]);
                exit;
            }
            session_start();
            $currentRole = $_SESSION['role'] ?? '';
           
            if ($currentRole === 'enseignant' && $role !== 'etudiant') {
                echo json_encode(['success' => false, 'error' => 'Employe can only edit etudiant accounts']);
                exit;
            }
            if ($role === 'admin') {
                if ($currentRole !== 'admin') {
                    echo json_encode(['success' => false, 'error' => 'Only admin can add or edit admin role']);
                    exit;
                }
            } else if ($role !== 'enseignant' && $role !== 'etudiant') {
                echo json_encode(['success' => false, 'error' => 'Role must be enseignant, etudiant, or admin']);
                exit;
            }
            $status = $data['status'] ?? 'active';
            $password = $data['password'] ?? '';
            if ($password) {
                $stmt = $pdo->prepare("UPDATE users SET username=?, email=?, role=?, status=?, password=? WHERE id=?");
                $stmt->execute([$username, $email, $role, $status, password_hash($password, PASSWORD_BCRYPT), $id]);
            } else {
                $stmt = $pdo->prepare("UPDATE users SET username=?, email=?, role=?, status=? WHERE id=?");
                $stmt->execute([$username, $email, $role, $status, $id]);
            }
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'delete':
      
        $id = $_POST['id'] ?? $_GET['id'] ?? null;
        if ($id && is_numeric($id)) {
            try {
                session_start();
                $currentRole = $_SESSION['role'] ?? '';
               
                $stmt = $pdo->prepare("SELECT role FROM users WHERE id=?");
                $stmt->execute([$id]);
                $userToDelete = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$userToDelete) {
                    echo json_encode(['success' => false, 'error' => 'User not found']);
                    break;
                }
                if ($currentRole === 'enseignant' && $userToDelete['role'] !== 'etudiant') {
                    echo json_encode(['success' => false, 'error' => 'Employe can only delete etudiant accounts']);
                    break;
                }
                $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
                $stmt->execute([$id]);
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing or invalid user id']);
        }
        break;

    case 'session_role':
        session_start();
        $role = $_SESSION['role'] ?? '';
        echo json_encode(['role' => $role]);
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        break;
}
