<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])) {
    $collegeID = $_POST['del'];

    $del = "DELETE FROM colleges WHERE collid = :college_id";
    $prep = $conn->prepare($del);
    $prep->bindParam(':college_id', $collegeID);

    if ($prep->execute()) {
        header("Location: listColleges.php");
        exit();
    } else {
        echo "Error deleting college. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>
