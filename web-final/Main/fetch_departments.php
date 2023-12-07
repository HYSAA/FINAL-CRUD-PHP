<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['collegeId'])) {
    $collegeId = $_POST['collegeId'];

    $query = "SELECT  * FROM departments WHERE deptcollid = :college_id";
    $prep = $conn->prepare($query);
    $prep->bindParam(':college_id', $collegeId);
    $prep->execute();
    $departments = $prep->fetchAll(PDO::FETCH_ASSOC);

    $options = '<option value="">---------- Select Department ----------</option>';
    foreach ($departments as $department) {
        $options .= '<option value="' . $department['deptid'] . '">' . $department['deptfullname'] . '</option>';
    }

    echo $options;
} else {
    echo 'Invalid request';
}


?>