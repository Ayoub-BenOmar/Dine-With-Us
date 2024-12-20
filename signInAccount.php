<?php 
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("
        SELECT u.id_user, u.password, r.role 
        FROM users u 
        LEFT JOIN roles r ON u.id_user = r.id_user 
        WHERE u.email = ?
    ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_user, $db_password, $role);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            session_start();

            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $id_user;
            $_SESSION['role'] = $role;

            if ($role === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: home.php");
            }
            exit();
        } else {
            echo"Incorrect password";
        }
    } else {
        echo"Email not found";
    }

    if (isset($error)) {
        echo $error;
    }

    $stmt->close();
    $conn->close();
}
?>