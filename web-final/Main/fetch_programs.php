<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['collegeId'])) {
    $collegeId = $_POST['collegeId'];

    $query = "SELECT progId, progFullName FROM programs WHERE progcollid = :college_id";
    $prep = $conn->prepare($query);
    $prep->bindParam(':college_id', $collegeId);
    $prep->execute();
    $programs = $prep->fetchAll(PDO::FETCH_ASSOC);

    $options = '<option value="">---------- Select Program ----------</option>';
    foreach ($programs as $program) {
        $options .= '<option value="' . $program['progId'] . '">' . $program['progFullName'] . '</option>';
    }

    echo $options;
} else {
    echo 'Invalid request';
}
?>
