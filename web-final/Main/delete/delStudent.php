<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])) {
    $studentID = $_POST['del'];

   
    $del = "DELETE FROM students WHERE studid = :student_id";
    $prep = $conn->prepare($del);
    $prep->bindParam(':student_id', $studentID);

    
    if ($prep->execute()) {
        header("Location: listStudents.php");
        exit();
    } else {
        echo "Error deleting student. Please try again.";
    }
} else {
    echo "Invalid request."; 
}
 ?>