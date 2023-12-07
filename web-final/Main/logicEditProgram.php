<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $collegeId = $_POST['college'];
    $programId = $_POST['progId'];
    $programFullName = $_POST['progFname'];
    $programShortName = $_POST['progSname'];
    $programCollDeptId = $_POST['department'];

    if (empty($collegeId) || empty($programId) || empty($programFullName) || empty($programShortName)) {
        showErrorAndRedirect('Error updating program. Please try again.', 'listPrograms.php');
    } else {
        $query = "UPDATE programs SET progfullname = :programFullName, progshortname = :programShortName, progcollid = :collegeId, progcolldeptid = :programCollDeptId WHERE progid = :programId";
        $prep = $conn->prepare($query);

        $prep->bindParam(':programId', $programId);
        $prep->bindParam(':programFullName', $programFullName);
        $prep->bindParam(':programShortName', $programShortName);
        $prep->bindParam(':collegeId', $collegeId);
        $prep->bindParam(':programCollDeptId', $programCollDeptId);

        if ($prep->execute()) {
            header("Location: listPrograms.php");
            exit();
        } else {
            showErrorAndRedirect('Error Executing program. Please try again.', 'listPrograms.php');
        }
    }
} else {
    header("Location: listPrograms.php");
    exit;
}

function showErrorAndRedirect($errorMessage, $redirectLocation) {
    echo "<script>
        alert('$errorMessage');
        setTimeout(function() {
            window.location.href = '$redirectLocation';
        }, 1000);
    </script>";
    exit();
}
?>
