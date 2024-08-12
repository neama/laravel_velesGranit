<?php

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

echo "Creating symbolic link from $target to $link\n";

if (file_exists($target)) {
    echo "Target exists.\n";
} else {
    echo "Target does not exist.\n";
}

if (symlink($target, $link)) {
    echo "The symbolic link has been created successfully.";
} else {
    echo "Failed to create the symbolic link.";
    $error = error_get_last();
    echo "Error message: " . $error['message'];
}