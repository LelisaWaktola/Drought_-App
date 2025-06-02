<?php
function uploadImage($file) {
    $target_dir = "../uploads/";
    $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;

    // Check file size and type
    if($file["size"] > 5000000) {
        return false;
    }
    
    if($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg") {
        return false;
    }

    if(move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    }
    return false;
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function redirectIfNotLoggedIn() {
    if(!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}
?>
