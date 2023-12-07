<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    $_SESSION['error'] = 'You need to log in first.';
    header('Location: ../LogIn/index.php');
    exit();
}

include "db_conn.php";

if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $stud_id = $_POST['stud_id'];
    $year = $_POST['year'];
    $program = $_POST['program'];
    $college = $_POST['college'];

    // Fetch progid for the selected program (case-insensitive and trimmed)
    $programSql = "SELECT progid FROM programs WHERE LOWER(progfullname) = LOWER(?)";
    $programStmt = $pdo->prepare($programSql);
    $programStmt->execute([trim($program)]);
    $programResult = $programStmt->fetch(PDO::FETCH_ASSOC);

    if (!$programResult) {
        die("Error: Program not found for program '" . htmlspecialchars($program) . "'");
    }

    $progid = $programResult['progid'];

    $sql = "INSERT INTO `students`(`studid`, `studfirstname`, `studlastname`, `studmidname`, `studprogid`, `studcollid`, `studyear`) 
            VALUES (NULL,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$first_name, $last_name, $middle_name, $progid, $college, $year]);

    header("Location: index.php?msg=New record created successfully");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>PHP CRUD Application</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        Student Registration
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New Student</h3>
            <p class="text-muted">Complete the form below to add a new user</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="first_name" placeholder="Albert">
                    </div>

                    <div class="col">
                        <label class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Einstein">
                    </div>

                    <div class="col">
                        <label class="form-label">Middle Name:</label>
                        <input type="text" class="form-control" name="middle_name" placeholder="Gwapo">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Student ID:</label>
                        <input type="text" class="form-control" name="stud_id" placeholder="20200">
                    </div>

                    <div class="col">
                        <label class="form-label">Year:</label>
                        <input type="text" class="form-control" name="year" placeholder="1st">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Program:</label>
                    <select class="form-select" name="program" aria-label="Select Program">
                        <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                        <option value="Bachelor of Computer Science">Bachelor of Computer Science</option>
                        <option value="Bachelor of Science in Entertainment and Multimedia Computing">Bachelor of Science in Entertainment and Multimedia Computing</option>
                        <option value="Bachelor of Information Science and Computing">Bachelor of Information Science and Computing</option>
                        <option value="Bachelor of Management Accounting">Bachelor of Management Accounting</option>
                        <option value="Bachelor of Business Administration">Bachelor of Business Administration</option>
                        <option value="Bachelor of Financial Management">Bachelor of Financial Management</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">College:</label>
                    <select class="form-select" name="college" aria-label="Select College">
                        <option value="socs">School of Computer Studies </option>
                        <option value="sbm">School of Business and Management</option>
                        <option value="sas">School of Arts and Science</option>
                        <option value="soe">School of Engineering</option>
                        <option value="soed">School of Education</option>
                        <option value="sams">School of Allied Medical Sciences</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>
