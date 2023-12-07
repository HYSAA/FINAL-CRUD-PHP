<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $collegeId = $_POST['college'];
    $programId = $_POST['progId'];
    $programFullName = $_POST['progFname'];
    $programShortName = $_POST['progSname'];
    $programCollDeptId = $_POST['department'];

    if (empty($collegeId) || empty($programId) || empty($programFullName) || empty($programShortName)) {
        echo "Please fill in all fields.";
    } else {
        $query = "INSERT INTO programs (progid, progfullname, progshortname, progcollid, progcolldeptid) VALUES (:programId, :programFullName, :programShortName, :collegeId, :programCollDeptId)";
        $prep = $conn->prepare($query);

        $prep->bindParam(':programId', $programId);
        $prep->bindParam(':programFullName', $programFullName);
        $prep->bindParam(':programShortName', $programShortName);
        $prep->bindParam(':collegeId', $collegeId);
        $prep->bindParam(':programCollDeptId', $programCollDeptId);

        if ($prep->execute()) {
            header("Location: listPrograms.php");
            exit();
        } else {
            echo "Error registering program. Please try again.";
        }
    }
} else {
    header("Location: listPrograms.php");
    exit();
}
?>
