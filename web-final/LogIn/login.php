<?php
session_start();

unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['error']);
unset($_SESSION['success']);

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    include 'conn.php';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');

    try {
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();

            if (isset($password) && isset($user['password']) && password_verify($password, $user['password'])) {
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['error']);

                $_SESSION['success'] = 'User verification successful';

                $_SESSION['authenticated'] = true;

                // Redirect to the dashboard
                header('Location: ../Main/regStudent.php');
                exit(); // Make sure to exit after redirect
            } else {
                // Return the values to the user
                $_SESSION['error'] = 'Incorrect password';
            }
        } else {
            // Return the values to the user
            $_SESSION['error'] = 'No account associated with the email';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
} else {
    $_SESSION['error'] = 'Fill up the login form first';
}

header('location: index.php');
