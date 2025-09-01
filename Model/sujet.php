<?php
// Model for Sujets (PFE topics)
class Sujet {
    public $id;
    public $titre;
    public $description;
    public $enseignant_id;
    public $etudiant_id;
    public $statut;
    public $date_creation;

    public static function getAll(PDO $pdo) {
        $stmt = $pdo->query("SELECT s.*, u1.username as enseignant_name, u2.username as etudiant_name FROM sujets s LEFT JOIN users u1 ON s.enseignant_id=u1.id LEFT JOIN users u2 ON s.etudiant_id=u2.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(PDO $pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM sujets WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(PDO $pdo, $titre, $description, $enseignant_id, $statut = 'proposé', $etudiant_id = null) {
        $stmt = $pdo->prepare("INSERT INTO sujets (titre, description, enseignant_id, etudiant_id, statut) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$titre, $description, $enseignant_id, $etudiant_id, $statut]);
        return $pdo->lastInsertId();
    }

    public static function update(PDO $pdo, $id, $titre, $description, $statut, $etudiant_id = null) {
        $stmt = $pdo->prepare("UPDATE sujets SET titre=?, description=?, statut=?, etudiant_id=? WHERE id=?");
        $stmt->execute([$titre, $description, $statut, $etudiant_id, $id]);
    }

    public static function delete(PDO $pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM sujets WHERE id=?");
        $stmt->execute([$id]);
    }
}
