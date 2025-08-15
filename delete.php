<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: read.php");
exit;
?>
