<?php
require_once __DIR__ . '/../Model/document.php';
require_once __DIR__ . '/../config.php';

class DocumentController {
    private $pdo;
    public function __construct() {
        $this->pdo = config::getConnexion();
    }
    public function getAllBySujet($sujet_id) {
        return Document::getAllBySujet($this->pdo, $sujet_id);
    }

    public function index($sujet_id) {
        $documents = Document::getAllBySujet($this->pdo, $sujet_id);
        include __DIR__ . '/../View/BackOffice/documents.php';
    }

    public function create($data, $files) {
        // Enhanced validation (server-side)
        if (empty($data['sujet_id']) || !is_numeric($data['sujet_id']) || intval($data['sujet_id']) <= 0) {
            throw new Exception('Sujet invalide.');
        }
        if (empty($data['etudiant_id']) || !is_numeric($data['etudiant_id']) || intval($data['etudiant_id']) <= 0) {
            throw new Exception('Étudiant invalide.');
        }
        if (empty($data['type_document']) || strlen($data['type_document']) > 100) {
            throw new Exception('Type de document invalide ou trop long.');
        }
        if (empty($files['fichier']['name'])) {
            throw new Exception('Le fichier est obligatoire.');
        }
        // File type and size validation
        $allowed_types = ['application/pdf', 'image/jpeg', 'image/png', 'text/plain'];
        $max_size = 5 * 1024 * 1024; // 5 MB
        $file_type = $files['fichier']['type'];
        $file_size = $files['fichier']['size'];
        if (!in_array($file_type, $allowed_types)) {
            throw new Exception('Type de fichier non autorisé.');
        }
        if ($file_size > $max_size) {
            throw new Exception('Le fichier dépasse la taille maximale autorisée (5MB).');
        }
        // Handle file upload
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $filename = uniqid() . '_' . basename($files['fichier']['name']);
        $targetPath = $uploadDir . $filename;
        if (!move_uploaded_file($files['fichier']['tmp_name'], $targetPath)) {
            throw new Exception('Erreur lors de l\'upload du fichier.');
        }
        Document::create($this->pdo, intval($data['sujet_id']), intval($data['etudiant_id']), 'uploads/' . $filename, $files['fichier']['name'], $data['type_document']);
    }

    public function delete($id) {
        Document::delete($this->pdo, $id);
    }
}
