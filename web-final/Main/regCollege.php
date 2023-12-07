<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Registration</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>

<div id="data-entry"> 
    <form action="logicRegCollege.php" method="POST">
        <table id="table-entry">
            <tr>
                <th colspan="2">
                    <span>College Registration</span>
                </th>
            </tr>
            <tr>
                <th><label for="collId">College ID</label></th>
                <td><input type="text" name="collId"></td>
            </tr>
            <tr>
                <th><label for="collFName">College Full Name</label></th>
                <td><input type="text" name="collFName"></td>
            </tr>
            <tr>
                <th><label for="collSName">College Short Name</label></th>
                <td><input type="text" name="collSName"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="button btn-primary">Save</button>  
                    <button type="button" onclick="window.location.href='listColleges.php'" class="button btn-primary">View Colleges List</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
