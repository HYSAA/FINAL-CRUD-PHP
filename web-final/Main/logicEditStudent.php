<?php
require_once "db.php";


if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Form data not received";
    header("Location: editStudent.php");
    exit();
}

$studentID = $_POST['id'];
$firstName = $_POST['fname'];
$middleName = $_POST['mname'];
$lastName = $_POST['lname'];
$collegeID = $_POST['college'];
$programID = $_POST['program'];
$year = $_POST['year'];

if (empty($studentID) || empty($firstName) || empty($lastName) || empty($collegeID) || empty($programID) || empty($year) ||
    !preg_match("/^[1-9][\d]*$/", $studentID) || !preg_match("/^[A-Za-z\s\'\-]+$/", $firstName) || !preg_match("/^[A-Za-z\s\'\-]+$/", $lastName) || !preg_match("/^[1-5]+$/", $year)) {
    echo "Invalid input detected. Please check your data and try again.";
    header("Location: error.php");
    exit();
}

$query = "UPDATE students SET 
            studid = :student_id,
            studfirstname = :fname, 
            studmidname = :mname, 
            studlastname = :lname, 
            studcollid = :college, 
            studprogid = :program, 
            studyear = :year
          WHERE studid = :old_student_id";

$prep = $conn->prepare($query);
$prep->bindParam(':student_id', $studentID);
$prep->bindParam(':old_student_id', $studentID);  // Add this line
$prep->bindParam(':fname', $firstName);
$prep->bindParam(':mname', $middleName);
$prep->bindParam(':lname', $lastName);
$prep->bindParam(':college', $collegeID);
$prep->bindParam(':program', $programID);
$prep->bindParam(':year', $year);


if ($prep->execute()) {
    echo "Student information updated successfully";
    header("Location: listStudents.php");
    exit();
} else {
    echo "Error updating student information";
    header("Location: editStudent.php");
    exit();
}
?>
