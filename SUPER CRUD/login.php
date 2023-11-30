<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Log-In!</title>

    <?php require 'config.php'; ?>
</head>


<body>


    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <table>

            <tr>
                <th colspan="2">USJR APP</th>
            </tr>
            <tr>
                <td>
                    <label for="userLogIn">Username:</label>
                </td>

                <td>

                    <input type="text" name="username" id="username" required>

                </td>
            </tr>

            <tr>
                <td>
                    <label for="userLogIn">Password: </label>
                </td>

                <td>
                    <input type="text" name="password" id="password" required>

                </td>
            </tr>

            <tr>

                <td>

                    <button type="submit">Submit</button>
                </td>

            </tr>


        </table>






    </form>





    <?php



    require 'config.php';

    $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

    try {
        $pdo = new PDO($dsn, $user, $password);

        if ($pdo) {
            echo "Connected to the $db database successfully!";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }





    
    ?>




</body>

</html>