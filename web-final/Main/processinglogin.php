

<?php
// require_once 'db.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST['uname'], $_POST['upassword'])) {
//         $username = $_POST['uname'];
//         $userpassword = $_POST['upassword'];
//         $prep = $conn->prepare("SELECT id, username, password FROM users WHERE username = :username");
//         $prep->bindParam(':username', $username);
//         $prep->execute();
//         $result = $prep->fetch(PDO::FETCH_ASSOC);

//         if ($result) {
//             $stored_password = $result['password'];

//             if (password_verify($userpassword, $stored_password)) {
//                 echo "CONNECTED";
//                 header("Location: listStudents.php");
//                 exit();
//             } else {
//                 echo "Incorrect password.";
//             }
//         } else {
//             echo "User not found";
//         }
//     }
// }
// ?>




