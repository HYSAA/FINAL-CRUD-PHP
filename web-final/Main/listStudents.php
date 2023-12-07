<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="list.css">
    <title>Students</title>
</head>

<body>

    <div class="button-container">
        <button onclick="location.href='regStudent.php'" class="button btn-red">Register New Student</button>
        <button onclick="location.href='listColleges.php'" class="button btn-red">View Colleges</button>
        <button onclick="location.href='listPrograms.php'" class="button btn-red">View Programs</button>
        <button onclick="location.href='/web-final/LogIn/login.php'" class="button btn-red">Logout</button>
    </div>

    <table id="table-listing">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Initial</th>
                <th>Program Enrolled</th>
                <th>College</th>
                <th>Year</th>
                <th colspan="2">EDIT</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once "db.php";

            $query = "SELECT s.studid, s.studfirstname, s.studlastname, s.studmidname, p.progfullname 
                AS progfullname, s.studcollid, s.studyear, c.collfullname 
                FROM students s 
                INNER JOIN colleges c ON s.studcollid = c.collid
                INNER JOIN programs p ON s.studprogid = p.progid";
            $prep = $conn->query($query);

            if (!$prep) {
                echo "<tr><td colspan='8'>Error fetching students: " . implode(" ", $conn->errorInfo()) . "</td></tr>";
            } else {
                $students = $prep->fetchAll(PDO::FETCH_ASSOC);

                if (count($students) > 0) {
                    foreach ($students as $student) {
                        echo '<tr>';
                        echo '<td>' . $student['studid'] . '</td>';
                        echo '<td>' . $student['studfirstname'] . '</td>';
                        echo '<td>' . $student['studlastname'] . '</td>';
                        echo '<td>' . $student['studmidname'] . '</td>';
                        echo '<td>' . $student['collfullname'] . '</td>';
                        echo '<td>' . $student['progfullname'] . '</td>';
                        echo '<td>' . $student['studyear'] . '</td>';

                        echo '<td>';
                        echo '<form action="editStudent.php" method="post">';
                        echo '<input type="hidden" name="edit" value="' . $student['studid'] . '">';
                        echo '<input type="submit" class="btn" value="Edit">';
                        echo '</form>';
                        echo '</td>';

                        echo '<td>';
                        echo '<form action="studentDel.php" method="post">';
                        echo '<input type="hidden" name="del" value="' . $student['studid'] . '">';
                        echo '<input type="submit" class="btn" value="Delete">';
                        echo '</form>';
                        echo '</td>';

                        echo '</tr>';
                    }
                } else {
                    echo "<tr><td colspan='8'>No students found.</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>

</body>

</html>
