<?php
// download.php
$path = '/pdf/';
$fileName = $_GET['Files'];
$filePath = $path . $fileName;

// verify that the file exists
if (file_exists($filePath) ) {
    // force the download
    header("Content-Disposition: attachment; filename=\"" .     basename($fileName) . "\"");
    header("Content-Length: " . filesize($filePath));
    header("Content-Type: application/octet-stream;");
    readfile($filePath);
}
?>