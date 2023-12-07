<?php
require_once "db.php";

// Fetch colleges
$queryColleges = "SELECT collId, collshortname, collfullname FROM colleges";
$prepColleges = $conn->prepare($queryColleges);
$prepColleges->execute();
$colleges = $prepColleges->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>

<div id="data-entry">
    <form action="logicRegStud.php" method="post">
        <table id="table-entry">
            <tr>
                <th colspan="2">
                    <span>Student Information Data Entry</span>
                </th>
            </tr>
            <tr>
                <th><label for="id">Student ID</label></th>
                <td><input type="text" name="id"></td>
            </tr>
            <tr>
                <th><label for="fname">First Name</label></th>
                <td><input type="text" name="fname"></td>
            </tr>
            <tr>
                <th><label for="mname">Middle Name</label></th>
                <td><input type="text" name="mname"></td>
            </tr>
            <tr>
                <th><label for="lname">Last Name</label></th>
                <td><input type="text" name="lname"></td>
            </tr>
            <tr>
                <th><label for="college">College</label></th>
                <td>
                    <select name="college" id="college">
                        <option>----------- Select College -----------</option>
                        <?php foreach ($colleges as $college) : ?>
                            <option value="<?= $college['collId'] ?>">
                                <?= $college['collshortname'] ?> - <?= $college['collfullname'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="program">Program</label></th>
                <td>
                    <select name="program" id="program">
                        <option value="">---------- Select Program ----------</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="year">Year</label></th>
                <td><input type="text" id="year" name="year"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="button btn-primary">Save</button>
                    <button type="button" onclick="window.location.href='listStudents.php'" class="button btn-primary">View Student List</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<script src="filter_programs.js"></script>

</body>
</html>
