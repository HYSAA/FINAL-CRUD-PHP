<?php
include "db_conn.php";
$id = $_GET["id"];

try {
    $sql = "DELETE FROM `crud` WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: index.php?msg=Data deleted successfully");
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage();
}
?>
