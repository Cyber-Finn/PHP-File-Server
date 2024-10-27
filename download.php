<?php
$dir = './Files';

// Function to list files in the directory
function listFiles($dir) {
    $files = array_diff(scandir($dir), array('.', '..'));
    return $files;
}

// Check if a file is requested for download
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']); // Decode URL-encoded string
    $filepath = $dir . '/' . $file;

    // Check if the file exists
    if (file_exists($filepath)) {
        // Set headers to initiate file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    } else {
        http_response_code(404);
        echo "File not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Download</title>
</head>
<body>
    <h1>Download Files</h1>
    <ul>
        <?php
        $files = listFiles($dir);
        foreach ($files as $file) {
            echo '<li><a href="?file=' . urlencode($file) . '">' . htmlspecialchars($file) . '</a></li>';
        }
        ?>
    </ul>
</body>
</html>
