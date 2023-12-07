<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $collegeID = $_POST['id'];
    $collegeFullname = $_POST['fullname'];
    $collegeShortname = $_POST['shortname'];
    
    $query = "UPDATE colleges SET collfullname = :fullname, collshortname = :shortname WHERE collid = :id";
    $prep = $conn->prepare($query);

    $prep->bindParam(':id', $collegeID);
    $prep->bindParam(':fullname', $collegeFullname);
    $prep->bindParam(':shortname', $collegeShortname);

    if ($prep->execute()) {
        redirectTo("listColleges.php");
    } else {
        showError("Error updating college. Please try again.");
    }
} else {
    showError("Invalid request.");
}

function redirectTo($location) {
    header("Location: $location");
    exit();
}

function showError($message) {
    echo $message;
}
?>
