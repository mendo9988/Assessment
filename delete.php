<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "db.php";

$id = $_GET['id'] ?? null;
if ($id === null) {
    die("Invalid ID");
}
$stmt = $pdo->prepare("DELETE FROM ticket WHERE TicketId = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>