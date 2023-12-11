<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colleges</title>
    <link rel="stylesheet" type="text/css" href="list.css">
</head>

<body>

<div class="fixed-buttons button-container">
        <button onclick="location.href='regCollege.php'" class="button btn-red">Register College</button>
        <button onclick="location.href='listStudents.php'" class="button btn-red">View Student List</button>
        <button onclick="location.href='listPrograms.php'" class="button btn-red">View Program List</button>
        <button onclick="location.href='/web-final/LogIn/login.php'" class="button btn-red">Logout</button>
    </div>

    <table id="table-listing">
        <thead>
            <tr>
                <th>College ID</th>
                <th>College Full Name</th>
                <th>College Short Name</th>
                <th colspan=2>EDIT</th>
            </tr>
        </thead>
        <tbody>
          
<?php
            require_once "db.php";

            // Fetch colleges data
            $query = "SELECT * FROM colleges";
            $prep = $conn->query($query);

            if ($prep) {
                $colleges = $prep->fetchAll(PDO::FETCH_ASSOC);
                if (count($colleges) > 0) {
                    foreach ($colleges as $college) {
                        ?>
                        <tr>
                            <td><?= $college['collid'] ?></td>
                            <td><?= $college['collfullname'] ?></td>
                            <td><?= $college['collshortname'] ?></td>
                            <td>
                                <form action="editCollege.php" method="post">
                                    <input type="hidden" name="edit" value="<?= $college['collid'] ?>">
                                    <input type="submit" class="btn" value="Edit">
                                </form>
                            </td>
                            <td>
                                <form action="collegeDel.php" method="post">
                                    <input type="hidden" name="del" value="<?= $college['collid'] ?>">
                                    <input type="submit" class="btn" value="Delete">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>No colleges found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Error fetching colleges: " . $conn->errorInfo()[2] . "</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>


