<?php 
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id_user, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_user, $db_password);
        $stmt->fetch();
        // echo"$password";
        // echo"$db_password";
        if (password_verify($password, $db_password)) {
            session_start();

            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $id_user; 

            header("Location: home.php");
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "Email not found";
    }

    $stmt->close();
    $conn->close();
}
?>
