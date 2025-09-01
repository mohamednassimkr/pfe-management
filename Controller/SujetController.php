<?php
require_once __DIR__ . '/../Model/sujet.php';
require_once __DIR__ . '/../config.php';

class SujetController {
    private $pdo;
    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function index() {
        $sujets = Sujet::getAll($this->pdo);
        include __DIR__ . '/../View/BackOffice/sujets.php';
    }

    public function create($data) {
        // Enhanced validation (server-side)
        if (empty($data['titre']) || strlen($data['titre']) < 3) {
            throw new Exception('Le titre est obligatoire et doit comporter au moins 3 caractères.');
        }
        if (!isset($data['enseignant_id']) || !is_numeric($data['enseignant_id']) || intval($data['enseignant_id']) <= 0) {
            throw new Exception('Enseignant invalide.');
        }
        if (!empty($data['description']) && strlen($data['description']) > 1000) {
            throw new Exception('La description est trop longue (max 1000 caractères).');
        }
        $allowed_statuts = ['proposé', 'validé', 'refusé', 'attribué'];
        $statut = $data['statut'] ?? 'proposé';
        if (!in_array($statut, $allowed_statuts)) {
            throw new Exception('Statut invalide.');
        }
        $etudiant_id = isset($data['etudiant_id']) ? $data['etudiant_id'] : null;
        if ($etudiant_id !== null && (!is_numeric($etudiant_id) || intval($etudiant_id) <= 0)) {
            throw new Exception('Étudiant invalide.');
        }
        Sujet::create($this->pdo, $data['titre'], $data['description'], intval($data['enseignant_id']), $statut, $etudiant_id);
    }

    public function update($id, $data) {
        // Enhanced validation (server-side)
        if (empty($data['titre']) || strlen($data['titre']) < 3) {
            throw new Exception('Le titre est obligatoire et doit comporter au moins 3 caractères.');
        }
        if (!empty($data['description']) && strlen($data['description']) > 1000) {
            throw new Exception('La description est trop longue (max 1000 caractères).');
        }
        $allowed_statuts = ['proposé', 'validé', 'refusé', 'attribué'];
        $statut = $data['statut'] ?? 'proposé';
        if (!in_array($statut, $allowed_statuts)) {
            throw new Exception('Statut invalide.');
        }
        $etudiant_id = isset($data['etudiant_id']) ? $data['etudiant_id'] : null;
        if ($etudiant_id !== null && (!is_numeric($etudiant_id) || intval($etudiant_id) <= 0)) {
            throw new Exception('Étudiant invalide.');
        }
        Sujet::update($this->pdo, $id, $data['titre'], $data['description'], $statut, $etudiant_id);
    }

    public function delete($id) {
        Sujet::delete($this->pdo, $id);
    }

    public function show($id) {
        $sujet = Sujet::getById($this->pdo, $id);
        include __DIR__ . '/../View/BackOffice/sujet_detail.php';
    }
}
