<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST['id'];
    $firstName = $_POST['fname'];
    $middleName = $_POST['mname'];
    $lastName = $_POST['lname'];
    $collegeID = $_POST['college'];
    $programID = $_POST['program'];
    $year = $_POST['year'];

    $idPattern = "/^[1-9][\d]*$/";
    $yearPattern = "/^[1-5]+$/";
    $namePattern = "/^[A-Za-z\s\'\-]+$/";

    $isValidData = (
        !empty($studentID) &&
        !empty($firstName) &&
        !empty($lastName) &&
        !empty($collegeID) &&
        !empty($programID) &&
        !empty($year) &&
        preg_match($idPattern, $studentID) &&
        preg_match($namePattern, $firstName) &&
        preg_match($namePattern, $lastName) &&
        preg_match($yearPattern, $year)
    );

    if (!$isValidData) {
        header("Location: regStudent.php");
        exit();
    }

    require_once "db.php";

    $query = "INSERT INTO students (studid, studfirstname, studmidname, studlastname, studprogid, studcollid, studyear) 
    VALUES (:student_id, :fname, :mname, :lname, :program_id, :college_id, :year)";
    $prep = $conn->prepare($query);
    $prep->bindParam(':student_id', $studentID);
    $prep->bindParam(':fname', $firstName);
    $prep->bindParam(':mname', $middleName);
    $prep->bindParam(':lname', $lastName);
    $prep->bindParam(':program_id', $programID);
    $prep->bindParam(':college_id', $collegeID);
    $prep->bindParam(':year', $year);

    if ($prep->execute()) {
        header("Location: listStudents.php");
        exit();
    }
}

header("Location: regStudent.php");
exit();
?>
