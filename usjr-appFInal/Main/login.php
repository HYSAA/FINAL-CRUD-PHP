<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="usjr.css">

</head>
<body>
<div id="data-entry">


    <form action="processinglogin.php" method="POST">
            <table id="table-entry">
            <tr>
                <th colspan="2">
                    <span>User Login</span>
                </th>
            </tr>
            <tr>
                <th><label for="uname">User Name</label></th>
                <td><input  type="text" name="uname"></td>
            </tr>
            <tr>
                <th><label for="upassword">User Password</label></th>
                <td><input  type="password" name="upassword"></td>
            </tr>
        
            <tr>
                <td colspan="2" >
                <button type="submit" class="button btn-primary">Login</button>       
            </tr>
            </table>
    </form>
</div>
</body>
</html>