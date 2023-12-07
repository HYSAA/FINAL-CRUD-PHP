<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <?php
        require_once "db.php";
        $studentID = $_POST['edit'] ?? null;
        if ($studentID) {
            $query = "SELECT s.studid, s.studfirstname, s.studlastname, s.studmidname, s.studcollid, s.studprogid, s.studyear
                FROM students s 
                WHERE s.studid = :studentID";

            $prep = $conn->prepare($query);
            $prep->bindParam(':studentID', $studentID);
            $prep->execute();

            $studentData = $prep->fetch(PDO::FETCH_ASSOC);
        }


    
    ?>

    <div id="data-entry">
        <form action="logicEditStudent.php" method="post">
            <table id="table-entry">
                <tr>
                    <th colspan="2">
                        <span>Edit Student Information Data Entry</span>
                    </th>
                </tr>
                <tr>
                    <th><label for="id">Student ID</label></th>  
                    <td><input type="text"  name="id" value="<?php echo $studentData['studid']; ?>" ></td>
                </tr>
                <tr>
                    <th><label for="fname">First Name</label></th>
                    <td><input type="text" name="fname" value="<?php echo $studentData['studfirstname']; ?>" ></td>
                </tr>
                <tr>
                    <th><label for="mname">Middle Name</label></th>
                    <td><input type="text" name="mname" value="<?php echo $studentData['studmidname']; ?>"></td>
                </tr>
                <tr>
                    <th><label for="lname">Last Name</label></th>
                    <td><input type="text" name="lname" value="<?php echo $studentData['studlastname']; ?>"></td>
                </tr>
                <tr>
                    <th><label for="college">College</label></th>
                    <td>
                        <select name="college" id="college">
                            <option disabled>----------- Select College -----------</option>
                            <?php
                                $queryColleges = "SELECT collId, collshortname, collfullname FROM colleges";
                                $prep = $conn->prepare($queryColleges);
                                $prep->execute();
                                $colleges = $prep->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($colleges as $college) {
                                    $selected = ($college['collId'] == $studentData['studcollid']) ? 'selected' : '';
                                    echo '<option value="' . $college['collId'] . '" ' . $selected . '>';
                                    echo $college['collshortname'] . ' - ' . $college['collfullname'];
                                    echo '</option>';
                                }
                            ?>  
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="program">Program</label></th>
                    <td>
                        <select name="program" id="program">
                            <option disabled>----------- Select Program -----------</option>
                            <?php
                                // Fetch programs  with selected college
                                $query = "SELECT progId, progfullName FROM programs WHERE progcollid = :collegeId";
                                $prep = $conn->prepare($query);
                                $prep->bindParam(':collegeId', $studentData['studcollid']);
                                $prep->execute();
                                $programs = $prep->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($programs as $program) {
                                    $selected = ($program['progId'] == $studentData['studprogid']) ? 'selected' : '';
                                    echo '<option value="' . $program['progId'] . '" ' . $selected . '>';
                                    echo $program['progfullName'];
                                    echo '</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="year">Year</label></th>
                    <td><input type="text" id="year" name="year" value="<?php echo $studentData['studyear']; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="button btn-primary">Save</button>
                        <button type="button" onclick="window.location.href='listStudents.php'" class="button btn-primary">Back</button>

                    </td>

                    
                </tr>
            </table>
        </form>
    </div>
</body>
   
<script src="filter_programs.js"></script>


</html>
