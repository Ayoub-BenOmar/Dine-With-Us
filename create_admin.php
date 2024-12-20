<?php
include "db.php";

$admin_name = "Admin Name";
$admin_email = "admin@example.com";
$admin_phone = "1234567890";
$admin_password = "2000";

$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

$check_stmt = $conn->prepare("SELECT id_user FROM users WHERE email = ?");
$check_stmt->bind_param("s", $admin_email);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO users (nom, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $admin_name, $admin_email, $admin_phone, $hashed_password);
    
    if ($stmt->execute()) {
        $admin_id = $conn->insert_id;
        
        $role_stmt = $conn->prepare("INSERT INTO roles (role, id_user) VALUES ('admin', ?)");
        $role_stmt->bind_param("i", $admin_id);
        
        if ($role_stmt->execute()) {
            echo "Admin account created successfully!";
        } else {
            echo "Error creating admin role: " . $conn->error;
        }
        $role_stmt->close();
    } else {
        echo "Error creating admin user: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Admin account already exists!";
}

$check_stmt->close();
$conn->close();
?>