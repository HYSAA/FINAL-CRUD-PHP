<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <?php
    require_once "db.php";

    $programID = $_POST['edit'] ?? null;
    if ($programID) {
        $query = "SELECT progid, progfullname, progshortname, progcollid, progcolldeptid 
            FROM programs WHERE progid = :programID";

        $prep = $conn->prepare($query);
        $prep->bindParam(':programID', $programID);
        $prep->execute();

        $programData = $prep->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <div id="data-entry">
        <form action="logicEditProgram.php" method="post">
            <table id="table-entry"><tr>
                <th colspan="2">
                    <span>Edit Program Information Data Entry</span>
                    </th>
                </tr>
                
                 <tr>
                    <th><label for="college">College</label></th>
                    <td>
                        <select name="college" id="college">
                            <option disabled>----------- Select College -----------</option>
                            <?php
                            $query = "SELECT collId, collshortname, collfullname FROM colleges";
                            $prep = $conn->prepare($query);
                            $prep->execute();
                            $colleges = $prep->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($colleges as $college) {
                                $selected = ($college['collId'] == $programData['progcollid']) ? 'selected' : '';
                                echo '<option value="' . $college['collId'] . '" ' . $selected . '>';
                                echo $college['collshortname'] . ' - ' . $college['collfullname'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="department">Department</label></th>
                    <td>
                        <select name="department" id="department">
                            <option disabled>----------- Select Department -----------</option>
                            <?php
                            $query = "SELECT deptid, deptfullname FROM departments WHERE deptcollid = :collegeId";
                            $prep = $conn->prepare($query);
                            $prep->bindParam(':collegeId', $programData['progcollid']);
                            $prep->execute();
                            $departments = $prep->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($departments as $department) {
                                $selected = ($department['deptid'] == $programData['progcolldeptid']) ? 'selected' : '';
                                echo '<option value="' . $department['deptid'] . '" ' . $selected . '>';
                                echo $department['deptfullname'];
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                
              
                <tr>
                    <th><label for="id">Program ID</label></th>  
                    <td><input type="text"  name="progId" value="<?php echo $programData['progid']; ?>" ></td>
                </tr>
                <tr>
                    <th><label for="fullname">Program Fullname</label></th>
                    <td><input type="text" name="progFname" value="<?php echo $programData['progfullname']; ?>" ></td>
                </tr>
                <tr>
                    <th><label for="shortname">Program Shortname</label></th>
                    <td><input type="text" name="progSname" value="<?php echo $programData['progshortname']; ?>"></td>
                </tr>
               
                <tr>
                    <td colspan="2">
                        <button type="submit" class="button btn-primary">Save</button>
                        <button type="button" onclick="window.location.href='listPrograms.php'" class="button btn-primary">Back</button>

                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
  

<script src='filter_departments.js'></script>
<script>



