<?php 
require_once "db.php";
$id = $_GET['id'];
if (!$id) die("Invalid ID");
try {
$sql = "Select * from ticket where TicketId = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$ticket = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    $message = $e->getMessage();
}
if(!$ticket) {
    echo "Ticket not found";
}
?>

<h2>Edit Ticket</h2>

<form method="POST">
    <label>CustomerID</label>
    <input type="number" name="customerID" value="<?= htmlspecialchars($ticket['CustomerID']) ?>" required>

    <label>Subject</label>
    <input type="text" name="subject" value="<?= htmlspecialchars($ticket['subject']) ?>" required>

    <label>Description</label>
    <textarea name="description"><?= htmlspecialchars($ticket['Description']) ?></textarea>

    <label>Status</label>
    <input type="text" name="status" value="<?= htmlspecialchars($ticket['status']) ?>" required>

    <label>Priority</label>
    <input type="text" name="priority" value="<?= htmlspecialchars($ticket['Priority']) ?>" required>

    <label>Agent ID</label>
    <input type="text" name="agentID" value="<?= htmlspecialchars($ticket['AssignedTo']) ?>" required>
    <button type="submit">Update</button>
</form>
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $sql = "UPDATE ticket SET CustomerID=?, Subject=?, Description=?, Status=?, Priority=?, AssignedTo=? WHERE TickdtId=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['customerID'],
            $_POST['subject'],
            $_POST['description'],
            $_POST['status'],
            $_POST['priority'],
            $_POST['agentID'],
            $id
        ]);

        header("Location: index.php");
        exit;
    }
?>