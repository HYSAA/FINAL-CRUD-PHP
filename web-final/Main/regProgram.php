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
    <title>Program Registration</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>

<div id="data-entry">
    <form action="logicRegProg.php" method="POST">
        <table id="table-entry">
            <tr>
                <th colspan="2">
                    <span>Program Registration</span>
                </th>
            </tr>
            <tr>
                <th><label for="college">College</label></th>
                <td>
                    <select name="college" id="college">
                        <option value="">----------- Select College -----------</option>
                        <?php foreach ($colleges as $college) : ?>
                            <option value="<?= $college['collId'] ?>">
                                <?= $college['collshortname'] ?> - <?= $college['collfullname'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="department">Department</label></th>
                <td>
                    <select name="department" id="department">
                        <option value="">----------- Select Department -----------</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="progId">Program ID</label></th>
                <td><input type="text" name="progId" id="progId"></td>
            </tr>
            <tr>
                <th><label for="progFname">Program Fullname</label></th>
                <td><input type="text" name="progFname"></td>
            </tr>
            <tr>
                <th><label for="progSname">Program Shortname</label></th>
                <td><input type="text" name="progSname"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="button btn-primary">Save</button>
                    <button type="button" onclick="window.location.href='listPrograms.php'" class="button btn-primary">View Programs List</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<script src="filter_departments.js"></script>

</body>
</html>
