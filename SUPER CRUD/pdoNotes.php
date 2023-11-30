<?
try {
    $dbh = new PDO($dsn, $password, $option);


} catch (PDOException $e) {
    echo "Failed to connect" . $e->getMessage();
}
?>