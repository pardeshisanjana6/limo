<?php
// check_image_mime.php

// Define the path to your image file
$filePath = __DIR__ . '/images/toyota2.jpg'; // This will correctly point to public/images/toyota2.jpg

echo "Checking file at: " . $filePath . "<br>";

if (file_exists($filePath)) {
    // Attempt to open fileinfo resource
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    if ($finfo) {
        // Get the MIME type
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo); // Close the fileinfo resource

        echo "File MIME Type: " . $mimeType . "<br>";
        echo "File Size: " . round(filesize($filePath) / 1024 / 1024, 2) . " MB";
    } else {
        echo "Error: finfo_open failed. Please ensure the PHP 'fileinfo' extension is enabled in your php.ini.";
    }
} else {
    echo "Error: File not found at the specified path. Double-check the filename and path.";
}
?>