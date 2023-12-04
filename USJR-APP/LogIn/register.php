<?php
session_start();

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password != $confirm) {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['confirm'] = $confirm;
        $_SESSION['error'] = 'Passwords did not match';
    } else {
        include 'conn.php';

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['confirm'] = $confirm;
            $_SESSION['error'] = 'Email already taken';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');

            try {
                $stmt->execute(['email' => $email, 'password' => $password]);
                $_SESSION['success'] = 'User registered successfully. You can <a href="index.php">login</a> now';
            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
    }
} else {
    $_SESSION['error'] = 'Fill up registration form first';
}

header('location: register_form.php');
?>
