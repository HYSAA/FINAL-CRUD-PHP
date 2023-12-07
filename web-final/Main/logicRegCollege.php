<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $collegeID = $_POST['collId'];
    $collegeFullname = $_POST['collFName'];
    $collegeShortname = $_POST['collSName'];

    require_once "db.php";

    $query = "INSERT INTO colleges (collid, collfullname, collshortname) VALUES (:collegeID, :collegeFullname, :collegeShortname)";
    $prep = $conn->prepare($query);

    $prep->bindParam(':collegeID', $collegeID);
    $prep->bindParam(':collegeFullname', $collegeFullname);
    $prep->bindParam(':collegeShortname', $collegeShortname);

    if ($prep->execute()) {
        header("Location: listColleges.php");
        exit();
    } else {
        echo "Error: " . $prep->errorInfo()[2];
    }
} else {
    echo "Form submission error: Invalid request method.";
}
?>
