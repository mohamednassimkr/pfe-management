<?php
// download.php?file=uploads/filename.txt
if (!isset($_GET['file'])) {
    http_response_code(400);
    exit('Missing file parameter.');
}
$file = str_replace(['..', '\\', '\\'], '', $_GET['file']);
$baseDir = realpath(__DIR__ . '/uploads');
$target = $baseDir . DIRECTORY_SEPARATOR . basename($file);
if (!file_exists($target)) {
    http_response_code(404);
    echo '<pre>File not found.<br>baseDir: ' . htmlspecialchars($baseDir) . '<br>target: ' . htmlspecialchars($target) . '<br>file param: ' . htmlspecialchars($file) . '</pre>';
    exit;
}
// Force download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($target) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($target));
readfile($target);
exit;
