<?php
require_once "db.php";

$sql = "Select * from ticket";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate ticket</title>
</head>
<body>
    <header>
        <h2>View Table</h2>
    </header>
    <main>
        <table border="1">
            <tr>
                <th>Ticket ID</th>
                <th>CustomerId</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>AssignedTo</th>
                <th>Created At</th>
            </tr>
            <?php foreach ($data as $rows): ?>
            <tr>
                <td><?= htmlspecialchars($rows['TicketId']) ?></td>
                <td><?= htmlspecialchars($rows['CustomerID']) ?></td>
                <td><?= htmlspecialchars($rows['Subject']) ?></td>
                <td><?= htmlspecialchars($rows['Description']) ?></td>
                <td><?= htmlspecialchars($rows['Status']) ?></td>
                <td><?= htmlspecialchars($rows['Priority']) ?></td>
                <td><?= htmlspecialchars($rows['AssignedTo']) ?></td>
                <td><?= $rows['CreatedAt']? date('d-m-Y', strtotime($rows['CreatedAt'])) : 'N/A' ?></td>
                <td><a href="edit.php?id=<?= $rows['TicketId'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $rows['TicketId'] ?>"
                onclick="return confirm('Are you sure?')">Delete</a>
</td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>