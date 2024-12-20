<?php 
include "db.php";

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

     // basic validation
    if (empty($username) || empty($password) || empty($email) || empty($phone)) {
        echo "All fields are required";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // email check 
    $checkEmail = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

     // phone check
     $checkPhone = $conn->prepare("SELECT phone FROM users WHERE phone = ?");
     $checkPhone->bind_param("s", $phone);
     $checkPhone->execute();
     $checkPhone->store_result();

    if ($checkPhone->num_rows > 0) {
        echo "Phone number already exists";
        exit;
    }

    if ($checkEmail->num_rows > 0) {
        echo"Email already exists";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (nom, password, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $hashedPassword, $email, $phone);

    if ($stmt->execute()) {
            echo "Account created successfully!";
            
    } else {
            echo "ERROR";
    }

    $stmt->close();
    $checkEmail->close();
    $checkPhone->close();
    $conn->close();
}
?>