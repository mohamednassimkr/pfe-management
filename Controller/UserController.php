<?php
require_once __DIR__ . '/../Model/user.php';
require_once __DIR__ . '/../config.php';

class UserController
{
    public function login($username, $password)
    {
        try {
            $stmt = config::getConnexion()->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la connexion: " . $e->getMessage());
        }
    }

    public function register($username, $password, $email, $role, $nom, $prenom, $telephone = null, $adresse = null, $poste = null)
    {
        try {
            // Check if username or email already exists
            $stmt = config::getConnexion()->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                throw new Exception("Nom d'utilisateur ou email déjà utilisé");
            }

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user
            $stmt = config::getConnexion()->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $hashedPassword, $email, $role]);
            $userId = config::getConnexion()->lastInsertId();

            // Insert specific information based on role
            if ($role === 'etudiant') {
                $stmt = config::getConnexion()->prepare("INSERT INTO etudiants (user_id, nom, prenom, telephone, adresse) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$userId, $nom, $prenom, $telephone, $adresse]);
            } else if ($role === 'enseignant') {
                $stmt = config::getConnexion()->prepare("INSERT INTO enseignants (user_id, nom, prenom, poste) VALUES (?, ?, ?, ?)");
                $stmt->execute([$userId, $nom, $prenom, $poste]);
            }

            return true;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'inscription: " . $e->getMessage());
        }
    }

    public function getUserInfo($userId, $role)
    {
        try {
            if ($role === 'etudiant') {
                $stmt = config::getConnexion()->prepare("SELECT * FROM etudiants WHERE user_id = ?");
            } else if ($role === 'enseignant') {
                $stmt = config::getConnexion()->prepare("SELECT * FROM enseignants WHERE user_id = ?");
            }
            $stmt->execute([$userId]);
            return $stmt->fetch();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des informations: " . $e->getMessage());
        }
    }

    public function resetPassword($email, $tempPassword)
    {
        try {
            $stmt = config::getConnexion()->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if (!$user) {
                throw new Exception("Email non trouvé");
            }

            // Hash the provided temporary password
            $hashedTempPassword = password_hash($tempPassword, PASSWORD_BCRYPT);

            // Update password
            $stmt = config::getConnexion()->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashedTempPassword, $user['id']]);

            return true;
        } catch (Exception $e) {
            throw new Exception("Erreur lors du réinitialisation du mot de passe: " . $e->getMessage());
        }
    }
}
