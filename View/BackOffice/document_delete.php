<?php $pageTitle = 'Supprimer Document'; include __DIR__ . '/templates/header.php'; ?>
<!DOCTYPE html>
// View: Delete a Document (BackOffice)
require_once __DIR__ . '/../../Controller/DocumentController.php';
$documentController = new DocumentController();
$id = $_GET['id'] ?? null;
$sujet_id = $_GET['sujet_id'] ?? null;
if ($id && is_numeric($id)) {
    $documentController->delete($id);
} else {
    // Optionally show error message or redirect with error
    header('Location: documents.php?sujet_id=' . urlencode($sujet_id) . '&error=Invalid+document+ID');
    exit();
}
header('Location: documents.php?sujet_id=' . urlencode($sujet_id));
exit();
