<?php
// View: Choisir un sujet (pour étudiant)
require_once __DIR__ . '/../../Model/sujet.php';
require_once __DIR__ . '/../../config.php';
$pdo = config::getConnexion();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['role']) && $_SESSION['role'] === 'etudiant') {
    $sujet_id = $_POST['sujet_id'] ?? null;
    $etudiant_id = $_SESSION['user_id'] ?? null;
    if ($sujet_id && $etudiant_id) {
        // Attribution du sujet à l'étudiant
        $stmt = $pdo->prepare('UPDATE sujets SET etudiant_id = ? WHERE id = ? AND etudiant_id IS NULL');
        $stmt->execute([$etudiant_id, $sujet_id]);
    }
    header('Location: sujets.php');
    exit();
}
header('Location: sujets.php');
exit();
