<?php
// Start PHP session
session_start();

// Clear relevant session variables
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['error']);
unset($_SESSION['success']);

// Check if login form is submitted
if (isset($_POST['login'])) {
    // Assign variables to post values
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Include our database connection
    include 'conn.php';

    // Get the user with email
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');

    try {
        $stmt->execute(['email' => $email]);

        // Check if email exists
        if ($stmt->rowCount() > 0) {
            // Get the row
            $user = $stmt->fetch();

            // Validate inputted password with $user password
            if (isset($password) && isset($user['password']) && password_verify($password, $user['password'])) {
                // Clear session variables
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['error']);
                
                // Action after a successful login
                $_SESSION['success'] = 'User verification successful';

                // Set session variable to indicate authentication
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
