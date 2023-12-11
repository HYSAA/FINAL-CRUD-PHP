<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs</title>
    <link rel="stylesheet" type="text/css" href="list.css">
</head>

<body>

<div class="fixed-buttons button-container">
        <button onclick="location.href='regProgram.php'" class="button btn-red">Register Program</button>
        <button onclick="location.href='listStudents.php'" class="button btn-red">View Student List</button>
        <button onclick="location.href='listColleges.php'" class="button btn-red">View College List</button>
        <button onclick="location.href='/web-final/LogIn/login.php'" class="button btn-red">Logout</button>
    </div>

    <table id="table-listing">
        <thead>
            <tr>
                <th>Program ID</th>
                <th>Program Full Name</th>
                <th>Program Short Name</th>
                <th>College ID</th>
                <th>Department ID</th>
                <th colspan=2>EDIT</th>
            </tr>
        </thead>
        <tbody>
            
<?php
            require_once "db.php";

            $query = "SELECT * FROM programs";
            $prep = $conn->query($query);

            if ($prep) {
                $programs = $prep->fetchAll(PDO::FETCH_ASSOC);
                if (count($programs) > 0) {
                    foreach ($programs as $program) {
                        ?>
                        <tr>
                            <td><?= $program['progid'] ?></td>
                            <td><?= $program['progfullname'] ?></td>
                            <td><?= $program['progshortname'] ?></td>
                            <td><?= $program['progcollid'] ?></td>
                            <td><?= $program['progcolldeptid'] ?></td>
                            <td>
                                <form action="editProgram.php" method="post">
                                    <input type="hidden" name="edit" value="<?= $program['progid'] ?>">
                                    <input type="submit" class="btn" value="Edit">
                                </form>
                            </td>
                            <td>
                                <form action="programDel.php" method="post">
                                    <input type="hidden" name="del" value="<?= $program['progid'] ?>">
                                    <input type="submit" class="btn" value="Delete">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No programs found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Error fetching programs: " . $conn->errorInfo()[2] . "</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>


