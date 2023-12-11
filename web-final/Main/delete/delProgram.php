<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])) {
    $programID = $_POST['del'];

    $del = "DELETE FROM programs WHERE progid = :program_id";
    $prep = $conn->prepare($del);
    $prep->bindParam(':program_id', $programID);

    if ($prep->execute()) {
        header("Location: listPrograms.php");
        exit();
    } else {
        echo "Error deleting program. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>
