<!-- // config/database.php -->
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // Change as needed
define('DB_PASS', '');      // Change as needed
define('DB_NAME', 'reservation_restau');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create initial admin account if it doesn't exist
$admin_name = "admin";
$admin_email = "admin@restaurant.com";
$admin_phone = 123456789;
$admin_password = password_hash("admin123", PASSWORD_DEFAULT); // Change this password

// Start transaction
$conn->begin_transaction();

try {
    // Check if admin exists
    $stmt = $conn->prepare("SELECT id_user FROM users WHERE email = ?");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert admin user
        $stmt = $conn->prepare("INSERT INTO users (nom, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $admin_name, $admin_email, $admin_phone, $admin_password);
        $stmt->execute();
        $admin_id = $conn->insert_id;

        // Insert admin role
        $stmt = $conn->prepare("INSERT INTO roles (id_user, role) VALUES (?, 'admin')");
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
    }

    // Commit transaction
    $conn->commit();
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    error_log("Error creating admin account: " . $e->getMessage());
}

$stmt->close();
?>

<!-- // login.php -->
<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("
            SELECT u.id_user, u.nom, u.email, u.password, r.role 
            FROM users u 
            LEFT JOIN roles r ON u.id_user = r.id_user 
            WHERE u.email = ?
        ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['role'] = $user['role'] ?? 'client'; // Default to client if no role
                
                // Redirect based on role
                if ($user['role'] == 'admin') {
                    header("Location: dashboard.php");
                } else {
                    header("Location: home.php");
                }
                exit;
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "Invalid email";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-0 m-0 h-[100vh]">
    <nav class="bg-gray-900 text-white py-4 px-24">
        <div class="container flex justify-between items-center">
            <a href="#" class="navbar-brand">
                <img src="imgs/navbar-brand.svg" alt="Restaurant Logo" class="h-[70px]">
            </a>
            <div class="flex items-center">
                <a href="#" class="text-orange-700">CALL US : <span class="text-gray-400 pl-2 text-sm">(123) 456 7890</span></a>
            </div>
        </div>
    </nav>

    <section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('imgs/section.jpg');">
        <div class="absolute inset-0 brightness-50" style="background-image: url('imgs/section.jpg'); background-size: cover; background-position: center;"></div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <div class="bg-gray-900 relative rounded-lg shadow p-8">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-white">
                    Login
                </h3>
            </div>
            
            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form class="p-4 md:p-5" method="POST" action="">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-white">
                            Email
                        </label>
                        <input type="email" name="email" id="email" 
                               class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full py-2.5 px-24" required>
                    </div>
                    
                    <div class="col-span-2">
                        <label for="password" class="block mb-2 text-sm font-medium text-white">
                            Password
                        </label>
                        <input type="password" name="password" id="password" 
                               class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full py-2.5 px-24" required>
                    </div>
                </div>
                
                <button type="submit" 
                        class="text-gray-900 inline-flex items-center bg-white hover:bg-gray-500 hover:text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Login
                </button>
            </form>
            
            <div class="text-md font-semibold text-white">
                Don't have an account? <a href="register.php" class="text-orange-700 hover:text-orange-500">Sign up!</a>
            </div>
        </div>
    </section>
</body>
</html>

<!-- // register.php -->
<?php
session_start();
require_once 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    
    // Validate input
    if (strlen($nom) < 3) {
        $error = "Name must be at least 3 characters long";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    } elseif (!is_numeric($phone) || strlen($phone) < 9 || strlen($phone) > 14) {
        $error = "Invalid phone number format";
    } else {
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // Check if email or phone exists
            $stmt = $conn->prepare("SELECT id_user FROM users WHERE email = ? OR phone = ?");
            $stmt->bind_param("si", $email, $phone);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $error = "Email or phone number already exists";
                $conn->rollback();
            } else {
                // Insert new user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (nom, email, phone, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssis", $nom, $email, $phone, $hashed_password);
                $stmt->execute();
                $user_id = $conn->insert_id;

                // Insert client role
                $stmt = $conn->prepare("INSERT INTO roles (id_user, role) VALUES (?, 'client')");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();

                $conn->commit();
                $success = "Registration successful! You can now login.";
            }
        } catch (Exception $e) {
            $conn->rollback();
            $error = "Registration failed. Please try again.";
            error_log("Registration error: " . $e->getMessage());
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-0 m-0 h-[100vh]">
    <nav class="bg-gray-900 text-white py-4 px-24">
        <div class="container flex justify-between items-center">
            <a href="#" class="navbar-brand">
                <img src="imgs/navbar-brand.svg" alt="Restaurant Logo" class="h-[70px]">
            </a>
            <div class="flex items-center">
                <a href="#" class="text-orange-700">CALL US : <span class="text-gray-400 pl-2 text-sm">(123) 456 7890</span></a>
            </div>
        </div>
    </nav>

    <section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('imgs/section.jpg');">
        <div class="absolute inset-0 brightness-50" style="background-image: url('imgs/section.jpg'); background-size: cover; background-position: center;"></div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <div class="bg-gray-900 relative rounded-lg shadow p-8">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-white">
                    Sign Up
                </h3>
            </div>
            
            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form class="p-4 md:p-5" method="POST" action="">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nom" class="block mb-2 text-sm font-medium text-white">
                            Name
                        </label>
                        <input type="text" name="nom" id="nom" 
                               class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full py-2.5 px-24" required>
                    </div>
                    
                    <div class="col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-white">
                            Email
                        </label>
                        <input type="email" name="email" id="email" 
                               class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full py-2.5 px-24" required>
                    </div>
                    
                    <div class="col-span-2">
                        <label for="phone" class="block mb-2 text-sm font-medium text-white">
                            Phone
                        </label>
                        <input type="number" name="phone" id="phone" 
                               class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full py-2.5 px-24" required>
                    </div>
                    
                    <div class="col-span-2">
                        <label for="password" class="block mb-2 text-sm font-medium text-white">
                            Password
                        </label>
                        <input type="password" name="password" id="password" 
                               class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full py-2.5 px-24" required>
                    </div>
                </div>
                
                <button type="submit" 
                        class="text-gray-900 inline-flex items-center bg-white hover:bg-gray-500 hover:text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Sign Up
                </button>
            </form>
            
            <div class="text-md font-semibold text-white">
                Already have an account? <a href="login.php" class="text-orange-700 hover:text-orange-500">Sign in!</a>
            </div>
        </div>
    </section>
</body>
</html>