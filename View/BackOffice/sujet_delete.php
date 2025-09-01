<?php
// View: Delete a Sujet (BackOffice, for admin/enseignant)
require_once __DIR__ . '/../../Model/sujet.php';
require_once __DIR__ . '/../../config.php';
$id = $_GET['id'] ?? null;
if ($id && is_numeric($id)) {
    $pdo = config::getConnexion();
    Sujet::delete($pdo, $id);
} else {
    // Optionally show error message or redirect with error
    header('Location: sujets.php?error=Invalid+sujet+ID');
    exit();
}
header('Location: sujets.php');
exit();
