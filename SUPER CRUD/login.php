<?php
require 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

$connectionMessage = "";
$registrationMessage = "";

try {
    $pdo = new PDO($dsn, $user, $password);

    if ($pdo) {
        $connectionMessage = "Connected to the $db database successfully!";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['login'])) {
                // Login form submitted
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Validate login credentials
                $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $userRow = $stmt->fetch();

                if ($userRow) {
                    // Check if password matches the stored hash
                    if (password_verify($password, $userRow['password'])) {
                        // Successful login
                        $connectionMessage = "Login successful!";
                    } else {
                        $connectionMessage = "Incorrect password.";
                    }
                } else {
                    $connectionMessage = "Username not found.";
                }
            } elseif (isset($_POST['register'])) {
                // Registration form submitted
                $newUsername = $_POST['new_username'];
                $newPassword = $_POST['new_password'];

                // Hash the password for secure storage
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Register new user
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->execute([$newUsername, $hashedPassword]);

                $registrationMessage = "Account registered successfully!";
            }
        }
    }
} catch (PDOException $e) {
    $connectionMessage = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f8f8f8;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php echo $connectionMessage; ?>
        <?php echo $registrationMessage; ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>
            <button type="button" onclick="toggleForm()">Register</button>

            <div id="registerForm" style="display: none;">
                <label for="new_username">New Username:</label>
                <input type="text" name="new_username" required>

                <label for="new_password">New Password:</label>
                <input type="password" name="new_password
