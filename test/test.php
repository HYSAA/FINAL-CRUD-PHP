<?php
$servername = "localhost";
$username = "root";
$password = "admin123";
$dbname = "usjr4"; // Change the database name here

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create a new student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $midname = $_POST["midname"];
    $progid = $_POST["progid"];
    $collid = $_POST["collid"];
    $year = $_POST["year"];

    $sql = "INSERT INTO students (studfirstname, studlastname, studmidname, studprogid, studcollid, studyear)
            VALUES ('$firstname', '$lastname', '$midname', $progid, $collid, $year)";

    if ($conn->query($sql) === TRUE) {
        echo "Student created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Read all students
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>Program ID</th>
                <th>College ID</th>
                <th>Year</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["studid"] . "</td>
                <td>" . $row["studfirstname"] . "</td>
                <td>" . $row["studlastname"] . "</td>
                <td>" . $row["studmidname"] . "</td>
                <td>" . $row["studprogid"] . "</td>
                <td>" . $row["studcollid"] . "</td>
                <td>" . $row["studyear"] . "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
