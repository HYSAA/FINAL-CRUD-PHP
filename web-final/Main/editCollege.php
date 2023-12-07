<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit College</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <?php
        require_once "db.php";
        $collegeID = $_POST['edit'] ?? null;
        if ($collegeID) {
            $query = "SELECT collid, collfullname, collshortname FROM colleges WHERE collid = :collegeID";
            $prep = $conn->prepare($query);
            $prep->bindParam(':collegeID', $collegeID);
            $prep->execute();

            $collegeData = $prep->fetch(PDO::FETCH_ASSOC);
        }
    ?>

    <div id="data-entry">
        <form action="logicEditCollege.php" method="post">
            <table id="table-entry">
                <tr>
                    <th colspan="2">
                        <span>Edit College Information Data Entry</span>
                    </th>
                </tr>
                <tr>
                    <th><label for="id">College ID</label></th>  
                    <td><input type="text"  name="id" value="<?php echo $collegeData['collid']; ?>" ></td>
                </tr>
                <tr>
                    <th><label for="fullname">College Fullname</label></th>
                    <td><input type="text" name="fullname" value="<?php echo $collegeData['collfullname']; ?>" ></td>
                </tr>
                <tr>
                    <th><label for="shortname">College Shortname</label></th>
                    <td><input type="text" name="shortname" value="<?php echo $collegeData['collshortname']; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="button btn-primary">Save</button>
                        <button type="button" onclick="window.location.href='listColleges.php'" class="button btn-primary">Back</button>

                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
   
</html>
