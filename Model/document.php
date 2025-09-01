<?php
// Model for Documents (PFE project deliverables)
class Document {
    public $id;
    public $sujet_id;
    public $etudiant_id;
    public $chemin_fichier;
    public $nom_fichier;
    public $date_soumission;
    public $type_document;

    public static function getAllBySujet(PDO $pdo, $sujet_id) {
        $stmt = $pdo->prepare("SELECT d.*, u.username as etudiant_name FROM documents d LEFT JOIN users u ON d.etudiant_id=u.id WHERE d.sujet_id=?");
        $stmt->execute([$sujet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(PDO $pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM documents WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(PDO $pdo, $sujet_id, $etudiant_id, $chemin_fichier, $nom_fichier, $type_document) {
        $stmt = $pdo->prepare("INSERT INTO documents (sujet_id, etudiant_id, chemin_fichier, nom_fichier, type_document) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$sujet_id, $etudiant_id, $chemin_fichier, $nom_fichier, $type_document]);
        return $pdo->lastInsertId();
    }

    public static function delete(PDO $pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM documents WHERE id=?");
        $stmt->execute([$id]);
    }
}
