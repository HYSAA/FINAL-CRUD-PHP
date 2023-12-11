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

                header('Location: ../Main/regStudent.php');
                exit(); 
            } else {
             
                $_SESSION['error'] = 'Incorrect password';
            }
        } else {
         
            $_SESSION['error'] = 'No account associated with the email';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
} else {
    $_SESSION['error'] = 'Fill up the login form first';
}

header('location: index.php');
