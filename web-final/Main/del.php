<?php
// require_once "db.php";

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])) {
//     $idToDelete = $_POST['del'];

  
//     $delProgram = "DELETE FROM programs WHERE progid = :id";
//     $prepProgram = $conn->prepare($delProgram);
//     $prepProgram->bindParam(':id', $idToDelete);

//     if (!$prepProgram->execute()) {
//         echo "Error deleting program. Please try again.";
//         exit();
//     }


//     $delStudent = "DELETE FROM students WHERE studid = :id";
//     $prepStudent = $conn->prepare($delStudent);
//     $prepStudent->bindParam(':id', $idToDelete);

//     if (!$prepStudent->execute()) {
//         echo "Error deleting student. Please try again.";
//         exit();
//     }

   
//     $delCollege = "DELETE FROM colleges WHERE collid = :id";
//     $prepCollege = $conn->prepare($delCollege);
//     $prepCollege->bindParam(':id', $idToDelete);

//     if ($prepCollege->execute()) {
//         header("Location: listColleges.php");
//         exit();
//     } else {
//         echo "Error deleting college. Please try again.";
//     }
// } else {
//     echo "Invalid request.";
// }
// ?>